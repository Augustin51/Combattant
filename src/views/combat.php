<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat - Comparaison des combattants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .combattant-card {
            margin-bottom: 20px;
        }
        .aptitude-btn {
            margin: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-5">Combat - <?= $combattant1[0]['nom']; ?> contre <?= $combattant2[0]['nom']; ?></h1>
    <div class="row">
        <!-- Combattant 1 -->
        <div class="col-md-6">
            <div class="card combattant-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Combattant 1 : <?= $combattant1[0]['nom']; ?></h5>
                </div>
                <div class="card-body">
                    <p><strong>Force :</strong> <?= $combattant1[0]['force']; ?></p>
                    <p class="health-combattant" data-id="<?= $combattant1[0]['Id'] ?>"><strong>Santé : </strong><span><?= $combattant1[0]['sante']; ?></span></p>
                    <p><strong>Niveau :</strong> <?= $combattant1[0]['niveau']; ?></p>
                    <h6>Aptitudes :</h6>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($combattant1[1] as $aptitude): ?>
                            <button class="aptitude btn btn-outline-primary aptitude-btn">
                                <span data-id="<?= $idCombat['Id'] ?>"></span>
                                <span data-id="<?= $combattant1[0]['Id'] ?>"></span>
                                <span data-id="<?= $aptitude['Id'] ?>"><?= $aptitude['nom']; ?></span> <span data-note="<?= $aptitude['note'] ?>">(<?= $aptitude['note']; ?>)</span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Combattant 2 -->
        <div class="col-md-6">
            <div class="card combattant-card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Combattant 2 : <?= $combattant2[0]['nom']; ?></h5>
                </div>
                <div class="card-body">
                    <p><strong>Force :</strong> <?= $combattant2[0]['force']; ?></p>
                    <p class="health-combattant" data-id="<?= $combattant2[0]['Id'] ?>"><strong>Santé : </strong><span><?= $combattant2[0]['sante']; ?></span></p>
                    <p><strong>Niveau :</strong> <?= $combattant2[0]['niveau']; ?></p>
                    <h6>Aptitudes :</h6>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($combattant2[1] as $aptitude): ?>
                            <button class="aptitude btn btn-outline-success aptitude-btn">
                                <span data-id="<?= $idCombat['Id'] ?>"></span>
                                <span data-id="<?= $combattant2[0]['Id'] ?>"></span>
                                <span class="aptitude-name" data-id="<?= $aptitude['Id'] ?>"><?= $aptitude['nom']; ?></span> <span class="aptitude-note" data-note="<?= $aptitude['note'] ?>">(<?= $aptitude['note']; ?>)</span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../public/js/combat.js"></script>
</body>
</html>
