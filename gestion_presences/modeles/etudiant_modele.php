<?php
/**
 * SNGP - Modèle Étudiant
 * 
 * Fonctions d'accès aux données pour les étudiants :
 * - Récupération du profil
 * - Historique des présences
 * - Enregistrement d'une présence
 */

/**
 * Récupère un utilisateur par son matricule.
 */
function getUtilisateurParMatricule(string $matricule): array|false {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE matricule = ?');
    $stmt->execute([$matricule]);
    return $stmt->fetch();
}

/**
 * Récupère l'historique des présences d'un étudiant.
 */
function getPresencesEtudiant(int $etudiantId): array {
    global $pdo;
    $stmt = $pdo->prepare('
        SELECT p.date_enregistrement, p.statut, 
               c.titre AS cours, s.date_seance
        FROM presences p
        JOIN seances s ON p.seance_id = s.id
        JOIN cours c ON s.cours_id = c.id
        WHERE p.etudiant_id = ?
        ORDER BY p.date_enregistrement DESC
    ');
    $stmt->execute([$etudiantId]);
    return $stmt->fetchAll();
}

/**
 * Recherche une séance par son token QR code.
 */
function getSeanceParToken(string $token): array|false {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM seances WHERE qr_code_token = ?');
    $stmt->execute([$token]);
    return $stmt->fetch();
}

/**
 * Enregistre la présence d'un étudiant à une séance.
 */
function enregistrerPresence(int $seanceId, int $etudiantId): bool {
    global $pdo;
    try {
        $stmt = $pdo->prepare('
            INSERT INTO presences (seance_id, etudiant_id, statut) 
            VALUES (?, ?, \'present\')
        ');
        return $stmt->execute([$seanceId, $etudiantId]);
    } catch (PDOException $e) {
        // Doublon géré silencieusement (contrainte UNIQUE)
        if ($e->getCode() == 23000) {
            return false;
        }
        throw $e;
    }
}
