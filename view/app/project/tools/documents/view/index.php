<?php
    require_once ('controller/project.php') ;
    require_once ('controller/document.php') ;


    if(strpos($_SERVER['REQUEST_URI'], '?') !== false) {
        $parameter = explode('?', $_SERVER['REQUEST_URI']);
        $param = $parameter[1];

        $resultParam = explode('file_name=', $param);

        $ext = pathinfo($resultParam[1], PATHINFO_EXTENSION);
    }
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/documents/components/navbar.php') ?>

    <div class="container">
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

        <div class="row">
            <div class="col-md-10 col-12">
                <h3 class="title-sm bold color-dark margin-top"><?= $resultParam[1] ?></h3>
            </div>
            <div class="col-md-2 col-12 flex">
                <div> <div class="btn btn-sm dark-btn margin-right"><i class="fas fa-edit"></i></div> </div>
                <div> <a class="btn btn-sm dark-btn margin-right" download href="<?= $config -> rootUrl() ;?>dist/uploads/p/<?= $router -> getRouteParam("2") ?>/docs/<?= $resultParam[1] ?>"><i class="fas fa-download"></i></a> </div>
                <div> <div class="btn btn-sm dark-btn margin-right" id="share"><i class="fas fa-share"></i></div> </div>
                <div> <div class="btn btn-sm dark-btn" id="full_screen"><i class="fas fa-expand"></i></div> </div>
            </div>
        </div>

        <div class="row margin-top-lg">
            <div class="col-12">
                <?php
                    if($ext == 'aif' OR $ext == 'cda' OR $ext == 'mid' OR $ext == 'midi' OR $ext == 'mp3' OR $ext == 'mpa' OR $ext == 'ogg' OR $ext == 'wav' OR $ext == 'wma' OR $ext == 'wpl'){
                        ?>
                        <figure id="doc_content" class="bg-white">
                            <audio
                                controls
                                src="<?= $config -> rootUrl() . 'dist/uploads/p/' . $router -> getRouteParam("2") . '/docs/' . $resultParam[1] ;?>">
                                    Votre navigateur ne supporte pas la balise
                                    <code>audio</code>.
                            </audio>
                        </figure>
                        <?php    
                    }
                    else if($ext == '7z' OR $ext == 'arj' OR $ext == 'deb' OR $ext == 'pkg' OR $ext == 'rar' OR $ext == 'rpm' OR $ext == 'tar.gz' OR $ext == 'z' OR $ext == 'zip'){
                        ?>
                            <p id="doc_content" class="bg-white">Aucun preview disponible pour ce type de fichier</p>
                        <?php  
                    }
                    else if($ext == 'csv' OR $ext == 'dat' OR $ext == 'db' OR $ext == 'dbf' OR $ext == 'log' OR $ext == 'mdb' OR $ext == 'sav' OR $ext == 'sql' OR $ext == 'tar' OR $ext == 'xml'){
                        ?>
                            <pre><code id="doc_content" class="language-<?= $ext ;?>"><?= htmlentities(file_get_contents('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$resultParam[1])) ?></code></pre>
                        <?php
                    }
                    else if($ext == 'bmp' OR $ext == 'gif' OR $ext == 'ico' OR $ext == 'jpeg' OR $ext == 'jpg' OR $ext == 'png' OR $ext == 'ps' OR $ext == 'psd' OR $ext == 'svg' OR $ext == 'tif' OR $ext == 'tiff'){
                        ?>
                            <div id="doc_content" class="bg-white"> <img src="<?= $config -> rootUrl() . 'dist/uploads/p/' . $router -> getRouteParam("2") . '/docs/' . $resultParam[1] ;?>"> </div>
                        <?php    
                    }
                    else if($ext == 'asp' OR $ext == 'aspx' OR $ext == 'cgi' OR $ext == 'pl' OR $ext == 'css' OR $ext == 'sass' OR $ext == 'scss' OR $ext == 'less' OR $ext == 'html' OR $ext == 'htm' OR $ext == 'js' OR $ext == 'json' OR $ext == 'jsp' OR $ext == 'part' OR $ext == 'php' OR $ext == 'py' OR $ext == 'rss' OR $ext == 'xhtml'){
                        ?>
                            <pre><code id="doc_content" class="language-<?= $ext ;?>"><?= htmlentities(file_get_contents('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$resultParam[1])) ?></code></pre>
                        <?php    
                    }
                    else if($ext == 'key' OR $ext == 'odp' OR $ext == 'pps' OR $ext == 'ppt' OR $ext == 'pptx' OR $ext == 'pdf' ){
                        ?>
                            <object id="doc_content" data="<?= $config -> rootUrl() . 'dist/uploads/p/' . $router -> getRouteParam("2") . '/docs/' . $resultParam[1] ;?>" type="application/pdf" width="100%" height="700px"></object>
                        <?php    
                    }
                    else if($ext == 'c' OR $ext == 'class' OR $ext == 'cpp' OR $ext == 'cs' OR $ext == 'h' OR $ext == 'java' OR $ext == 'sh' OR $ext == 'swift' OR $ext == 'vb'){
                        ?>
                            <pre><code id="doc_content" class="language-<?= $ext ;?>"><?= htmlentities(file_get_contents('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$resultParam[1])) ?></code></pre>
                        <?php    
                    }
                    else if($ext == '3g2' OR $ext == '3gp' OR $ext == 'avi' OR $ext == 'flv' OR $ext == 'h264' OR $ext == 'm4v' OR $ext == 'mkv' OR $ext == 'mov' OR $ext == 'mp4' OR $ext == 'mpg' OR $ext == 'mpeg' OR $ext == 'rm' OR $ext == 'swf' OR $ext == 'vob' OR $ext == 'wmv'){
                        ?>
                            <video controls id="doc_content" class="bg-white">
                                <source src="<?= $config -> rootUrl() . 'dist/uploads/p/' . $router -> getRouteParam("2") . '/docs/' . $resultParam[1] ;?>">
                                    Votre navigateur ne supporte pas la balise
                                    <code>video</code>.
                            </video>

                        <?php    
                    }
                    else if($ext == 'doc' OR $ext == 'docx' OR $ext == 'odt' OR $ext == 'tex' OR $ext == 'txt' OR $ext == 'wks' OR $ext == 'wps' OR $ext == 'wpd' OR $ext == 'md'){
                        ?>
                            <pre><code id="doc_content" class="language-<?= $ext ;?>"><?= htmlentities(file_get_contents('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$resultParam[1])) ?></code></pre>
                        <?php    
                    }
                    else{
                        ?>
                            <p id="doc_content" class="bg-white">Aucun preview disponible pour ce type de fichier</p>
                        <?php
                    }
                
                ?>
            </div>
        </div>

    </div>
</div>


<script>Prism.plugins.autoloader.languages_path = 'https://cdn.jsdelivr.net/npm/prismjs@1.16.0/components.js'</script>
<script>
    const el = document.getElementById('doc_content');

    document.getElementById('full_screen').addEventListener('click', () => {
        if (screenfull.enabled) {
            screenfull.request(el);
        }
    });
</script>
