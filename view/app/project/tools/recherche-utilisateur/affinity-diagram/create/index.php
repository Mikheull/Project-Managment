<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
    
    $allResearchs = $recherche_utilisateur -> getEtudes( $router -> getRouteParam('2') );
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">

        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.affinity.create')){
            ?>

                <div class="row">
                    <div class="col-12">
                        <h3 class="title-sm bold color-dark mr-top mr-bot">Créer un diagramme d'afinité</span></h3>
                    </div>

                    <div class="col-12">
                        <form method="POST">
                            <div class="input_group">
                                <div class="input-field input-half">
                                    <label for="name">Nom</label>
                                    <input type="text" name="name" id="name" placeholder="Nom" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                                </div>
                            </div>

                            <div class="input_group">
                                <div class="input-field input-half-al">
                                    <label for="topic">Topic</label>
                                    <textarea name="topic" id="topic" placeholder="Description"><?= isset($_POST['topic']) ? $_POST['topic'] : '' ?></textarea>
                                </div>
                            </div>


                            <div class="mr-top-lg">
                                <button class="btn primary-btn" name="create_diagram-affinity">Créer le diagramme</button>
                            </div>
                        </form>
                    </div>
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