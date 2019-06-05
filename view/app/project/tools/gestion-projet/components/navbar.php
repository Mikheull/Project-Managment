
<div class="container">
    <div class="navbar-app">
        <div class="row navbar-nav">
            <div class="col-md-8 col-12 nav-left">
                <ul class="text-align-left">
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="dark-link"> Gestion de projet </a> </li>
                    <li class="nav-item"> <a class="btn" id="navbar-submenu-btn"><i class="fas fa-ellipsis-h"></i></a> </li>
                </ul>
            </div>

            <div class="col-md-4 col-12 nav-right">
                <ul class="text-align-right">
                    <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div id="navbar-submenu"  class="hidden">
    <ul>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="light-link"> Overview </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="light-link"> Gestion d'équipe </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger" class="light-link"> Messenger </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar" class="light-link"> Calendrier </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="light-link"> UML </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="light-link"> Recherche utilisateur </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="light-link"> Bug Tracker </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="light-link"> documents </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/settings" class="light-link"> Réglages </a> </li>
    <ul>
</div>


<script>

    var template = document.getElementById('navbar-submenu')
    tippy('#navbar-submenu-btn', {
        content: template.innerHTML,
        animation: 'fade',
        theme: 'light-border',
        interactive: true,
        placement: 'bottom',
        arrowType: 'round',
        arrow: true,
    })

</script>