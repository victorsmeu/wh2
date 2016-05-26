$(document).ready(function(){
    if($(".alert").length) {
        $(".alert").fadeIn("slow").slideDown("slow").delay(4000).slideUp('fast');
    }
    
    $(".navbar-toggle").click(function(e) {
        if(!$(".sidebar-nav").hasClass("in")) {
            $("#page-wrapper").addClass("shrinked");
        } else {
            $("#page-wrapper").removeClass("shrinked");
        }
    })
})