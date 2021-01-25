<!DOCTYPE html>

<head>

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">

    <script src="https://kit.fontawesome.com/4b321f22ba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/statistic.js" defer></script>

    <title>PROFILE</title>

</head>

<body>

    <div class="base-container">

        <nav>
            <img src="public/img/logo.svg">
            <ul>

                <li>
                    <i class="far fa-user-circle"></i>
                    <a href="#" class="button">Profile</a>
                </li>

                <li>
                    <i class="fas fa-project-diagram"></i>
                    <a href="#" class="button">Recipes</a>
                </li>

                <li>
                    <i class="fas fa-history"></i>
                    <a href="#" class="button">History</a>
                </li>
                
                <li>
                    <i class="fas fa-cog"></i>
                    <a href="#" class="button">Seeting</a>
                </li> 

                <li>
                    <i class="fas fa-sign-out-alt"></i>
                    <a href="#" class="button">Log Out</a>
                </li>

            </ul>
        </nav>

        <main>

            <header class="profile">

                <div class="profile-image">
                        <img src="public/img/upload/profile-image.jpg">
                </div>
                <div class="profile-info">
                    <p>Jestem studentem PK itd itp</p>
                </div>
                <button>EDIT</button>
            </header>

            <section class="projects">
                <?php foreach ($projects as $project): ?>
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
                        </div>
                    </div>
                <?php endforeach; ?>
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