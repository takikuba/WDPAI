<!DOCTYPE html>
<head>

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/signup.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>SIGN UP</title>

</head>

<body>

    <div class="container">

        <div class="logo">
            <img src="public/img/logo.svg">
        </div>

        <div class="login-container">
            <form class="register" action="register" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <input name="confirmedPassword" type="password" placeholder="confirm password">
                <input name="name" type="text" placeholder="Name">
                <input name="surname" type="text" placeholder="Surname">

                <button type="submit">SIGN UP</button>
            </form>

        </div>

    </div>

</body>