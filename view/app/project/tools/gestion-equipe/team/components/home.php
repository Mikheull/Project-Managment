<?php

    $page = 0;
    $numberPerpage = 15;
    $offset = 0;

    if(strpos($_SERVER['REQUEST_URI'], '?') !== false) {
        $parameter = explode('?', $_SERVER['REQUEST_URI']);
        $param = $parameter[1];

        $resultParam = explode('page=', $param);
        $page = $resultParam[1];
    }
    $offset = $numberPerpage * $page;

    $Reqcount = $allTeams['content'];
    $count = count($Reqcount);
    $lastIndex = floor( $count / $numberPerpage );

?>

<section class="wrapper_content">
    
    <div class="data_content">
        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'project.team.create')){
            ?>
            <div class="mr-bot mr-top">
                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe/team/create" class="btn btn-sm primary-btn">Nouvelle équipe</a>
            </div>
            <?php
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th style="width: 50%">Nom</th>
                    <th style="width: 40%">Date de création</th>
                    <th style="width: 10%"></th>
                </tr>
            </thead>

            <div class="wrapper_search">
                <thead>
                    <tr>
                        <th style="width: 50%"> <div class="table_search"> <input type="text" name="search" placeholder="Recherche par nom" data-type="pr_project_team" data-search="name" data-param="like"> </div></th>
                        <th style="width: 40%"> <div class="table_search"> <input type="text" min="1" name="search" placeholder="Recherche par date de création" data-type="pr_project_team" data-search="date_creation" data-param="like"> </div></th>
                        <th style="width: 10%"></th>
                    </tr>
                </thead>
            </div>
        </table>

        <div id="searchOutput">
            <table>
                <?php
                    $allTeamsLimit = $projectTeam -> getTeamsLimit($router -> getRouteParam('2') ,$numberPerpage, $offset);
                    foreach($allTeamsLimit['content'] as $tm){
                        require ('view/app/project/tools/gestion-equipe/team/components/vue_item.php');
                    }
                ?>
            </table>
        </div>

        <div class="paging">
            <ul>
                <li> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe?page=0"> <i class="fas fa-angle-double-left"></i> </a> </li>
                <?php
                if($page > 0){
                    ?> <li> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe?page=<?= $page - 1 ;?>"> <i class="fas fa-angle-left"></i> </a> </li> <?php
                }else{
                    ?> <li> <a> <i class="fas fa-times"></i> </a> </li> <?php
                }
                ?>
                <li> <a><?= $page ;?></a> </li>
                <?php
                if($page < $lastIndex){
                    ?> <li> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe?page=<?= $page + 1 ;?>"> <i class="fas fa-angle-right"></i> </a> </li> <?php
                }else{
                    ?> <li> <a> <i class="fas fa-times"></i> </a> </li> <?php
                }
                ?>
                <li> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe?page=<?= $lastIndex ;?>"> <i class="fas fa-angle-double-right"></i> </a> </li>
            </ul>
        </div>
    </div>
</section>




<script>
$( ".table_search input" ).keyup(function() {
    var type = this.dataset.type;
    var query = this.dataset.search;
    var param = this.dataset.param;
    var keyword = $(this).val();

    if (keyword.length > 0) {
        $.ajax({
            url: rootUrl + 'controller/ajax/search/project-team.php',
            type: 'POST',
            data: {type:type, query:query, keyword:keyword, param:param},
            success:function(data){
                $('#searchOutput').html(data);
            }
        });
    }else{
        $("#searchOutput").load(location.href + " #searchOutput");
    }

})


</script>