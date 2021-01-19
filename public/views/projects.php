<!DOCTYPE html>

<head> 
    
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">

    <script src="https://kit.fontawesome.com/4b321f22ba.js" crossorigin="anonymous"></script>

    <title>RECIPES</title>

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

            <header>

                <div class="search_bar">
                    <form>
                        <input placeholder="Search recipes">
                    </form>
                </div>

                <button>TOP</button>
                <button>SEARCH BY INGREDIENTS</button>
                <button>CREATE</button>

            </header>

            <section class="recipes">
                <?php foreach($projects as $project): ?>
                <div id="recipe-1">
                    <img src="public/upload/<?= $project->getImage(); ?>">
                    <div>
                        <h2><?= $project->getTitle(); ?></h2>
                        <p><?= $project->getDescription(); ?></p>
                        <div class="social-section">
                            <i class="fas fa-heart">88</i>
                            <i class="fas fa-minus-square">121</i>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>

        </main>

    </div>

</body>