<?php

foreach($allResearchs['content'] as $research){
    ?> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/<?= $research['research_token'] ?>"><?= $research['name'] ?></a> <?php
}

?>