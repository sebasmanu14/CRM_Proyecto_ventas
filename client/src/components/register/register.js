const btnIniciarSesion = document.getElementById("btn__iniciar-sesion");
btnIniciarSesion.addEventListener("click", () => {
  window.location.replace("../login/login.php");
});

const cbox_cuenta_banco = document.getElementById("cbox_cuenta_banco");
cbox_cuenta_banco.addEventListener("click", () => {
  const cntnt_cnt_bnc = document.getElementById("content_cuenta_banco");
  if (cntnt_cnt_bnc.className == "content_cuenta_banco") {
    cntnt_cnt_bnc.classList.add("mostrar");
    cntnt_cnt_bnc.classList.remove("content_cuenta_banco");
  } else {
    cntnt_cnt_bnc.classList.add("content_cuenta_banco");
    cntnt_cnt_bnc.classList.remove("mostrar");
  }
});

//----------------------------------------------------------//
// MOSTRAMOS MENSAJES DE ACUERDO AL NUMERO EN LOCAL STORAGE //
//----------------------------------------------------------//
const tipo_error = localStorage.getItem("register");
switch (tipo_error) {
  case "1":
    document
      .getElementById("sms_llene_campos")
      .classList.remove("sms_llene_campos");
    document.getElementById("sms_llene_campos").classList.add("mostrar");
    localStorage.removeItem("register");
    break;
  case "2":
    document
      .getElementById("sms_inicie_session")
      .classList.remove("sms_inicie_session");
    document.getElementById("sms_inicie_session").classList.add("mostrar");
    localStorage.removeItem("register");
    break;
  case "4":
    document
      .getElementById("sms_cuenta_banco")
      .classList.remove("sms_cuenta_banco");
    document.getElementById("sms_cuenta_banco").classList.add("mostrar");
    localStorage.removeItem("register");
    break;
  default:
    break;
}
