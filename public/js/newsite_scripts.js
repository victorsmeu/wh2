(function(c){var b="ScrollIt",a="1.0.1";var d={upKey:38,downKey:40,easing:"linear",scrollTime:600,activeClass:"active",onPageChange:null,topOffset:0};c.scrollIt=function(m){var h=c.extend(d,m),g=0,k=c("[data-scroll-index]:last").attr("data-scroll-index");var i=function(n){if(n<0||n>k){return}var o=c("[data-scroll-index="+n+"]").offset().top+h.topOffset;c("html,body").animate({scrollTop:o,easing:h.easing},h.scrollTime)};var j=function(o){var n=c(o.target).attr("data-scroll-nav")||c(o.target).attr("data-scroll-goto");i(parseInt(n))};var f=function(o){var n=o.which;if(n==h.upKey&&g>0){i(parseInt(g)-1);return false}else{if(n==h.downKey&&g<k){i(parseInt(g)+1);return false}}return true};var l=function(n){if(h.onPageChange&&n&&(g!=n)){h.onPageChange(n)}g=n;c("[data-scroll-nav]").removeClass(h.activeClass);c("[data-scroll-nav="+n+"]").addClass(h.activeClass)};var e=function(){var n=c(window).scrollTop();var p=c("[data-scroll-index]").filter(function(q,r){return n>=c(r).offset().top+h.topOffset&&n<c(r).offset().top+(h.topOffset)+c(r).outerHeight()});var o=p.first().attr("data-scroll-index");l(o)};c(window).on("scroll",e).on("scroll");c(window).on("keydown",f);c("body").on("click","[data-scroll-nav], [data-scroll-goto]",j)}}(jQuery));

$(document).ready(function(){
    window.scrollReveal = new scrollReveal();
    $.scrollIt();
    
    
    $(".computer_image a").click(function(e){
        e.preventDefault();
        $(".computer_image #movie_frame").html('<iframe src="https://www.youtube.com/embed/0N29wWZ82QU?rel=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>');
    });

    if($(window).height()>($("body").height())){
        $("footer").addClass("fixed");
    }

    $(".first_element").click(function(e){
        e.preventDefault();
        $(".menu1 li").show();
        $(".first_element").hide();
    });

    /*Mobile modifications*/
    var isMobile = window.matchMedia("only screen and (max-width: 640px)");
    if (isMobile.matches) {
        
        $(document).click(function(e) {
            var container = $(".menu1");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if($(".first_element").is(":hidden")){
                    $(".menu1 li").hide();
                    $(".first_element").show();
                }
            }
        });
    
        $( window ).scroll(function() {
            if($(".first_element").is(":hidden")){
                $(".menu1 li").hide();
                $(".first_element").show();
            }
        });    
    }

// Smooth Scroll
	smoothScroll.init({
		speed: 500, // Integer. How fast to complete the scroll in milliseconds
		easing: 'easeInOutCubic', // Easing pattern to use
		updateURL: false, // Boolean. Whether or not to update the URL with the anchor hash on scroll
		offset: 1, // Integer. How far to offset the scrolling anchor location in pixels
		callbackBefore: function ( toggle, anchor ) {}, // Function to run before scrolling
		callbackAfter: function ( toggle, anchor ) {} // Function to run after scrolling
	});	
});