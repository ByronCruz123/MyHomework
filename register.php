<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profesores</title>
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
            <div class="container" style="height: 400px;">
                <h1 class="title_form">Nueva cuenta</h1>

                <form class="form" id="formulariosignup">
                    <input type="text" placeholder="Nombre" name="nombre" autocomplete="off" spellcheck="false" required>
                    <input type="text" placeholder="Apellido" name="apellido" autocomplete="off" spellcheck="false" required>
                    <input type="text" placeholder="Usuario" name="user" autocomplete="off" spellcheck="false" required>
                    <input type="password" placeholder="Contraseña" name="pass" required>
                    <button type="submit" data-action="signup" id="signup-button">Enviar</button>
                </form>
                <a href="index.php" class="new_account_link">Usar cuenta existente</a>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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