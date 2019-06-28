<?php
    if($router -> getRouteParam('0') == 'account'){
        if($getUserInvitations['count'] !== 0){
            ?>
            <div class="row team-container justify-content-between">
                <?php
                    if($router -> getRouteParam('0') == 'account'){
                        foreach($getUserInvitations['content'] as $t){
                            require ('view/user/projects/components/invitation.php');
                        }
                    }
                ?>
            </div>
            <?php
        }
    }
?>


<?php
    if($getUserProjects['count'] !== 0){
        ?>
        <div class="row team-container justify-content-between">
            <?php
            foreach($getUserProjects['content'] as $t){
                require ('view/user/projects/components/card.php');
            }
            ?>
        </div>
        <?php
    }
?>


<?php
    if($router -> getRouteParam('0') == 'account'){
        if($getUserProjectsArchived['count'] !== 0){
            ?>
            <h3 class="title-sm bold color-dark margin-top-lg">Projets archivées <span><?= $getUserProjectsArchived['count'] ;?></span></h3>
            <p class="color-gray margin-bot-lg">Vos projets archivés, seul vous pouvez les gérer.</p>
            <div class="row team-container justify-content-between">
                <?php
                foreach($getUserProjectsArchived['content'] as $t){
                    require ('view/user/projects/components/archived.php');
                }
                ?>
            </div>
            <?php
        }
    }
?>

<div id="project_output"></div>
