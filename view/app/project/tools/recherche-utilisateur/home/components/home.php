<ul>
    <?php
        foreach($allResearchs['content'] as $research){
            ?> 
                <li class="col-md-5 col-12 pl-0">
                    <div class="pt-3 pb-3 container light-border mr-bot">
                        <div class="row">
                            <div class="col-10"> <span class="text-sm"><?= $research['name'] ?></span> </div>
                            <div class="col-2 text-align-right"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/recherche-utilisateur/<?= $research['research_token']?>"> <i class="fas fa-arrow-right"></i> </a> </div>
                        </div>
                    </div>
                </li> 
            <?php
        }
    ?>
</ul>