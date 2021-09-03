var carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
const grid = new Muuri(".grid", {
  layout: {
    rounding: false,
  },
});

var iduser = null;
window.addEventListener("load", () => {
  grid.refreshItems().layout();
  document.getElementById("grid").classList.add("imagenes-cargadas");

  // Agregamos los listener de los enlaces para filtrar por categoria.
  const enlaces = document.querySelectorAll("#categorias a");
  enlaces.forEach((elemento) => {
    elemento.addEventListener("click", (evento) => {
      evento.preventDefault();
      enlaces.forEach((enlace) => enlace.classList.remove("activo"));
      evento.target.classList.add("activo");

      const categoria = evento.target.innerHTML.toLowerCase();
      categoria === "todos"
        ? grid.filter("[data-categoria]")
        : grid.filter(`[data-categoria="${categoria}"]`);
    });
  });

  // Agregamos el listener para la barra de busqueda
  document
    .querySelector("#barra-busqueda")
    .addEventListener("input", (evento) => {
      const busqueda = evento.target.value;
      grid.filter((item) =>
        item.getElement().dataset.etiquetas.includes(busqueda)
      );
    });

  // Agregamos listener para las imagenes
  const overlay = document.getElementById("overlay");
  document.querySelectorAll(".grid .item img").forEach((elemento) => {
    elemento.addEventListener("click", () => {
      const ruta = elemento.getAttribute("src");
      const descripcion = elemento.parentNode.parentNode.dataset.descripcion;

      overlay.classList.add("activo");
      document.querySelector("#overlay img").src = ruta;
      document.querySelector("#overlay .descripcion").innerHTML = descripcion;
      localStorage.setItem(
        "id_prodc_elegido",
        JSON.stringify(elemento.parentNode.parentNode.dataset.idproducto)
      );
      iduser = elemento.parentNode.parentNode.dataset.iduser;
    });
  });
  // Eventlistener del boton de cerrar
  document.querySelector("#btn-cerrar-popup").addEventListener("click", () => {
    overlay.classList.remove("activo");
  });
  // Eventlistener del overlay
  overlay.addEventListener("click", (evento) => {
    evento.target.id === "overlay" ? overlay.classList.remove("activo") : "";
  });
});

// Eventlistener btn comparar
function comprar() {
  localStorage.setItem("id_usuario", JSON.stringify(iduser));
  //=============================================================//
  // CARRITO DE COMPRAS
  //=============================================================//
  const base = "http://127.0.0.1:8000/api";
  //=============================================================//
  // traemos id de producto elegido
  var id_prodc_elegido = JSON.parse(localStorage.getItem("id_prodc_elegido"));
  if (id_prodc_elegido != null) {
    fetch(`${base}/productos/show/${id_prodc_elegido}`)
      .then((producto) => producto.json())
      .then((producto) => {
        localStorage.removeItem("id_prodc_elegido");
        producto.cantidad = 1;
        var carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
        if (!carrito_compra || carrito_compra[1].length === 0) {
          var carrito_compra = [
            { usuario: JSON.parse(localStorage.getItem("id_usuario")) },
            [producto],
          ];
          localStorage.setItem(
            "carrito_compra",
            JSON.stringify(carrito_compra)
          );
        } else {
          var carrito_compra = JSON.parse(
            localStorage.getItem("carrito_compra")
          );
          var agregar = false;
          $.each(Array.from(carrito_compra[1]), (i, producto_carrito) => {
            if (parseInt(id_prodc_elegido) === parseInt(producto_carrito.id)) {
              agregar = false;
            } else {
              agregar = true;
            }
          });
          if (agregar) {
            // carrito de compra
            var carrito_compra = JSON.parse(
              localStorage.getItem("carrito_compra")
            );
            carrito_compra[1].push(producto);
            localStorage.setItem(
              "carrito_compra",
              JSON.stringify(carrito_compra)
            );
            localStorage.removeItem("producto_elegido");
          }
        }
      });
  }
  //=============================================================//
  window.location.reload("../carrito/carrito.php");
}
//Boton carrito//
var button_up = document.getElementById("button-up");
button_up.addEventListener("click", function () {
  var currentScroll =
    document.documentElement.scrollTop || document.body.scrollTop;
  if (currentScroll > 0) {
    window.scrollTo(0, 0);
  }
  window.location.replace("../carrito/carrito.php");
});

if (carrito_compra && carrito_compra[1] && carrito_compra[1].length > 0) {
  var cantidadProd = null;
  $.each(Array.from(carrito_compra[1]), (i, producto) => {
    cantidadProd += producto.cantidad;
  });
  document.getElementById("cantidad_prod_carrito").value = cantidadProd;
} else {
  document.getElementById("cantidad_prod_carrito").value = "0";
}
