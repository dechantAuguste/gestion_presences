<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNGP - Dashboard Étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['utilisateur_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
    require_once 'modeles/etudiant_modele.php';
    $presences = getPresencesEtudiant($_SESSION['utilisateur_id']);
    ?>

    <header class="header">
        <div class="header-content">
            <h1>SNGP</h1>
            <nav>
                <span class="user-info">
                    <?= htmlspecialchars($_SESSION['utilisateur_prenom'] . ' ' . $_SESSION['utilisateur_nom']) ?>
                </span>
                <a href="index.php?action=deconnexion" class="btn btn-outline">Se déconnecter</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="card">
            <h2>Scanner un QR Code</h2>
            <form method="POST" action="controleurs/presence_controleur.php">
                <div class="form-group">
                    <label for="token">Code de la séance</label>
                    <input type="text" id="token" name="token" 
                           placeholder="Entrez le code affiché en salle" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    Enregistrer ma présence
                </button>
            </form>
        </section>

        <section class="card">
            <h2>Historique des présences</h2>
            <?php if (empty($presences)): ?>
                <p class="text-muted">Aucune présence enregistrée pour le moment.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Cours</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($presences as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['date_seance']) ?></td>
                            <td><?= htmlspecialchars($p['cours']) ?></td>
                            <td>
                                <span class="badge badge-<?= $p['statut'] ?>">
                                    <?= htmlspecialchars($p['statut']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
