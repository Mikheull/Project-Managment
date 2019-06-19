
<div class="container">
    <div class="navbar-app">
        <div class="row navbar-nav">
            <div class="col-md-8 col-12 nav-left">
                <ul class="text-align-left">
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="dark-link"><i class="fas fa-home"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="dark-link"> Gestion d'équipe </a> </li>
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
    <ul class="margin-top margin-bot text-align-left">
        <li class="nav-item margin-bot"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="dark-link"> Overview </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="dark-link"> Gestion de projet </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="dark-link"> Gestion d'équipe </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger" class="dark-link"> Messenger </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar" class="dark-link"> Calendrier </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="dark-link"> UML </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="dark-link"> Recherche utilisateur </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="dark-link"> Bug Tracker </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="dark-link"> Documents </a> </li>
        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/settings" class="dark-link"> Réglages </a> </li>
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