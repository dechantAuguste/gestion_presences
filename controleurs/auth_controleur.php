<?php
/**
 * TODO: Contrôleur d'Authentification
 * - Vérifier si $_POST est soumis → authentifier()
 * - authentifier(): récupérer matricule + mot de passe
 *   → Chercher l'utilisateur dans la BDD
 *   → Vérifier le mot de passe avec password_verify()
 *   → Stocker les infos en session ($_SESSION)
 *   → Rediriger selon le rôle (etudiant → dashboard, enseignant/admin → enseignant)
 * - deconnecter(): session_destroy() + redirection login
 */
