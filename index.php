<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Resources/img/homework.svg">
    <script src="https://kit.fontawesome.com/64d58efce2.js"  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Resources/css/login.css" />
    <link rel="stylesheet" href="Resources/css/alertify.css">
    <title>MyHomework - Entrar o Registrarse</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        
        <div class="signin-signup">

          <form class="sign-in-form" onsubmit="funcionSubmit(event)">
            <h2 class="title">Iniciar Sesion</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario" name="user" spellcheck="false" autocomplete="on"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" name="password" />
              <input type="hidden" name="action" value="sign-in">
            </div>
            <button type="submit" id="login-button" class="btn solid">Entrar</button>
          </form>


          <form action="#" class="sign-up-form" onsubmit="funcionSubmit(event)">
            <h2 class="title">Regístrate</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nombre" name="name"/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" placeholder="Usuario" name="user" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" name="password" />
              <input type="hidden" name="action" value="sign-up">
            </div>
            <button type="submit" class="btn">Crear cuenta</button>
          </form>
        </div>
      </div>

      <div class="panels-container">
        
        <div class="panel left-panel">
          <div class="content">
            <h3>¿Nuevo aquí?</h3>
            <p>
              Si aún no te has registrado puedes hacerlo mediante este enlace 
              <br>
              ¡Es gratis!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Regístrate
            </button>
          </div>
          <img src="Resources/img/acceder_azul.svg" class="image" alt="" style="max-width: 70%;"/>
        </div>


        <div class="panel right-panel">
          <div class="content">
          <h3>¿Ya eres uno de nosotros?</h3>
            <p>
              Si ya te has registrado antes puedes ingresar directamente desde
            </p>


            <button class="btn transparent" id="sign-in-btn">
              Aquí
            </button>

          </div>
          <img src="Resources/img/press_play_azul.svg" class="image" alt="" />
        </div>

      </div>
    </div>
    <script src="resources/js/jquery.js"></script>
    <script src="resources/js/alertify.js"></script>
    <script src="Resources/js/login.js"></script>
  </body>
</html>
