<div class="row team-container justify-content-between">
    <?php
        if($router -> getRouteParam('0') == 'account'){
            foreach($getUserInvitations['content'] as $t){
                require ('view/user/teams/components/invitation.php');
            }
        }

        foreach($getUserTeams['content'] as $t){
            require ('view/user/teams/components/card.php');
        }
    ?>

</div>

<div id="team_output"></div>
