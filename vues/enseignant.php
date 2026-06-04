<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNGP - Tableau de Bord Enseignant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php
    // TODO: Protéger la page — rediriger si pas connecté ou si rôle = etudiant
    // TODO: Récupérer la liste des cours (getListeCours)
    // TODO: Récupérer les séances de l'enseignant (getSeancesEnseignant)
    ?>
    <!-- TODO: Dashboard enseignant
         - Header avec nom + bouton déconnexion
         - Section "Nouvelle séance" : formulaire (sélection cours, date, heure début/fin)
           → Au submit, créer la séance et générer le QR code
         - Section "QR Code actif" : afficher le QR code de la dernière séance
           → <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=<?= urlencode($token) ?>">
         - Section "Mes séances" : tableau (date, cours, horaire, code)
    -->
</body>
</html>
