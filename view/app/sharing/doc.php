<?php 
    $project_token = $utils -> getData('pr_shortener', 'project_token', 'short_url', $router -> getRouteParam("1"));
    $file_path_org = $utils -> getData('pr_shortener', 'base_url', 'short_url', $router -> getRouteParam("1"));
    $file_path = explode('/', $file_path_org);
    $file = $file_path[sizeof($file_path) - 1];
    $ext = pathinfo($file, PATHINFO_EXTENSION);

?> 

<?php // View Content ?>

<div class="container-fluid main_wrapper">

    <div class="content_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-12 flex margin-top">
                    <div style="width: 128px" class="margin-right">
                        <a class="navbar-brand" href="<?= $config -> rootUrl() ;?>./" title="Improove">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 28">
                                <defs><style>.cls-1,.cls-3{fill:#4c6cf6;}.cls-2{fill:none;stroke:#4c6cf6;stroke-linecap:round;stroke-miterlimit:10;stroke-width:2px;}.cls-3{font-size:16px;font-family:Nunito-Bold, Nunito;font-weight:700;}.cls-4{letter-spacing:-0.01em;}.cls-5{letter-spacing:-0.02em;}</style></defs>
                                <g id="Calque_2" data-name="Calque 2">
                                    <g id="Calque_1-2" data-name="Calque 1">
                                        <path class="cls-1" d="M26.5,0h-9a1.5,1.5,0,0,0,0,3h5.38L11.5,14.38a1.5,1.5,0,1,0,2.12,2.12L25,5.12V10.5a1.5,1.5,0,0,0,3,0v-9A1.5,1.5,0,0,0,26.5,0Z"/>
                                        <path class="cls-2" d="M1,14A13,13,0,0,0,14,27"/>
                                        <path class="cls-2" d="M14,27A13,13,0,0,0,27,14"/>
                                        <path class="cls-2" d="M14,1A13,13,0,0,0,1,14"/>
                                        <text class="cls-3" transform="translate(33.09 19.17)">IMPROOVE</text>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <h3 class="title-sm bold color-dark"><?= $file ?></h3>
                </div>
                <div class="col-md-2 col-12 flex margin-top">
                    <div> <a class="btn btn-sm dark-btn margin-right" download href="<?= $config -> rootUrl() ;?><?= $utils -> getData('pr_shortener', 'base_url', 'short_url', $router -> getRouteParam("1")) ?>"><i class="fas fa-download"></i></a> </div>
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
                                    src="<?= $config -> rootUrl() . 'dist/uploads/p/' . $project_token . '/docs/' . $file ;?>">
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
                                <pre><code id="doc_content" class="language-<?= $ext ;?>"><?= htmlentities(file_get_contents($file_path_org)) ?></code></pre>
                            <?php
                        }
                        else if($ext == 'bmp' OR $ext == 'gif' OR $ext == 'ico' OR $ext == 'jpeg' OR $ext == 'jpg' OR $ext == 'png' OR $ext == 'ps' OR $ext == 'psd' OR $ext == 'svg' OR $ext == 'tif' OR $ext == 'tiff'){
                            ?>
                                <div id="doc_content" class="bg-white"> <img src="<?= $config -> rootUrl() . 'dist/uploads/p/' . $project_token . '/docs/' . $file ;?>"> </div>
                            <?php    
                        }
                        else if($ext == 'asp' OR $ext == 'aspx' OR $ext == 'cgi' OR $ext == 'pl' OR $ext == 'css' OR $ext == 'sass' OR $ext == 'scss' OR $ext == 'less' OR $ext == 'html' OR $ext == 'htm' OR $ext == 'js' OR $ext == 'json' OR $ext == 'jsp' OR $ext == 'part' OR $ext == 'php' OR $ext == 'py' OR $ext == 'rss' OR $ext == 'xhtml' OR $ext == 'c' OR $ext == 'class' OR $ext == 'cpp' OR $ext == 'cs' OR $ext == 'h' OR $ext == 'java' OR $ext == 'sh' OR $ext == 'swift' OR $ext == 'vb'){
                            ?>
                                <pre><code id="doc_content" class="language-<?= $ext ;?>"><?= htmlentities(file_get_contents($file_path_org)) ?></code></pre>
                            <?php    
                        }
                        else if($ext == 'key' OR $ext == 'odp' OR $ext == 'pps' OR $ext == 'ppt' OR $ext == 'pptx' OR $ext == 'pdf' ){
                            ?>
                                <object id="doc_content" data="<?= $config -> rootUrl() . 'dist/uploads/p/' . $project_token . '/docs/' . $file ;?>" type="application/pdf" width="100%" height="700px"></object>
                            <?php    
                        }
                        else if($ext == '3g2' OR $ext == '3gp' OR $ext == 'avi' OR $ext == 'flv' OR $ext == 'h264' OR $ext == 'm4v' OR $ext == 'mkv' OR $ext == 'mov' OR $ext == 'mp4' OR $ext == 'mpg' OR $ext == 'mpeg' OR $ext == 'rm' OR $ext == 'swf' OR $ext == 'vob' OR $ext == 'wmv'){
                            ?>
                                <video controls id="doc_content" class="bg-white">
                                    <source src="<?= $config -> rootUrl() . 'dist/uploads/p/' . $project_token . '/docs/' . $file ;?>">
                                        Votre navigateur ne supporte pas la balise
                                        <code>video</code>.
                                </video>

                            <?php    
                        }
                        else if($ext == 'doc' OR $ext == 'docx' OR $ext == 'odt' OR $ext == 'tex' OR $ext == 'txt' OR $ext == 'wks' OR $ext == 'wps' OR $ext == 'wpd' OR $ext == 'md'){
                            ?>
                                <pre><code id="doc_content" class="language-<?= $ext ;?>"><?= htmlentities(file_get_contents($file_path_org)) ?></code></pre>
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
</div>
<div id="share_output"></div>


<script>Prism.plugins.autoloader.languages_path = 'https://cdn.jsdelivr.net/npm/prismjs@1.16.0/components.js'</script>
<script>
    const el = document.getElementById('doc_content');

    document.getElementById('full_screen').addEventListener('click', () => {
        if (screenfull.enabled) {
            screenfull.request(el);
        }
    });
</script>
