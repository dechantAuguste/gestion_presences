<?php
/**
 * SNGP - Contrôleur d'Authentification
 * 
 * Gère la connexion et la déconnexion des utilisateurs.
 */

require_once __DIR__ . '/../modeles/connexion_bdd.php';
require_once __DIR__ . '/../modeles/etudiant_modele.php';

/**
 * Traite le formulaire de connexion.
 */
function authentifier(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $matricule = trim($_POST['matricule'] ?? '');
    $motDePasse = $_POST['mot_de_passe'] ?? '';

    if (empty($matricule) || empty($motDePasse)) {
        header('Location: index.php?action=login&erreur=1');
        exit;
    }

    $utilisateur = getUtilisateurParMatricule($matricule);

    if (!$utilisateur || !password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
        header('Location: index.php?action=login&erreur=1');
        exit;
    }

    // Session utilisateur
    $_SESSION['utilisateur_id'] = $utilisateur['id'];
    $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
    $_SESSION['utilisateur_prenom'] = $utilisateur['prenom'];
    $_SESSION['utilisateur_role'] = $utilisateur['role'];

    // Redirection selon le rôle
    $destination = ($utilisateur['role'] === 'etudiant') 
        ? 'index.php?action=dashboard' 
        : 'index.php?action=enseignant';
    
    header("Location: $destination");
    exit;
}

/**
 * Déconnecte l'utilisateur.
 */
function deconnecter(): void {
    session_destroy();
    header('Location: index.php?action=login');
    exit;
}

// Point d'entrée si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    authentifier();
}
