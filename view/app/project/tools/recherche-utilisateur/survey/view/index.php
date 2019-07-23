<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">

        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.survey.view')){
            ?>

            <div class="row mr-top-lg">
                <div class="col-md-3 col-12 light-border p-2">
                   <h2 class="title-sm bold color-lg-dark"><?= $utils -> getData('pr_user_research_survey', 'name', 'survey_token', $router -> getRouteParam("7")) ?></h2>
                </div>
            </div>
            <div class="row mr-top-lg">
                <div class="col-md-8 col-12 bg-light p-3 rounded">
                   <p><?= $utils -> getData('pr_user_research_survey', 'topic', 'survey_token', $router -> getRouteParam("7")) ?></p>
                </div>
            </div>


            <div class="row mr-top-lg">
                <div class="col-md-8 col-12">
                    <?php
                        $allQuestions = $recherche_utilisateur -> getSurveyQuestions($router -> getRouteParam("7"));
                        $nb = 1;

                        foreach($allQuestions['content'] as $quest){
                            ?>
                            <div class="sond_item mr-bot-lg">
                                <div class="question">
                                    <span class="color-primary title-xs"><?= $quest['question'] ?></span>
                                </div>
                                <div class="answer" style="height=400px;width:400px">
                                    <?php
                                    if($quest['type'] == 'checkbox'){
                                        ?>
                                            <canvas 
                                                id="answer_pie-<?= $nb ?>" width="200" height="200"
                                            >
                                            </canvas>
                                            <script>
                                                // Les bugs
                                                var ctx = document.getElementById("answer_pie-<?= $nb ?>");

                                                var myChart = new Chart(ctx, {
                                                    type: 'doughnut',
                                                    data: {
                                                        datasets: [{ }]
                                                    },
                                                    options: {
                                                        cutoutPercentage: 40,
                                                        responsive: true,

                                                    }
                                                });
                                                <?php
                                                    $answers = $utils -> getData('pr_user_research_survey_question', 'answers', 'question_token', $quest['question_token'] );
                                                    $explAns = explode('[|-*-|]', $answers);
                                                    if(sizeof($explAns) !== 0){
                                                        foreach($explAns as $ans){
                                                            if($ans !== ''){
                                                                $c = $recherche_utilisateur -> getQuestionAnswersPerTitle( $quest['question_token'], $ans )
                                                                ?>
                                                                    addData(myChart, '<?= $ans ?>', <?= $c ?>);
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>

                                                function addData(chart, label, data) {
                                                    chart.data.labels.push(label);
                                                    chart.data.datasets.forEach((dataset) => {
                                                        dataset.data.push(data);
                                                    });
                                                    chart.update();
                                                }
                                            </script>
                                        <?php
                                        
                                    }else if($quest['type'] == 'radio'){
                                        ?>
                                            <canvas 
                                                id="answer_pie-<?= $nb ?>" width="200" height="200"
                                            >
                                            </canvas>
                                            <script>
                                                // Les bugs
                                                var ctx = document.getElementById("answer_pie-<?= $nb ?>");

                                                var myChart = new Chart(ctx, {
                                                    type: 'doughnut',
                                                    data: {
                                                        datasets: [{ }]
                                                    },
                                                    options: {
                                                        cutoutPercentage: 40,
                                                        responsive: true,
                                                    }
                                                });
                                                <?php
                                                    $answers = $utils -> getData('pr_user_research_survey_question', 'answers', 'question_token', $quest['question_token'] );
                                                    $explAns = explode('[|-*-|]', $answers);
                                                    if(sizeof($explAns) !== 0){
                                                        foreach($explAns as $ans){
                                                            if($ans !== ''){
                                                                $c = $recherche_utilisateur -> getQuestionAnswersPerTitle( $quest['question_token'], $ans )
                                                                ?>
                                                                    addData(myChart, '<?= $ans ?>', <?= $c ?>);
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>

                                                function addData(chart, label, data) {
                                                    chart.data.labels.push(label);
                                                    chart.data.datasets.forEach((dataset) => {
                                                        dataset.data.push(data);
                                                    });
                                                    chart.update();
                                                }
                                            </script>
                                        <?php

                                    }else if($quest['type'] == 'text'){
                                        ?>
                                        <ul class="list-reslut">
                                            <?php
                                                $answers = $recherche_utilisateur -> getQuestionAnswers( $quest['question_token'] );
                                                foreach($answers['content'] as $ans){
                                                    if($ans['answer'] !== 'undefined'){
                                                        ?><li class="mr-top mr-left color-lg-dark">- <?= $ans['answer'] ?></li><?php
                                                    }
                                                }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            $nb ++;
                            }
                        ?>

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