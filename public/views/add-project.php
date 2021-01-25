<!DOCTYPE html>

<head> 
    
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">

    <script src="https://kit.fontawesome.com/4b321f22ba.js" crossorigin="anonymous"></script>

    <title>RECIPES</title>

</head>

<body>

    <div class="base-container">
        <?php include('nav.php') ?>

        <main>

            <?php include('header.php') ?>

            <section class="projects">
                <h1>UPLOAD</h1>
                <form action="addProject" method="POST" ENCTYPE="multipart/form-data">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                    <input name="title" type="text" placeholder="Title">
                    <textarea name="description" rows="5" placeholder="Description"></textarea>
                    <input name="kcal" type="text" placeholder="kcal">
                    <input name="time" type="text" placeholder="time">

                    <input type="file" name="file">
                    <button type="submit">Send</button>
                </form>

            </section>

        </main>

    </div>

</body>