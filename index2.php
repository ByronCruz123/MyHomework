<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NoteClass - Ingresar</title>
    <link rel="icon" href="Resources/img/homework.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
    <link rel="stylesheet" type="text/css" href="resources/css/login.css">
</head>

<body>
    <div class="wrapper">
        <div class="contenido">
            <div class="container">
                <h1 class="title_form">Bienvenido</h1>

                <form class="form" id="formulariologin">
                    <input type="text" placeholder="Usuario" name="user" spellcheck="false" autocomplete="username">
                    <input type="password" placeholder="Contraseña" name="pass">
                    <button type="submit" id="login-button">Entrar</button>
                </form>
                <a href="register.php" class="new_account_link">No tienes una cuenta</a>

            </div>
        </div>
 

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>
<script src="resources/js/jquery.js"></script>
<script src="resources/js/functions.js"></script>
<script>
    $("#login-button").click(function (event) {
        event.preventDefault();
        $('.new_account_link').fadeOut(500);
        $('form').fadeOut(500);
        $('.wrapper').addClass('form-success');
    });
</script>

</html>