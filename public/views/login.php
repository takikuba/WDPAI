<!DOCTYPE html>
<head>

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>

</head>

<body>
    
    <div class="container">

        <div class="logo">
            <img src="public/img/logo.svg">
        </div>

        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="name" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <button class="in" type="submit">SIGN IN</button>
                <button class="up" type="up">SIGN UP</button>
            </form>
        </div>

    </div>

</body>