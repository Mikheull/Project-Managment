<?php
    require_once ('controller/project.php') ;
    require_once ('controller/document.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="link dark-link active"> Home </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/create" class="link dark-link"> Nouveau </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/import" class="link dark-link"> Importer </a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <?php  
                if(!is_dir('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/')){
                    mkdir('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/', 0777, true);
                }

                $dir_files = new DirectoryIterator('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/');
            
                if(empty($dir_files)){
                    ?>
                        <div class="col-8 offset-2 text-align-center margin-top-lg">
                            <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_doc.svg" alt="" width="50%">
                            <h3 class="title-sm bold color-dark margin-bot-lg margin-top-lg">Aucun document pour le moment !</h3>
                        </div>
                    <?php
                }else{
                    $audioFiles = array();
                    $zipFiles = array();
                    $databaseFiles = array();
                    $imagesFiles = array();
                    $devFiles = array();
                    $presentationFiles = array();
                    $programmingFiles = array();
                    $videoFiles = array();
                    $textFiles = array();

                    $others = array();

                    foreach (new DirectoryIterator('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/') as $file) {
                        if ( $file->isFile() && !$file->isDot() && $file -> getFilename() !== '.DS_Store'){

                            if($file->getExtension() == 'aif' OR $file->getExtension() == 'cda' OR $file->getExtension() == 'mid' OR $file->getExtension() == 'midi' OR $file->getExtension() == 'mp3' OR $file->getExtension() == 'mpa' OR $file->getExtension() == 'ogg' OR $file->getExtension() == 'wav' OR $file->getExtension() == 'wma' OR $file->getExtension() == 'wpl'){array_push($audioFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == '7z' OR $file->getExtension() == 'arj' OR $file->getExtension() == 'deb' OR $file->getExtension() == 'pkg' OR $file->getExtension() == 'rar' OR $file->getExtension() == 'rpm' OR $file->getExtension() == 'tar.gz' OR $file->getExtension() == 'z' OR $file->getExtension() == 'zip'){array_push($zipFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == 'csv' OR $file->getExtension() == 'dat' OR $file->getExtension() == 'db' OR $file->getExtension() == 'dbf' OR $file->getExtension() == 'log' OR $file->getExtension() == 'mdb' OR $file->getExtension() == 'sav' OR $file->getExtension() == 'sql' OR $file->getExtension() == 'tar' OR $file->getExtension() == 'xml'){array_push($databaseFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == 'bmp' OR $file->getExtension() == 'gif' OR $file->getExtension() == 'ico' OR $file->getExtension() == 'jpeg' OR $file->getExtension() == 'jpg' OR $file->getExtension() == 'png' OR $file->getExtension() == 'ps' OR $file->getExtension() == 'psd' OR $file->getExtension() == 'svg' OR $file->getExtension() == 'tif' OR $file->getExtension() == 'tiff'){array_push($imagesFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == 'asp' OR $file->getExtension() == 'aspx' OR $file->getExtension() == 'cgi' OR $file->getExtension() == 'pl' OR $file->getExtension() == 'css' OR $file->getExtension() == 'sass' OR $file->getExtension() == 'scss' OR $file->getExtension() == 'less' OR $file->getExtension() == 'html' OR $file->getExtension() == 'htm' OR $file->getExtension() == 'js' OR $file->getExtension() == 'json' OR $file->getExtension() == 'jsp' OR $file->getExtension() == 'part' OR $file->getExtension() == 'php' OR $file->getExtension() == 'py' OR $file->getExtension() == 'rss' OR $file->getExtension() == 'xhtml'){array_push($devFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == 'key' OR $file->getExtension() == 'odp' OR $file->getExtension() == 'pps' OR $file->getExtension() == 'ppt' OR $file->getExtension() == 'pptx' OR $file->getExtension() == 'pdf' ){array_push($presentationFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == 'c' OR $file->getExtension() == 'class' OR $file->getExtension() == 'cpp' OR $file->getExtension() == 'cs' OR $file->getExtension() == 'h' OR $file->getExtension() == 'java' OR $file->getExtension() == 'sh' OR $file->getExtension() == 'swift' OR $file->getExtension() == 'vb'){array_push($programmingFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == '3g2' OR $file->getExtension() == '3gp' OR $file->getExtension() == 'avi' OR $file->getExtension() == 'flv' OR $file->getExtension() == 'h264' OR $file->getExtension() == 'm4v' OR $file->getExtension() == 'mkv' OR $file->getExtension() == 'mov' OR $file->getExtension() == 'mp4' OR $file->getExtension() == 'mpg' OR $file->getExtension() == 'mpeg' OR $file->getExtension() == 'rm' OR $file->getExtension() == 'swf' OR $file->getExtension() == 'vob' OR $file->getExtension() == 'wmv'){array_push($videoFiles, $file->getFilename()) ;}
                            else if($file->getExtension() == 'doc' OR $file->getExtension() == 'docx' OR $file->getExtension() == 'odt' OR $file->getExtension() == 'tex' OR $file->getExtension() == 'txt' OR $file->getExtension() == 'wks' OR $file->getExtension() == 'wps' OR $file->getExtension() == 'wpd' OR $file->getExtension() == 'md'){array_push($textFiles, $file->getFilename()) ;}
                            else{array_push($others, $file->getFilename());}
                            
                        }

                    }
                    ?>
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="fas fa-volume-up"></i></span> Fichiers audio</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($audioFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($audioFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="far fa-file-archive"></i></span> Fichiers compressés</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($zipFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($zipFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="fas fa-database"></i></span> Fichiers de données</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($databaseFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($databaseFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="far fa-images"></i></span> Images</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($imagesFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($imagesFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="fas fa-code"></i></span> Fichiers de développement</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($devFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($devFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="fas fa-laptop"></i></span> Fichiers de présentation</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($presentationFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($presentationFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="fas fa-terminal"></i></span> Fichiers de programmation</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($programmingFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($programmingFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="fas fa-video"></i></span> Vidéos</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($videoFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($videoFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot"><span class="margin-right"><i class="far fa-file-alt"></i></span> Fichiers texte</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($textFiles)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($textFiles as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="col-12 margin-top-lg">
                            <h3 class="title-sm bold color-dark margin-bot margin-right">Autres</h3>
                            <div class="container">
                                <div class="row flex flex-column">
                                    <?php
                                        if(empty($others)){
                                            echo "aucuns fichiers";
                                        }else{
                                            foreach($others as $file){
                                                ?>
                                                <div class="col-3 margin-bot margin-left file-item bg-dark rounded">
                                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/viewer?file_name=<?= $file ?>" class="color-light"><?= $file ;?></a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>                 
                    <?php
                }
            ?>
        </div>
        
    </div>
</div>