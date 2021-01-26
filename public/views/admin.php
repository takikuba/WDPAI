<!DOCTYPE html>

<head>

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">

    <script src="https://kit.fontawesome.com/4b321f22ba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>

    <title>admin</title>

</head>

<body>

<div class="base-container">

    <?php include('nav.php') ?>

    <main>

        <section class="projects">
            <?php foreach ($users as $user): ?>
                <div id="<?= $user->getId(); ?>">
                    <img src="public/img/upload/profile-image.jpg">
                    <form method="post" action="removeUser">
                        <h2><?= $user->getName(); ?></h2>
                        <div class="profile-info">
                            <p><?= $user->getEmail(); ?></p>
                            <p><?= $user->getSurname(); ?></p>
                            <p><?= $user->getDescription(); ?></p>
                        </div>
                        <input name="rm" type="hidden" value="<?= $user->getEmail(); ?>">
                        <button>RM</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>

    </main>

</div>

</body>