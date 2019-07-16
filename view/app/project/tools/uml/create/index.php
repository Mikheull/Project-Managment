<?php
    require_once ('controller/project.php') ;
    require_once ('controller/uml.php') ;
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
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="link dark-link"> Home </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/create" class="link dark-link active"> Nouveau </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/import" class="link dark-link"> Importer </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                    if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'uml.create')){
                        ?>
                            <div class="col-12">
                                <h2 class="title-sm color-dark">Création</h2>
                            </div>

                            <div class="col-md-6 col-12">
                                <form action="" method="post">
                                    <div class="input_group">
                                        <div class="input-field input-half">
                                            <label for="diagram_name">Nom</label>
                                            <input type="text" name="diagram_name" id="diagram_name" placeholder="Nom" value="<?= isset($_POST['diagram_name']) ? $_POST['diagram_name'] : '' ?>">
                                        </div>
                                    </div>
                                    <div class="input_group">
                                        <div class="input-field input-half">
                                            <select name="diagram_type">
                                                <option data-display="select" disabled>Aucun</option>
                                                <option value="flowchart">Flowchart</option>
                                                <option value="sequenceDiagram">Sequence diagram</option>
                                                <option value="gantt">Gantt diagram</option>
                                                <option value="classDiagram">Class diagram</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="input_group">
                                        <div class="input-field">
                                            <textarea name="diagram_content" id="diagram_content" placeholder="Contenu"></textarea>
                                        </div>
                                    </div>

                                    <button class="btn primary-btn" name="create_uml">Créer</button>
                                </form>
                            </div>


                            <div class="col-md-6 col-12">
                                <a class="link refresh_btn" id="diagram_live-btn"> <i class="fas fa-sync-alt"></i> </a>
                                <div class="light-border mermaid text-align-center" id="diagram_live-output" style="height: 70vh"></div>
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
</div>


<?php
if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'uml.create')){
    ?>
        <script>
            var input = document.getElementById("diagram_content");
            var output = document.getElementById("diagram_live-output");
            var renderBtn = document.getElementById("diagram_live-btn");

            mermaidAPI.initialize({
                startOnLoad: false, 
                theme: 'default'
            });

            $(document).on('click', '#diagram_live-btn', function() {
                $( '#diagram_live-output' ).empty()

                mermaidAPI.render('theGraph', input.value, function(svgCode) {
                    $( '#diagram_live-output' ).html(svgCode);
                });
            });
        </script>
    <?php
}
?>