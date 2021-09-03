window.onload = function () {
  $(".loader-page").css({ visibility: "hidden", opacity: "0" });
};

var carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
const base = "http://127.0.0.1:8000/api";
const listo = document.getElementById("listo");
listo.addEventListener("click", () => {
  localStorage.removeItem("id_venta"),
    localStorage.removeItem("carrito_compra");
  window.location.replace("../compra/compra.php");
});
//===========================================================================//
// + IMPRIMIENDO DATOS DE LA FACTURA
sumaFecha = function (d, fecha) {
  var Fecha = new Date();
  var sFecha =
    fecha ||
    Fecha.getDate() + "/" + (Fecha.getMonth() + 1) + "/" + Fecha.getFullYear();
  var sep = sFecha.indexOf("/") != -1 ? "/" : "-";
  var aFecha = sFecha.split(sep);
  var fecha = aFecha[2] + "/" + aFecha[1] + "/" + aFecha[0];
  fecha = new Date(fecha);
  fecha.setDate(fecha.getDate() + parseInt(d));
  var anno = fecha.getFullYear();
  var mes = fecha.getMonth() + 1;
  var dia = fecha.getDate();
  mes = mes < 10 ? "0" + mes : mes;
  dia = dia < 10 ? "0" + dia : dia;
  var fechaFinal = dia + sep + mes + sep + anno;
  return fechaFinal;
};

const tiempoTranscurrido = Date.now();
const hoy = new Date(tiempoTranscurrido);
const id_user = JSON.parse(localStorage.getItem("id_usuario"));
if (id_user) {
  fetch(`${base}/clientes/show/${id_user}`)
    .then((res) => res.json())
    .then((usuario) => {
      document.getElementById("emai").innerHTML = `E-mail: ${usuario.correo}`;
      document.getElementById(
        "telefono"
      ).innerHTML = `Tel: ${usuario.numero_telefono}`;
      // Datos bacarios
      document.getElementById(
        "titular_cuenta"
      ).innerHTML = `Titular de la cuenta: ${usuario.nombres} ${usuario.apellidos}`;
      document.getElementById(
        "iban"
      ).innerHTML = `Iban: ${usuario.cuenta_bancaria_fk.numero_cuenta}`;
      // Factura
      document.getElementById(
        "fecha"
      ).innerHTML = `Fecha: ${hoy.toDateString()}`;
      document.getElementById(
        "num_factura"
      ).innerHTML = `Factura número : ${1}`;
      document.getElementById(
        "vence_factura"
      ).innerHTML = `Vence factura: ${sumaFecha(7, hoy.toLocaleDateString())}`;
      document.getElementById(
        "nombre_cliente"
      ).innerHTML = `Nombre cliente: ${usuario.nombres} ${usuario.apellidos}`;
      document.getElementById(
        "nombre_empresa"
      ).innerHTML = `Nombre empresa: Start platinum`;
      document.getElementById(
        "direccion_empresa"
      ).innerHTML = `Dirección empresa: Av.Maldonado`;
      document.getElementById(
        "telefono_empresa"
      ).innerHTML = `Teléfono empresa: 2644269`;
    });
  // IMPRESIÓN DE PRODUCTOS DEL CARRITO A LA FACTURA
  //productos_factura
  carrito_compra = JSON.parse(localStorage.getItem("carrito_compra"));
  var carrito = Array.from(carrito_compra[1]);
  var total = null;
  const descuento = 0;
  const iva = 0.12;
  if (carrito.length != 0) {
    $.each(carrito, (i, producto) => {
      var fila = document.createElement("tr");
      var columna_1 = document.createElement("th");
      columna_1.appendChild(document.createTextNode(i + 1));
      var columna_2 = document.createElement("th");
      columna_2.appendChild(document.createTextNode(producto.cantidad));
      var columna_3 = document.createElement("th");
      columna_3.appendChild(document.createTextNode(producto.nombre));
      var columna_4 = document.createElement("th");
      columna_4.appendChild(document.createTextNode(producto.precio));
      var columna_5 = document.createElement("th");
      columna_5.appendChild(document.createTextNode(producto.tipo_producto_fk));
      var columna_6 = document.createElement("th");
      columna_6.appendChild(document.createTextNode(producto.descripcion));
      fila.appendChild(columna_1);
      fila.appendChild(columna_2);
      fila.appendChild(columna_3);
      fila.appendChild(columna_4);
      fila.appendChild(columna_5);
      fila.appendChild(columna_6);
      document
        .getElementById("productos_factura")
        .insertAdjacentElement("beforebegin", fila);
      // calculamos el total
      total += producto.precio * producto.cantidad;
    });
  }
  document.getElementById("descuento").innerHTML = `${descuento}`;
  document.getElementById("iva").innerHTML = `Iva: ${iva} %`;
  document.getElementById("total").innerHTML = `Total: $ ${
    total + total * iva
  }`;

  // - IMPRIMIENDO DATOS DE LA FACTURA
  //===========================================================================//

  //===========================================================================//
  // + IMPRIMIENDO FACTURA
  function imprimir_factura(id) {
    var paper = document.getElementById(id);
    paper.className = paper.className.replace("noprint", "printme");
    window.print();
  }
  // - IMPRIMIENDO FACTURA
  //===========================================================================//
} else {
  alert("Tu carrito de compra esta vacío!.\nCompra al menos un producto.");
  window.location.replace("../carrito/carrito.php");
}
