const rootUrl = 'http://localhost:8888/Improove/';


// Init
$(document).ready(function() {

    /**
     * Feather part
     */
    feather.replace()


    /**
     * Tippy part
     */
    tippy.setDefaults({
        animation: 'fade',
        arrow: true,
        arrowType: 'round',
    })
    

    /**
     * Select part
     */
    if ($("select")[0]){
        $('select').niceSelect();
    }

});



// Popup
$(document).ready(function() {

    
    /**
     * Declencheur
     */
    $( "#sidebar_pro-btn" ).click(function() {
        $(".sidebar-project-container .menu-wrapper").hide();
        $(".sidebar-project-container").animate({width:'toggle'},350);
        $(".sidebar-project-container .menu-wrapper").fadeIn( 1000 );
       
    });
    $( "#sidebar_pro-right-btn" ).click(function() {
        $(".sidebar-project-container-right .menu-wrapper").hide();
        $(".sidebar-project-container-right").animate({width:'toggle'},350);
        $(".sidebar-project-container-right .menu-wrapper").fadeIn( 1000 );
    });


    /**
     * Clic Echap
     */
    $(document).bind('keydown', function(e) {
        if(e.which == 27) {
            var container = Array('.sidebar-project-container', '.sidebar-project-container-right');
            container.forEach(function(element) {
                if ($(""+ element +"").css('display') == 'block'){
                    e.preventDefault();
                    $(""+ element +"").animate({width:'toggle'},350);
                }
            });

            return false;
        }
    });
    

    /**
     * Clic en dehors du wrapper
     */
    $(document).mouseup(function(e){
        var wrapper = $(".sidebar-project-container");
        if ($(".sidebar-project-container").css('display') == 'block'){
            if (!wrapper.is(e.target) && wrapper.has(e.target).length === 0) {
                $(".sidebar-project-container").animate({width:'toggle'},350);
            }
        }

        var wrapper = $(".sidebar-project-container-right");
        if ($(".sidebar-project-container-right").css('display') == 'block'){
            if (!wrapper.is(e.target) && wrapper.has(e.target).length === 0) {
                $(".sidebar-project-container-right").animate({width:'toggle'},350);
            }
        }
    });

});



// Responsive navbar header home landing
$(document).ready(function() {
    $( "#resp-nav-header-btn" ).click(function() {
        $(".navbar-resp-container").animate({width:'toggle'},350);
    });

    $(document).on("click", "#resp-nav-header-close-btn", function(e) {
        $(".navbar-resp-container").animate({width:'toggle'},350);
    });
});