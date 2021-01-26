<!DOCTYPE html>

<head> 
    
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">

    <script src="https://kit.fontawesome.com/4b321f22ba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/statistic.js" defer></script>
    <script type="text/javascript" src="./public/js/popup.js" defer></script>

    <title>RECIPES</title>

</head>

<body>

    <div class="base-container">

    <?php include('nav.php') ?>

        <main>

            <?php include('header.php') ?>

            <section class="projects">
                <?php
                $number = 0;
                foreach ($projects as $project): ?>
                <div id="<?= $project->getId(); ?>">
                    <img src="public/upload/<?= $project->getImage(); ?>">
                    <div>
                        <h2><?= $project->getTitle(); ?></h2>
                        <p><?= $project->getDescription(); ?></p>
                        <div class="info-section">
                            <i class="fas fa-fire"><?= $project->getKcal(); ?></i>
                            <i class="fas fa-stopwatch"><?= $project->getTime(); ?></i>
                        </div>
                        <div class="social-section">
                            <i class="fas fa-heart"><?= $project->getLike(); ?></i>
                            <button onclick=showPopup("view-group-popup<?= $number; ?>")>show</button>
                            <i class="fas fa-minus-square"><?= $project->getDislike(); ?></i>
                        </div>
                    </div>
                </div>
                    <div class="popup-window" id="view-group-popup<?= $number; ?>">
                        <div class="inner">
                            <div id="<?= $project->getId(); ?>">
                                <img src="public/upload/<?= $project->getImage(); ?>">
                                <div>
                                    <h2><?= $project->getTitle(); ?></h2>
                                    <p><?= $project->getDescription(); ?></p>
                                    <div class="info-section">
                                        <i class="fas fa-fire"><?= $project->getKcal(); ?></i>
                                        <i class="fas fa-stopwatch"><?= $project->getTime(); ?></i>
                                    </div>
                                    <div class="social-section">
                                        <i class="fas fa-heart"><?= $project->getLike(); ?></i>
                                        <i class="fas fa-minus-square"><?= $project->getDislike(); ?></i>
                                    </div>
                                    <?= $project->getLink(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                $number += 1;
                endforeach; ?>
            </section>

        </main>

    </div>

</body>

<template id="project-template">
    <div id="">
        <img src="">
        <div>
            <h2>title</h2>
            <p>description</p>
            <div class="info-section">
                <i class="fas fa-fire"> 0</i>
                <i class="fas fa-stopwatch"> 0</i>
            </div>
            <div class="social-section">
                <i class="fas fa-heart"> 0</i>
                <i class="fas fa-minus-square"> 0</i>
            </div>
        </div>
    </div>
</template>