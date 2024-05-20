console.log("Executed");

$("nav .navbar-nav a").on("click", function () {
  $(".navbar-collapse").collapse("hide");
});
$(window).on("click", function () {
  $(".navbar-collapse").collapse("hide");
});
