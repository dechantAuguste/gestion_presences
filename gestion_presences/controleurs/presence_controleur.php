<?php
/**
 * SNGP - Contrôleur de Présences
 * 
 * Gère la création de séances, la génération de QR codes
 * et la validation des présences.
 */

require_once __DIR__ . '/../modeles/connexion_bdd.php';
require_once __DIR__ . '/../modeles/etudiant_modele.php';

/**
 * Vérifie que l'utilisateur est connecté.
 */
function verifierAuthentification(): void {
    if (!isset($_SESSION['utilisateur_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
}

/**
 * Génère un token unique pour le QR code.
 */
function genererToken(): string {
    return bin2hex(random_bytes(16));
}

/**
 * Crée une nouvelle séance (réservé aux enseignants/admins).
 */
function creerSeance(int $coursId, int $enseignantId, string $date, string $heureDebut, string $heureFin): int {
    global $pdo;
    $token = genererToken();
    
    $stmt = $pdo->prepare('
        INSERT INTO seances (cours_id, enseignant_id, date_seance, heure_debut, heure_fin, qr_code_token)
        VALUES (?, ?, ?, ?, ?, ?)
    ');
    $stmt->execute([$coursId, $enseignantId, $date, $heureDebut, $heureFin, $token]);
    
    return (int) $pdo->lastInsertId();
}

/**
 * Récupère la liste des cours disponibles.
 */
function getListeCours(): array {
    global $pdo;
    return $pdo->query('SELECT * FROM cours ORDER BY code_cours')->fetchAll();
}

/**
 * Récupère les séances créées par un enseignant.
 */
function getSeancesEnseignant(int $enseignantId): array {
    global $pdo;
    $stmt = $pdo->prepare('
        SELECT s.*, c.titre AS cours_titre, c.code_cours
        FROM seances s
        JOIN cours c ON s.cours_id = c.id
        WHERE s.enseignant_id = ?
        ORDER BY s.date_seance DESC, s.heure_debut DESC
    ');
    $stmt->execute([$enseignantId]);
    return $stmt->fetchAll();
}
