//_____________ INICIO LINKS _____________
const btn_logout = document.getElementById("btn_logout");
if (btn_logout) {
  btn_logout.addEventListener("click", function () {
    localStorage.removeItem("id_usuario");
    localStorage.removeItem("carrito_compra");
  });
}
//_____________ FIN LINKS _____________
