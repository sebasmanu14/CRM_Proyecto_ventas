const btnIniciarSesion = document.getElementById("btn__registrarse");
btnIniciarSesion.addEventListener("click", () => {
  window.location.replace("../register/register.php");
});

//----------------------------------------------------------//
// MOSTRAMOS MENSAJES DE ACUERDO AL NUMERO EN LOCAL STORAGE //
//----------------------------------------------------------//
var tipo_error = localStorage.getItem("login");
switch (tipo_error) {
  case "1":
    document
      .getElementById("cont_msm_llenar_campso")
      .classList.remove("msm_llenar_campso");
    document.getElementById("cont_msm_llenar_campso").classList.add("mostrar");
    localStorage.removeItem("login");
    break;
  case "2":
    document
      .getElementById("cont_msm_no_usuario")
      .classList.remove("msm_no_usuario");
    document.getElementById("cont_msm_no_usuario").classList.add("mostrar");
    localStorage.removeItem("login");
    break;
  case "3":
    document
      .getElementById("cont_msm_pass_incorrect")
      .classList.remove("msm_no_usuario");
    document.getElementById("cont_msm_no_usuario").classList.add("mostrar");
    localStorage.removeItem("login");
    break;
  default:
    break;
}
