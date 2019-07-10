

<div id="navbar-submenu"  class="hidden">
    <ul class="margin-top margin-bot text-align-left">
        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/overview_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="dark-link"> Dashboard </a> 
        </li>

        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/project_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="dark-link"> Gestion de projet </a> 
        </li>

        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/team_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="dark-link"> Gestion d'équipe </a> 
        </li>
            
        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/messenger_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger" class="dark-link"> Messenger </a> 
        </li>

        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/calendar_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar" class="dark-link"> Calendrier </a> 
        </li>

        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/uml_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="dark-link"> UML </a> 
        </li>

        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/user_research_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="dark-link"> Recherche utilisateur </a> 
        </li>

        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/bug_tracker_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="dark-link"> Bug Tracker </a> 
        </li>

        <li class="nav-item margin-bot flex nav-item-mr"> 
            <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/documents_icon.svg" alt=""> 
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="dark-link"> Documents </a> 
        </li>

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