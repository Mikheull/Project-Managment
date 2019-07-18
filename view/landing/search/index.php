<?php 
    require_once ('view/components/navbar-header-light.php') ;

    require ('controller/project.php') ;

?>

<div id="head_deco" style="background-image: url('<?= $config -> rootUrl() ;?>dist/images/illustrations/search.svg?>')"></div>

<div class="container">

    <div class="row title search_head">
        <div class="col text-align-center mr-bot-lg mr-top-lg">
            <h2 class="title-lg bold color-dark ">Recherche</h2>
            <h3 class="title-xs color-gray">Clematius nec hiscere nec loqui permissus</h3>
        </div>
    </div>
    
    <div class="row search_container mr-bot-lg">
        <div class="col-md-8 col-10 search_bar">
            <form method="post">
                <div class="input-field flex bg-white light-border">
                    <input type="text" placeholder="Recherche" name="website-search" id="website-search" class="mr-right mr-left">
                    <input type="hidden" name="search_filter" id="search_filter" value="member">
                    <button class="btn primary-btn" name="search_button">Rechercher</button>
                </div>
            </form>
        </div>

        <div class="col-md-8 offset-md-2 col-10 offset-1">
            <ul class="flex mr-top justify-content-end">
                <li> <a class="filter_btn btn btn-sm dark-btn mr-right" data-filter="member">Membres</a> </li>
                <li> <a class="filter_btn btn btn-sm light-btn-bordered mr-right" data-filter="project">Projets</a> </li>
                <li> <a class="filter_btn btn btn-sm light-btn-bordered" data-filter="article">Articles</a> </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-12 flex justify-content-between" id="loading_data">
            <div class="card"></div>
        </div>
        <div class="col-9 mr-top-lg">
            <div class="row team-container justify-content-between" id="output_data">
            </div>
        </div>
    </div>


    <div class="row mr-bot-lg mr-top-lg" id="public_data">
        
        <div class="col-10 mr-top-lg">
            <h2 class="title-xs bold color-dark ">Projets publics</h2>
            <h3 class="text-sm color-gray">Découvrez les projets libre accès</h3>
        </div>
        <div class="col-2 text-align-right">
            <a href="<?= $config -> rootUrl() ;?>search/projects" class="btn btn-sm dark-btn">Voir tout</a>
        </div>

        <div class="col-9 mr-top-lg">
            <div class="row team-container justify-content-between">
                <?php
                $allProjects = $project -> getPublicProjects();
                foreach($allProjects['content'] as $t){
                    $t['project_token'] = $t['public_token'];
                    require ('view/user/projects/components/card.php');
                }
                ?>
            </div>
        </div>
    </div>
    
</div>


<?php require ('view/components/footer.php') ;?>
