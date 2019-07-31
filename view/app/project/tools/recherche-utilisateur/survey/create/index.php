<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
    
    $allResearchs = $recherche_utilisateur -> getEtudes( $router -> getRouteParam('2') );
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-12 navbar-app">
                    <div class="navbar-nav">
                        <ul class="text-align-left">
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/<?= $router -> getRouteParam("5") ?>" class="link dark-link"> <i data-feather="arrow-left"></i> Retour </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.survey.create')){
                ?>

                    <div class="row">
                        <div class="col-12">
                            <h3 class="title-sm bold color-dark mr-top mr-bot">Créer un sondage</span></h3>
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

                                <input type="hidden" name="nb" value="1">

                                <div class="input-creator">

                                    <div class="spacebar spacebar-xl mt-5 mb-5"></div>

                                    <div class="input_group">
                                        <div class="input-field input-half-al">
                                            <label for="question1">Question n° 1</label>
                                            <input type="text" class="question-input" name="question1" id="question1" placeholder="Question 1" value="<?= isset($_POST['question1']) ? $_POST['question1'] : '' ?>">
                                        </div>
                                        <br>
                                        <div class="input-field input-half-al answer">
                                            <div class="flex">
                                                <span class="mr-right mt-2 bold color-lg-dark">Type de réponse</span>
                                                <select class="answer_type" name="answer_type1" id="answer_type1">
                                                    <option value="checkbox">Multiples options (checkbox)</option>
                                                    <option value="radio">Option unique (radio)</option>
                                                    <option value="text">Réponse libre (text)</option>
                                                </select>
                                            </div>

                                            <div class="mr-top answers">
                                                <span class="bold color-lg-dark">Réponses a la question n° 1</span> <br>
                                                <div class="answer flex">
                                                    <div class="input-field input-half-al">
                                                        <input type="text" name="answer1[]" id="answer1" placeholder="Réponse">
                                                    </div>
                                                    <div class="mt-3 add_answerProp link" data-nb="1"> <i class="fas fa-plus-circle"></i> </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="spacebar spacebar-xl mt-5 mb-5"></div>
                                    </div>


                                    <span class="btn btn-sm dark-btn" id="add_answer">Ajouter une question</span>

                                </div>
                                

                                <div class="mr-top-lg">
                                    <button class="btn primary-btn" name="create_survey">Créer le sondage</button>
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

</div>

<?php require_once ('view/app/project/components/footer.php') ?>