

var sign_in_btn = $("#sign-in-btn");
var sign_up_btn = $("#sign-up-btn");
var container = $(".container");


sign_up_btn.click(function () {
  container.addClass("sign-up-mode");
})

sign_in_btn.click(function () {
  container.removeClass("sign-up-mode");
})



var funcionSubmit = (event) => {
  event.preventDefault();
  var datos = $(event.target).serialize();

  $.ajax({
    type: "POST",
    url: "Controllers/User.php",
    data: datos,

    error: function () {
      alert("No se pudo obtner informacion del servidor");
    },
    success: function (res) {
      if (res == 'correcto') {
        alertify.notify('Iniciando...', '', 5);
        setTimeout(
          function () {
            location.href = "inicio.php";
          }, 1000);
      } else {
        setTimeout(
          function () {
            location.href = "index.php";
          }, 1500);
      }
    }
  });
}





$(document).ready(function () {

});
