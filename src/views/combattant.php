<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Combattants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-4">Liste des Combattants</h1>
    <button id="start-combat">Démarrer un combat</button>
    <div class="row">
        <?php foreach ($combattants as $combattant) : ?>
            <div class="col-md-4 mb-4">
                <a href="combattant/<?= $combattant['Id'] ?>" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Nom : <?= htmlspecialchars($combattant['nom']) ?></h5>
                            <p class="card-text"><strong>Force : </strong> <?= $combattant['force'] ?></p>
                            <p class="card-text"><strong>Santé : </strong> <?= $combattant['sante'] ?></p>
                            <p class="card-text"><strong>Niveau : </strong> <?= $combattant['niveau'] ?></p>
                            <p class="card-text"><strong>Style : </strong>
                                <span class="badge bg-primary"><?= htmlspecialchars($combattant['style']) ?></span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../public/js/combattant.js"></script>
</body>
</html>
