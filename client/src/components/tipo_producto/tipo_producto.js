// para muestrar las ventanitas
const opc_create = document.getElementById("opc_create");

// para cerrar las ventanitas
const close_create = document.getElementById("close_create");
const close_see = document.getElementById("close_see");
const close_edit = document.getElementById("close_edit");
const close_delete = document.getElementById("close_delete");
const listo_see = document.getElementById("listo_see");

// ------------- start open view -------------
opc_create.addEventListener("click", function () {
  document.getElementById("view_create").classList.add("visible");
});
// ------------- finish open view -------------

// ------------- start close views -------------
listo_see.addEventListener("click", function () {
  document.getElementById("view_see").classList.remove("visible");
});
close_create.addEventListener("click", function () {
  document.getElementById("view_create").classList.remove("visible");
});
close_see.addEventListener("click", function () {
  document.getElementById("view_see").classList.remove("visible");
});
close_edit.addEventListener("click", function () {
  document.getElementById("view_edit").classList.remove("visible");
});
close_delete.addEventListener("click", function () {
  document.getElementById("view_delete").classList.remove("visible");
});
// ------------- finish close views -------------

//------------------------------------------------
// ------------- start open view see -------------
//------------------------------------------------
const base = "http://127.0.0.1:8000/api";
//------------------------------------------------
function see($id) {
  document.getElementById("view_see").classList.add("visible");

  // conseguimos los datos
  fetch(`${base}/tipos_productos/show/${$id}`)
    .then((res) => res.json())
    .then((res) => {
      document.getElementById("id_see").value = res["id"];
      document.getElementById("visible_see").value = res["visible"];
      document.getElementById("state_see").value = res["estado"];
      document.getElementById("name_see").value = res["nombre"];
      document.getElementById("created_at_see").value = res["created_at"];
      document.getElementById("updated_at_see").value = res["updated_at"];
    });
}
// ------------- finish open viwe see -------------

// ------------- start open view edit -------------
function edit($id) {
  document.getElementById("view_edit").classList.add("visible");
  fetch(`${base}/tipos_productos/show/${$id}`)
    .then((res) => res.json())
    .then((res) => {
      document.getElementById("id_edit").value = res["id"];
      document.getElementById("visible_edit").value = res["visible"];
      document.getElementById("state_edit").value = res["estado"];
      document.getElementById("name_edit").value = res["nombre"];
    });
}
// ------------- finish open view edit -------------

// ------------- start open view delete -------------
function cleanUp($id) {
  document.getElementById("view_delete").classList.add("visible");
  fetch(`${base}/tipos_productos/show/${$id}`)
    .then((res) => res.json())
    .then((res) => {
      document.getElementById("id_delete").value = res["id"];
      document.getElementById("name_delete").value = res["nombre"];
    });
  document.getElementById("view_delete").classList.add("visible");
}
// ------------- finish open view edit -------------
