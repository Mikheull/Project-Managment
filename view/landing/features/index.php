<?php require_once ('view/components/navbar-header-light.php') ;?>

    <section class="container-fluid p-0">

        <div class="page_head row justify-content-md-center">
            <div class="col-12 margin-bot-lg margin-top-lg">
                <h2 class="title-lg bold color-dark margin-bot">Nos Fonctionnalités</h2>
                <h3 class="title-sm color-gray">Découvrez les différentes fonctions d'Improove</h3>
            </div>
        </div>

        <div>
            <nav id="cd-vertical-nav">
                <ul>
                    <li> <a href="#section1" data-number="1"> <span class="cd-dot"></span> <span class="cd-label color-dark">Gestion de projet</span> </a></li>
                    <li> <a href="#section2" data-number="2"> <span class="cd-dot"></span> <span class="cd-label color-dark">Gestion d'équipe</span> </a></li>
                    <li> <a href="#section3" data-number="3"> <span class="cd-dot"></span> <span class="cd-label color-dark">Messenger</span> </a></li>
                    <li> <a href="#section4" data-number="4"> <span class="cd-dot"></span> <span class="cd-label color-dark">Calendrier</span> </a></li>
                    <li> <a href="#section5" data-number="5"> <span class="cd-dot"></span> <span class="cd-label color-dark">UML</span> </a></li>
                    <li> <a href="#section6" data-number="6"> <span class="cd-dot"></span> <span class="cd-label color-dark">Recherche utilisateur</span> </a></li>
                    <li> <a href="#section7" data-number="7"> <span class="cd-dot"></span> <span class="cd-label color-dark">Bug Tracker</span> </a></li>
                    <li> <a href="#section8" data-number="8"> <span class="cd-dot"></span> <span class="cd-label color-dark">Documents</span> </a></li>
                </ul>
            </nav>

            <div class="container">
                <div class="row">
                    <section id="section1" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/gestion-project.php') ;?> </section>
                    <section id="section2" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/gestion-equipe.php') ;?> </section>
                    <section id="section3" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/messenger.php') ;?> </section>
                    <section id="section4" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/calendar.php') ;?> </section>
                    <section id="section5" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/uml.php') ;?> </section>
                    <section id="section6" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/recherche-user.php') ;?> </section>
                    <section id="section7" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/bug-tracker.php') ;?> </section>
                    <section id="section8" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/document.php') ;?> </section>
                </div>
            </div>
            
        </div>

    </section>

<?php require_once ('view/components/footer.php') ;?>


<script>
    
jQuery(document).ready(function($){
	var contentSections = $('.cd-section'),
		navigationItems = $('#cd-vertical-nav a');

	updateNavigation();
	$(window).on('scroll', function(){
		updateNavigation();
	});

	//smooth scroll to the section
	navigationItems.on('click', function(event){
        event.preventDefault();
        smoothScroll($(this.hash));
    });
    //smooth scroll to second section
    $('.cd-scroll-down').on('click', function(event){
        event.preventDefault();
        smoothScroll($(this.hash));
    });

    //open-close navigation on touch devices
    $('.touch .cd-nav-trigger').on('click', function(){
    	$('.touch #cd-vertical-nav').toggleClass('open');
  
    });
    //close navigation on touch devices when selectin an elemnt from the list
    $('.touch #cd-vertical-nav a').on('click', function(){
    	$('.touch #cd-vertical-nav').removeClass('open');
    });

	function updateNavigation() {
		contentSections.each(function(){
			$this = $(this);
			var activeSection = $('#cd-vertical-nav a[href="#'+$this.attr('id')+'"]').data('number') - 1;
			if ( ( $this.offset().top - $(window).height()/2 < $(window).scrollTop() ) && ( $this.offset().top + $this.height() - $(window).height()/2 > $(window).scrollTop() ) ) {
				navigationItems.eq(activeSection).addClass('is-selected');
			}else {
				navigationItems.eq(activeSection).removeClass('is-selected');
			}
		});
	}

	function smoothScroll(target) {
        $('body,html').animate(
        	{'scrollTop':target.offset().top},
        	600
        );
	}
});
</script>