<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">

        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.affinity.view')){

            if($recherche_utilisateur -> affinityDiagramIsOpen($router -> getRouteParam("7")) == false){
                ?>
                <div class="row mr-top-lg">
                    <div class="no-access">Ce diagramme n'est plus ouvert a d'autres réponses !</div>
                </div>
                <?php
            }
            ?>
            <div class="row mr-top-lg">
                <div class="col-md-3 col-12 light-border p-2">
                   <h2 class="title-sm bold color-lg-dark"><?= $utils -> getData('pr_user_research_affinity_diagram', 'name', 'diagram_token', $router -> getRouteParam("7")) ?></h2>
                </div>
            </div>
            <div class="row mr-top-lg">
                <div class="col-md-8 col-12 bg-light p-3 rounded">
                   <p><?= $utils -> getData('pr_user_research_affinity_diagram', 'topic', 'diagram_token', $router -> getRouteParam("7")) ?></p>
                </div>
            </div>


            <div class="row mr-top-lg">
                <?php
                    $allIdeas = $recherche_utilisateur -> getPendingIdea($router -> getRouteParam("7"));
                    if($utils -> getData('pr_user_research_affinity_diagram', 'need_approved', 'diagram_token', $router -> getRouteParam("7")) == true && $allIdeas['count'] !== 0 && $permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.affinity.approve')){
                        ?>
                            <div class="col-md-8 col-12 mr-bot-lg">
                                <h3 class="title-xs bold color-lg-dark mr-bot">Les idées en attente d'approbation</h3>
                                <div class="container-fluid">
                                    <div class="row">
                                        <?php
                                        foreach($allIdeas['content'] as $idea){
                                            ?>
                                                <div class="col-3 content light-border p-2">
                                                    <div class="heading flex justify-content-between"> 
                                                        <span class="color-dark text-sm"><?= $idea['name'] ?></span> 

                                                        <div>
                                                            <a href="" class="link dark-link" data-action="idea-approve" data-ref="<?= $router -> getRouteParam("7") ?>" data-pro="<?= $router -> getRouteParam("2") ?>" data-idea="<?= $idea['item_token'] ?>"> <i data-feather="check"></i> </a>
                                                            <a href="" class="link red-link" data-action="idea-remove" data-ref="<?= $router -> getRouteParam("7") ?>" data-pro="<?= $router -> getRouteParam("2") ?>" data-idea="<?= $idea['item_token'] ?>"> <i data-feather="x"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
                
                <div class="col-md-8 col-12 mr-bot">
                    <h3 class="title-xs bold color-lg-dark mr-bot">Les idées postées</h3>
                    <div class="container-fluid">
                        <div class="row">

                            <?php
                                if($utils -> getData('pr_user_research_affinity_diagram', 'need_approved', 'diagram_token', $router -> getRouteParam("7")) == true){
                                    $allIdeas = $recherche_utilisateur -> getApprovedIdea($router -> getRouteParam("7"));
                                }else{
                                    $allIdeas = $recherche_utilisateur -> getIdea($router -> getRouteParam("7"));
                                }

                                foreach($allIdeas['content'] as $idea){
                                    ?>
                                        <div class="col-lg-2 col-md-5 col-12 post-it-note mr-right mr-bot-lg color-dark">
                                            <p><?= $idea['name'] ?></p>
                                        </div>
                                    <?php
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mr-top-lg mr-bot-lg">
                <?php
                if($recherche_utilisateur -> affinityDiagramIsOpen($router -> getRouteParam("7")) == false){
                    ?>
                        <a class="btn btn-sm primary-btn mr-right" href="" data-action="affinity_diagram-reopen" data-ref="<?= $router -> getRouteParam("7") ?>" data-pro="<?= $router -> getRouteParam("2") ?>">Ré-ouvrir le diagramme</a>
                    <?php
                }else{
                    ?>
                        <a class="btn btn-sm primary-btn mr-right" href="" data-action="affinity_diagram-end" data-ref="<?= $router -> getRouteParam("7") ?>" data-pro="<?= $router -> getRouteParam("2") ?>">Fermer le diagramme</a>
                    <?php
                }
                ?>
                <a class="btn btn-sm dark-btn mr-right" href="<?= $config -> rootUrl() ;?>affinity-diagram/<?= $router -> getRouteParam("7") ?>" target="blank"> <i data-feather="link"></i> </a>
                <a class="btn btn-sm red-btn" href="" data-action="affinity_diagram-delete" data-ref="<?= $router -> getRouteParam("7") ?>" data-pro="<?= $router -> getRouteParam("2") ?>">Supprimer le diagramme</a>
            </div>
                
            <?php
        }else{
            ?>
            <div class="no-access">Vous n'avez pas la permission nécessaire pour accéder a ce contenu</div>
            <?php
        }
        ?>

    </div>

</div>


<div id="diagram_output"></div>