
setTimeout(() => {
  $(".loader-page").css({ visibility: "hidden", opacity: "0" });
  window.location.replace("../dashboard/dashboard.php");
}, 1000);
