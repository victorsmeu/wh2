$(document).ready(function(){
    if($(".alert").length) {
        $(".alert").fadeIn("slow").slideDown("slow").delay(4000).slideUp('fast');
    }
    
    this.window = $(window);
    this.screen = $(screen);
    
    width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
    
    if(width > 767) {
        $(".navbar-toggle").click(function(e) {
            if(!$(".sidebar-nav").hasClass("in")) {
                $("#page-wrapper").addClass("shrinked");
            } else {
                $("#page-wrapper").removeClass("shrinked");
            }
        });
    }
})