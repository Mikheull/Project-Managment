feather.replace()



const rootUrl = 'http://localhost:8888/Improove/';


// Partie du plugin Tippy

tippy.setDefaults({
    animation: 'fade',
    arrow: true,
    arrowType: 'round',
})


if ($("#notifications_tmpl")[0]){
    const template = document.getElementById('notifications_tmpl')
    const container = document.createElement('div')
    container.appendChild(document.importNode(template.content, true))

    tippy('.notification', {
        content: container.innerHTML,
        animation: 'fade',
        arrow: true,
        arrowType: 'round',
        interactive: true,
        onShow(instance) {
            $.ajax({
                url: rootUrl + 'controller/ajax/read_notif.php',
				type: 'POST',
				data: {},
				success:function(data){
                    console.log('show');
				}
			});
        },

    });

    
};


// Partie du plugin Select

$(document).ready(function() {
    if ($("select")[0]){
        $('select').niceSelect();
    }
});
$( "select[name='goto_project']" ).change(function() {
    var href = $('select[name="goto_project"]').val();
    location.href= "app/project/"+href;
});




// Partie du plugin fakeLoader
if ($(".fakeLoader")[0]){
    $(document).ready(function () {
        $.fakeLoader({
            timeToHide: 600,
            bgColor: '#4C6CF6',
            spinner:"spinner2"
        });
    });
}


// Responsive navbar header

$(document).ready(function() {
    $( "#resp-nav-header-btn" ).click(function() {
        $(".navbar-resp-container").animate({width:'toggle'},350);
    });

    $(document).on("click", "#resp-nav-header-close-btn", function(e) {
        $(".navbar-resp-container").animate({width:'toggle'},350);
    });
});
// Actions avec le clavier
$(document).bind('keydown', function(e) {
    // Bouton Echap pour quitter la création de fichiers / dossiers
    if(e.which == 27) {
        if ($(".navbar-resp-container").css('display') == 'block'){
            e.preventDefault();
            $(".navbar-resp-container").animate({width:'toggle'},350);
        }
        return false;
    }
});


$(document).mouseup(function(e){
    var container = $(".navbar-resp-container");
    if ($(".navbar-resp-container").css('display') == 'block'){

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $(".navbar-resp-container").animate({width:'toggle'},350);
        }
    }
});




// Responsive sidebar project

$(document).ready(function() {
    $( "#sidebar_pro-btn" ).click(function() {
        $(".sidebar-project-container").animate({width:'toggle'},350);
    });
});
// Actions avec le clavier
$(document).bind('keydown', function(e) {
    // Bouton Echap pour quitter la création de fichiers / dossiers
    if(e.which == 27) {
        if ($(".sidebar-project-container").css('display') == 'block'){
            e.preventDefault();
            $(".sidebar-project-container").animate({width:'toggle'},350);
        }
        return false;
    }
});


$(document).mouseup(function(e){
    var container = $(".sidebar-project-container");
    if ($(".sidebar-project-container").css('display') == 'block'){

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $(".sidebar-project-container").animate({width:'toggle'},350);
        }
    }
});