window.onload = () => {
  $(".loader-page").css({ visibility: "hidden", opacity: "0" });
};

const registrarse = document.getElementById("registrarse");
const login = document.getElementById("login");
if (registrarse) {
  registrarse.addEventListener("click", () => {
    localStorage.removeItem("id_usuario");
    localStorage.removeItem("carrito_compra");
    localStorage.removeItem("id_prodc_elegido");
  });
}
if (login) {
  login.addEventListener("click", () => {
    localStorage.removeItem("id_usuario");
    localStorage.removeItem("carrito_compra");
    localStorage.removeItem("id_prodc_elegido");
  });
} else {
  const btn_logout = document.getElementById("btn_logout");
  if (btn_logout) {
    btn_logout.addEventListener("click", () => {
      localStorage.removeItem("id_usuario");
      localStorage.removeItem("carrito_compra");
      localStorage.removeItem("id_prodc_elegido");
    });
  }
}
