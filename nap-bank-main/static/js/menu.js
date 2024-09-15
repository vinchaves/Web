$(".logo").on("click", () => {
  $("#mySidenav").css({ "width": "230px" })
  // $(".logo").css({ "boxShadow": "none" })
  $(".logo:hover").css({ "transition": "none" })
  $(".logo:hover").css({ "transform": "none" })
})

$(".closebtn").on("click", () => {
  $("#mySidenav").css({ "width": "0" })
  // $(".logo").css({ "boxShadow": "rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset" })
})

$("#botao-sair").on("click", async () => {
  await $.ajax({method: "POST", url: "/nap/api/sair.php"});
  window.location.href = "/nap/entrar.php";
})