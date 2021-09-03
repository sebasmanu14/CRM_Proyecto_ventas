//=============================================================//
const base = "http://127.0.0.1:8000/api";
var id_usuario = JSON.parse(localStorage.getItem("id_usuario"));
const btn_comprar_mas = document.getElementById("btn_comprar_mas");
const btn_elegir_producto = document.getElementById("btn_elegir_producto");
var carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
const comprar = document.getElementById("comprar");
var cuenta_banco = JSON.parse(localStorage.getItem("cuenta_banco"));

if (cuenta_banco) {
  switch (cuenta_banco) {
    case 1:
      document.getElementById("mssg_cuenta_banco_1").style.display = "block";
      break;
    case 2:
      document.getElementById("mssg_cuenta_banco_2").style.display = "block";
      break;
    case 3:
      document.getElementById("mssg_cuenta_banco_3").style.display = "block";
      break;
  }
}
localStorage.removeItem("cuenta_banco");

//=============================================================//
function subtract(id) {
  var carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
  $.each(Array.from(carrito_compra[1]), (i, item) => {
    if (item.id == id) {
      if (item.cantidad > 1) {
        item.cantidad -= 1;
        localStorage.setItem("carrito_compra", JSON.stringify(carrito_compra));
      }
    }
  });
  window.location.reload(true);
}
function add(id) {
  var carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
  $.each(Array.from(carrito_compra[1]), (i, item) => {
    if (item.id == id) {
      item.cantidad += 1;
      localStorage.setItem("carrito_compra", JSON.stringify(carrito_compra));
    }
  });
  window.location.reload(true);
}
function clearUp(id) {
  var carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
  $.each(Array.from(carrito_compra[1]), (i, item) => {
    if (item.id == id) {
      carrito_compra[1].splice(i, 1);
      localStorage.setItem("carrito_compra", JSON.stringify(carrito_compra));
    }
  });
  window.location.reload(true);
}

//=============================================================//
if (btn_elegir_producto) {
  btn_elegir_producto.addEventListener("click", function () {
    window.location.replace("../compra/compra.php");
  });
}
if (btn_comprar_mas) {
  btn_comprar_mas.addEventListener("click", function () {
    window.location.replace("../compra/compra.php");
  });
}
//=============================================================//
// HACER FACTURA
if (carrito_compra && carrito_compra[1] && carrito_compra[1].length > 0) {
  if (btn_comprar_mas) {
    btn_comprar_mas.style.visibility = "visible";
  }
  if (comprar) {
    comprar.style.visibility = "visible";
  }
  if (btn_elegir_producto) {
    btn_elegir_producto.style.visibility = "hidden";
  }
} else {
  if (btn_comprar_mas) {
    btn_comprar_mas.style.visibility = "hidden";
  }
  if (comprar) {
    comprar.style.visibility = "hidden";
  }
  if (btn_elegir_producto) {
    btn_elegir_producto.style.visibility = "visible";
  }
}

