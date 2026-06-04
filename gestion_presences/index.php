<?php
/**
 * SNGP - Point d'entrée principal
 * 
 * Routeur simple : redirige vers le contrôleur approprié
 * selon l'action demandée.
 */

session_start();

// Configuration
require_once 'modeles/connexion_bdd.php';

// Routage basique
$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        require_once 'vues/login.php';
        break;
    case 'dashboard':
        require_once 'vues/dashboard.php';
        break;
    case 'enseignant':
        require_once 'vues/enseignant.php';
        break;
    case 'deconnexion':
        require_once 'controleurs/auth_controleur.php';
        deconnecter();
        break;
    default:
        require_once 'vues/login.php';
}
