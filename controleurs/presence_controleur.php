<?php
/**
 * TODO: Contrôleur de Présences
 * - verifierAuthentification(): rediriger si pas connecté
 * - genererToken(): bin2hex(random_bytes(16))
 * - creerSeance(): INSERT INTO seances avec le token
 * - getListeCours(): SELECT * FROM cours
 * - getSeancesEnseignant(): séances créées par l'enseignant connecté
 * - Validation présence : vérifier le token → INSERT INTO presences
 *   → Gérer le doublon avec try/catch (code erreur 23000)
 * - QR Code : <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=TOKEN">
 */