//=============================================================//
// IMPRIMIMOS DATOS EN EL CARRITO
if (carrito_compra) {
  var carrito = Array.from(carrito_compra[1]);
  if (carrito.length != 0) {
    //=============================================================//
    $.each(carrito, (i, item) => {
      var fila = document.createElement("tr");

      var columna_2 = document.createElement("th");
      columna_2.className = "body_iteam";
      columna_2.appendChild(document.createTextNode(item.tipo_producto_fk));
      var columna_3 = document.createElement("th");
      columna_3.className = "body_iteam";
      columna_3.appendChild(document.createTextNode(item.nombre));
      var columna_4 = document.createElement("th");
      columna_4.className = "body_iteam";
      columna_4.appendChild(document.createTextNode(item.precio));
      var columna_5 = document.createElement("th");
      columna_5.className = "body_iteam";
      columna_5.appendChild(document.createTextNode(item.cantidad));
      var columna_6 = document.createElement("th");
      columna_6.className = "body_iteam";
      columna_6.appendChild(document.createTextNode(item.descripcion));

      var fila_btns = document.createElement("th");
      fila_btns.className = "body_iteam";
      fila_btns.id = "fila_btns";

      fila.appendChild(columna_2);
      fila.appendChild(columna_3);
      fila.appendChild(columna_4);
      fila.appendChild(columna_5);
      fila.appendChild(columna_6);
      fila.appendChild(fila_btns);
      document.getElementById("fila").insertAdjacentElement("afterbegin", fila); //beforeend

      var btn_1 = `<th class="body_iteam"><button onclick='subtract(${item.id})' class='my_btn'>Restar</button></th>`;
      var btn_2 = `<th class="body_iteam"><button onclick='add(${item.id})' class='my_btn'>Añadir</button></th>`;
      var btn_3 = `<th class="body_iteam"><button onclick='clearUp(${item.id})' class='my_btn'>Eliminar</button></th>`;
      document.getElementById("fila_btns").innerHTML = btn_1 + btn_2 + btn_3;
    });
  }
}

//===========================================================================//
// + COMFIRMAR LA FACTURA
var view_hacer_factura = document.getElementById("view_hacer_factura");
if (comprar) {
  const close_hacer_factura = document.getElementById("close_hacer_factura");
  const comprar = document.getElementById("comprar");
  close_hacer_factura.addEventListener("click", function () {
    view_hacer_factura.classList.remove("visible");
  });
  comprar.addEventListener("click", () => {
    view_hacer_factura.classList.add("visible");
  });
}
var listo_factura = document.getElementById("listo_factura");
var view_factura_realizada = document.getElementById("view_factura_realizada");
if (listo_factura) {
  listo_factura.addEventListener("click", () => {
    view_hacer_factura.classList.remove("visible");
    view_factura_realizada.classList.remove("visible");
    localStorage.removeItem("id_venta"),
      localStorage.removeItem("carrito_compra");
    window.location.replace("../compra/compra.php");
  });
}
// - COMFIRMAR LA FACTURA
//===========================================================================//
carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
var carrito = null;
if (carrito_compra) {
  carrito = Array.from(carrito_compra[1]);
}
var total = 0;
const descuento = 0;
const iva = 0.12;
var data = null;
const id_venta = null;
const finalizar_comprar = document.getElementById("finalizar_comprar");
finalizar_comprar.addEventListener("click", () => {
  document.getElementById("view_factura_realizada").classList.add("visible");
  document.getElementById("view_hacer_factura").classList.remove("visible");
  if (carrito.length > 0) {
    carrito.forEach((producto) => {
      total += producto.precio * producto.cantidad;
    });
    total = total + total * iva;
  }
  data = {
    visible: 1,
    estado: 1,
    cliente_fk: JSON.parse(carrito_compra[0].usuario),
    tipo_pago_fk: 1,
    total: total,
    iva: iva,
    descuento: descuento,
  };
  fetch(`${base}/ventas/store`, {
    method: "POST",
    mode: "cors",
    cache: "no-cache",
    credentials: "same-origin",
    headers: { "Content-Type": "application/json" },
    redirect: "follow",
    referrerPolicy: "no-referrer",
    body: JSON.stringify(data),
  })
    .then((res) => res.json())
    .then((res) => {
      carrito.forEach((producto) => {
        data = {
          visible: 1,
          estado: 1,
          venta_fk: res,
          producto_fk: producto.id,
          cantidad: producto.cantidad,
        };
        fetch(`${base}/detalles_venta/store`, {
          method: "POST",
          mode: "cors",
          cache: "no-cache",
          credentials: "same-origin",
          headers: { "Content-Type": "application/json" },
          redirect: "follow",
          referrerPolicy: "no-referrer",
          body: JSON.stringify(data),
        });
      });
    });
});
