<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNGP - Connexion</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <h1>SNGP</h1>
            <p class="subtitle">Système Numérique de Gestion des Présences</p>
            
            <?php if (isset($_GET['erreur'])): ?>
                <div class="alert alert-error">
                    Matricule ou mot de passe incorrect.
                </div>
            <?php endif; ?>

            <form method="POST" action="controleurs/auth_controleur.php">
                <div class="form-group">
                    <label for="matricule">Matricule</label>
                    <input type="text" id="matricule" name="matricule" 
                           placeholder="Ex: 23-001" required>
                </div>
                
                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" 
                           placeholder="Votre mot de passe" required>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>
