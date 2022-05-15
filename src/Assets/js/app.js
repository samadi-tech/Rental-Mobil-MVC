const URL = "http://localhost/rental/public/index.php";

function NavbarToggle() {
  $(".nav-toggle").click((e) => {
    $(".nav-toggle").toggleClass("active-nav");
    $(".menu-nav").toggleClass("menu-active");
  });
}

$(document).ready(function () {
  NavbarToggle();
});
