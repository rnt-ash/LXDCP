function toggleSidebar() {
    $("#sidebarWrapper").toggleClass("large");
    $(".sideBarText").toggle();
}

$( document ).ready(function() {
    if($("#pageWrapper").hasClass("toggled")){
        toggleSidebar();
    }
    $("#menu-toggle").click(function(e) {
        toggleSidebar();
        e.preventDefault();
        $("#pageWrapper").toggleClass("toggled");
        $.ajax({
            url: "/index/toggleSidebar",
        });
    });
    
    var path = window.location.pathname;
    var start_pos = path.indexOf('/') + 1;
    var navpoint = path.substring(start_pos,path.indexOf('/',start_pos));
    if(navpoint != '/'){
        $("#sidebarWrapper .sidebar-nav li#" + navpoint + " a").addClass("active");
        $("#navbar .navbar-nav li#" + navpoint + " a").addClass("active");
    }
});