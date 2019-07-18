<?php
    require_once ('controller/project.php') ;
    require_once ('controller/document.php') ;
    require_once ('controller/shortener.php') ;


    if(strpos($_SERVER['REQUEST_URI'], '?') !== false) {
        $parameter = explode('?', $_SERVER['REQUEST_URI']);
        $param = $parameter[1];

        $resultParam = explode('file_name=', $param);

        $ext = pathinfo($resultParam[1], PATHINFO_EXTENSION);
    }
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
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="link dark-link"> Home </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/create" class="link dark-link"> Nouveau </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/import" class="link dark-link"> Importer </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <form action="" method="POST">
                <input type="hidden" name="org_file_name" value="<?= $resultParam[1] ?>">
                <div class="row">
                    <div class="col-md-10 col-12">
                        <div class="input-field input-half">
                            <input type="text" name="doc_name" id="doc_name" placeholder="Nom" value="<?= $resultParam[1] ?>">
                        </div>
                    </div>
                    <div class="col-md-2 col-12 flex">
                        <div class="input-field input-half">
                            <input type="submit" name="save_edit" class="btn primary-btn mr-right" value="Sauvegarder">
                        </div>
                    </div>
                </div>

                <div class="row mr-top-lg">
<?php
    if($ext == 'csv' OR $ext == 'dat' OR $ext == 'db' OR $ext == 'dbf' OR $ext == 'log' OR $ext == 'mdb' OR $ext == 'sav' OR $ext == 'sql' OR $ext == 'tar' OR $ext == 'xml' OR $ext == 'asp' OR $ext == 'aspx' OR $ext == 'cgi' OR $ext == 'pl' OR $ext == 'css' OR $ext == 'sass' OR $ext == 'scss' OR $ext == 'less' OR $ext == 'html' OR $ext == 'htm' OR $ext == 'js' OR $ext == 'json' OR $ext == 'jsp' OR $ext == 'part' OR $ext == 'php' OR $ext == 'py' OR $ext == 'rss' OR $ext == 'xhtml' OR $ext == 'c' OR $ext == 'class' OR $ext == 'cpp' OR $ext == 'cs' OR $ext == 'h' OR $ext == 'java' OR $ext == 'sh' OR $ext == 'swift' OR $ext == 'vb' OR $ext == 'doc' OR $ext == 'docx' OR $ext == 'odt' OR $ext == 'tex' OR $ext == 'txt' OR $ext == 'wks' OR $ext == 'wps' OR $ext == 'wpd' OR $ext == 'md'){
        ?>
            <div class="input-field col-12">
<textarea name="doc_content" id="doc_content" style="height: 90vh"><?php echo htmlentities(file_get_contents('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$resultParam[1])); ?></textarea>
            </div>
        <?php
    }else{
    ?>
    <p id="doc_content" class="bg-white">Aucun preview disponible pour ce type de fichier</p>
    <?php
    }

?>
                    
                </form>
            </div>

        </div>
    </div>
</div>

<script>Prism.plugins.autoloader.languages_path = 'https://cdn.jsdelivr.net/npm/prismjs@1.16.0/components.js'</script>