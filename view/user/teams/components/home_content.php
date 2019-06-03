<?php
    if($router -> getRouteParam('0') == 'account'){
        if($getUserInvitations['count'] !== 0){
            ?>
            <div class="row team-container justify-content-between invitation">
                <?php
                    if($router -> getRouteParam('0') == 'account'){
                        foreach($getUserInvitations['content'] as $t){
                            require ('view/user/teams/components/invitation.php');
                        }
                    }
                ?>
            </div>
            <?php
        }
    }
?>


<?php
    if($getUserTeams['count'] !== 0){
        ?>
        <div class="row team-container justify-content-between">
            <?php
            foreach($getUserTeams['content'] as $t){
                require ('view/user/teams/components/card.php');
            }
            ?>
        </div>
        <?php
    }
?>


<?php
    if($getUserTeamsArchived['count'] !== 0){
        ?>
        <h3 class="title-sm bold color-dark">Équipes archivées <span><?= $getUserTeamsArchived['count'] ;?></span></h3>
        <div class="row team-container justify-content-between">
            <?php
            foreach($getUserTeamsArchived['content'] as $t){
                require ('view/user/teams/components/archived.php');
            }
            ?>
        </div>
        <?php
    }
?>

<div id="team_output"></div>