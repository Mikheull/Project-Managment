<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="content light-border p-3">
                <div class="heading mr-bot flex justify-content-between"> 
                    <span class="color-dark text-sm">Sondage</span> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/<?= $router -> getRouteParam("5") ?>/survey/create" class="link primary-link"> <i data-feather="plus-circle"></i> </a>
                </div>

                <div class="body">
                    <?php
                        $allSurvey = $recherche_utilisateur -> getSurvey( $router -> getRouteParam("2") );
                        foreach($allSurvey['content'] as $surv){
                            ?> 
                                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/<?= $router -> getRouteParam("5") ?>/survey/<?= $surv['survey_token'] ?>"><?= $surv['name'] ?></a> 
                                <a href="<?= $config -> rootUrl() ;?>survey/<?= $surv['survey_token'] ?>" target="blank"> <i data-feather="link"></i> </a>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-12 mr-top">
            <div class="content light-border p-3">
                <div class="heading mr-bot flex justify-content-between"> 
                    <span class="color-dark text-sm">Diagrammes d'affinité</span> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/<?= $router -> getRouteParam("5") ?>/affinity-diagram/create" class="link primary-link"> <i data-feather="plus-circle"></i> </a>
                </div>

                <div class="body">
                    Liste des diagrammes
                </div>
            </div>
        </div>
    </div>

</div>