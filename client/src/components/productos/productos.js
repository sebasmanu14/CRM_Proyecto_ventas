// para muestrar las ventanitas
const opc_create = document.getElementById("opc_create");
const opc_see = document.getElementById("opc_see");
const opc_edit = document.getElementById("opc_edit");
const opc_delete = document.getElementById("opc_delete");

// para cerrar las ventanitas
const close_create = document.getElementById("close_create");
const close_see = document.getElementById("close_see");
const close_edit = document.getElementById("close_edit");
const close_delete = document.getElementById("close_delete");
const listo_see = document.getElementById("listo_see");

// ------------- muestra ventanita
if (opc_create) {
  opc_create.addEventListener("click", function () {
    document.getElementById("view_create").classList.add("visible");
  });
}
if (opc_see) {
  opc_see.addEventListener("click", function () {
    document.getElementById("view_see").classList.add("visible");
  });
}
if (opc_edit) {
  opc_edit.addEventListener("click", function () {
    document.getElementById("view_edit").classList.add("visible");
  });
}
if (opc_delete){
  opc_delete.addEventListener("click", function () {
    document.getElementById("view_delete").classList.add("visible");
  });
}
// ------------- muestra ventanita

// ------------- cierra ventanita
if (listo_see) {
  listo_see.addEventListener("click", function () {
    document.getElementById("view_see").classList.remove("visible");
  });
}
if (close_create) {
  close_create.addEventListener("click", function () {
    document.getElementById("view_create").classList.remove("visible");
  });
}
if (close_see) {
  close_see.addEventListener("click", function () {
    document.getElementById("view_see").classList.remove("visible");
  });
}
if (close_edit) {
  close_edit.addEventListener("click", function () {
    document.getElementById("view_edit").classList.remove("visible");
  });
}
if (close_delete) {
  close_delete.addEventListener("click", function () {
    document.getElementById("view_delete").classList.remove("visible");
  });
}
// ------------- cierra ventanita

const base = "http://127.0.0.1:8000/api";
// ------------- start open view see -------------
function see($id) {
  document.getElementById("view_see").classList.add("visible");

  // conseguimos los datos
  fetch(`${base}/productos/show/${$id}`)
    .then((res) => res.json())
    .then((res) => {
      document.getElementById("id_see").value = res["id"];
      document.getElementById("visible_see").value = res["visible"];
      document.getElementById("state_see").value = res["estado"];
      document.getElementById("tipo_producto_see").value =
        res["tipo_producto_fk"];
      document.getElementById("name_see").value = res["nombre"];
      document.getElementById("fecha_fabricacion_see").value =
        res["fecha_fabricacion"];
      document.getElementById("fecha_vencimiento_see").value =
        res["fecha_vencimiento"];
      document.getElementById("precio_see").value = res["precio"];
      document.getElementById("cantidad_see").value = res["cantidad"];
      document.getElementById("descripcion_see").value = res["descripcion"];
      document.getElementById("created_at_see").value = res["created_at"];
      document.getElementById("updated_at_see").value = res["updated_at"];
    });
}
// ------------- finish open viwe see -------------

// ------------- start open view edit -------------
function edit($id) {
  document.getElementById("view_edit").classList.add("visible");
  fetch(`${base}/productos/show/${$id}`)
    .then((res) => res.json())
    .then((res) => {
      document.getElementById("id_edit").value = res["id"];
      document.getElementById("visible_edit").value = res["visible"];
      document.getElementById("state_edit").value = res["estado"];
      document.getElementById("name_edit").value = res["nombre"];
      document.getElementById("fecha_fabricacion_edit").value =
        res["fecha_fabricacion"];
      document.getElementById("fecha_vencimiento_edit").value =
        res["fecha_vencimiento"];
      document.getElementById("precio_edit").value = res["precio"];
      document.getElementById("cantidad_edit").value = res["cantidad"];
      document.getElementById("descripcion_edit").value = res["descripcion"];
      document.getElementById("created_at_edit").value = res["created_at"];
      document.getElementById("updated_at_edit").value = res["updated_at"];
    });
}
// ------------- finish open view edit -------------

// ------------- start open view delete -------------
function cleanUp($id) {
  document.getElementById("view_delete").classList.add("visible");
  fetch(`${base}/productos/show/${$id}`)
    .then((res) => res.json())
    .then((res) => {
      document.getElementById("id_delete").value = res["id"];
      document.getElementById("name_delete").value = res["nombre"];
    });
  document.getElementById("view_delete").classList.add("visible");
}
// ------------- finish open view edit -------------

// imprimiendo opc
