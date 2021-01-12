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
                <div id="recipe-1">
                    <img src="public/upload/<?= $recipe->getImage() ?>">
                    <div>
                        <h2><?= $recipe->getTitle() ?></h2>
                        <p><?= $recipe->getDescription() ?></p>
                        <div class="social-section">
                            <i class="fas fa-heart">600</i>
                            <i class="fas fa-minus-square">121</i>
                        </div>
                    </div>
                </div>
                <div id="recipe-1">
                    <img src="public/img/upload/salatka_meksykanska.jpg"> 
                    <div>
                        <h2>Zupa grzybowa</h2>
                        <p>Salatka</p>
                        <div class="social-section">
                            <i class="fas fa-heart">600</i>
                            <i class="fas fa-minus-square">121</i>
                        </div>
                    </div>
                </div><div id="recipe-1">
                    <img src="public/img/upload/salatka_meksykanska.jpg"> 
                    <div>
                        <h2>Kurczak</h2>
                        <p>Salatka</p>
                        <div class="social-section">
                            <i class="fas fa-heart">600</i>
                            <i class="fas fa-minus-square">121</i>
                        </div>
                    </div>
                </div><div id="recipe-1">
                    <img src="public/img/upload/salatka_meksykanska.jpg"> 
                    <div>
                        <h2>Ryba</h2>
                        <p>Salatka</p>
                        <div class="social-section">
                            <i class="fas fa-heart">600</i> 
                            <i class="fas fa-minus-square">121</i>
                        </div>
                    </div>
                </div><div id="recipe-1">
                    <img src="public/img/upload/salatka_meksykanska.jpg"> 
                    <div>
                        <h2>Sok</h2>
                        <p>Salatka</p>
                        <div class="social-section">
                            <i class="fas fa-heart">600</i>
                            <i class="fas fa-minus-square">121</i>
                        </div>
                    </div>
                </div><div id="recipe-1">
                    <img src="public/img/upload/salatka_meksykanska.jpg"> 
                    <div>
                        <h2>Drinki</h2>
                        <p>Salatka</p>
                        <div class="social-section">
                            <i class="fas fa-heart">600</i>
                            <i class="fas fa-minus-square">121</i>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>

</body>