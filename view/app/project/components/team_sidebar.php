<div class="sidebar-team">
    <div id="arrow_page"></div>

    <div class="name"> 
        <h2><?= $team -> getTeamData($team_token, 'name') ;?></h2>
    </div>

    <div class="navbar">
        <ul>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/overview"> Overview </a> </li>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/members"> Membres </a> </li>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/roles"> Rôles </a> </li>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/messenger"> Messenger </a> </li>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/plugins"> Plugins </a> </li>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/activity"> Activité </a> </li>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/settings"> Réglages </a> </li>
        </ul>
    </div>
</div>