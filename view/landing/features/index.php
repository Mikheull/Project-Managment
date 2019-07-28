<?php require_once ('view/components/navbar-header-light.php') ;?>

    <section class="container-fluid p-0">

        <div class="page_head row justify-content-md-center">
            <div class="col-12 mr-bot-lg mr-top-lg">
                <h2 class="title-lg bold color-dark mr-bot">Nos Fonctionnalités</h2>
                <h3 class="title-sm color-gray">Découvrez les différentes fonctions d'Improove</h3>
            </div>
        </div>

        <div>
            <nav id="cd-vertical-nav">
                <ul>
                    <li> <a href="#gestion-de-projet" data-number="1"> <span class="cd-dot"></span> <span class="cd-label color-dark">Gestion de projet</span> </a></li>
                    <li> <a href="#gestion-equipe" data-number="2"> <span class="cd-dot"></span> <span class="cd-label color-dark">Gestion d'équipe</span> </a></li>
                    <li> <a href="#messenger" data-number="3"> <span class="cd-dot"></span> <span class="cd-label color-dark">Messenger</span> </a></li>
                    <li> <a href="#calendrier" data-number="4"> <span class="cd-dot"></span> <span class="cd-label color-dark">Calendrier</span> </a></li>
                    <li> <a href="#uml" data-number="5"> <span class="cd-dot"></span> <span class="cd-label color-dark">UML</span> </a></li>
                    <li> <a href="#recherche-utilisateur" data-number="6"> <span class="cd-dot"></span> <span class="cd-label color-dark">Recherche utilisateur</span> </a></li>
                    <li> <a href="#bug-tracker" data-number="7"> <span class="cd-dot"></span> <span class="cd-label color-dark">Bug Tracker</span> </a></li>
                    <li> <a href="#documents" data-number="8"> <span class="cd-dot"></span> <span class="cd-label color-dark">Documents</span> </a></li>
                </ul>
            </nav>

            <div class="container-fluid">
                <div class="row">
                    <section id="gestion-de-projet" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/gestion-project.php') ;?> </section>
                    <section id="gestion-equipe" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/gestion-equipe.php') ;?> </section>
                    <section id="messenger" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/messenger.php') ;?> </section>
                    <section id="calendrier" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/calendar.php') ;?> </section>
                    <section id="uml" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/uml.php') ;?> </section>
                    <section id="recherche-utilisateur" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/recherche-user.php') ;?> </section>
                    <section id="bug-tracker" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/bug-tracker.php') ;?> </section>
                    <section id="documents" class="col-12 cd-section"> <?php require_once ('view/landing/features/components/document.php') ;?> </section>
                </div>
            </div>
            
        </div>

    </section>

<?php require_once ('view/components/footer.php') ;?>
