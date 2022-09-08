import * as link from "./../Modules/links.js";
const mobileScreen = window.matchMedia("(max-width: 990px )");
    $(document).ready(function () {
        $(".dashboard").toggleClass("dashboard-compact");
$(".dashboard-nav-dropdown-toggle").click(function () {
    $(this).closest(".dashboard-nav-dropdown")
        .toggleClass("show")
        .find(".dashboard-nav-dropdown")
        .removeClass("show");
    $(this).parent()
        .siblings()
        .removeClass("show");
});

$(".menu-toggle").click(function () {
    if (mobileScreen.matches) {
        $(".dashboard-nav").toggleClass("mobile-show");
        $(".status_sesion").toggleClass("mobile-status-sesion-show");
    } else {
        $(".dashboard").toggleClass("dashboard-compact");
    }
});

    });