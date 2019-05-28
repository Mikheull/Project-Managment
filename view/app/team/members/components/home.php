<?php
    $teamData = $team -> getTeamMembers($team_token);
?>




<?php // View Content ?>

<?php require_once ('view/app/team/components/team_sidebar.php') ?>

<div class="content_wrapper">
    
    <div class="container head_bar margin-bot-lg">
        <div class="row">
            <div class="col left"> 
                <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/overview"><i data-feather="arrow-left-circle"></i></a>
                <span class="bold color-dark margin-left">Membres</span>
            </div>

            <div class="col right text-align-right"> 
                <i data-feather="sliders"></i>
                <a href="#invite" class="margin-left btn primary-btn invite"> <i class="fas fa-plus-circle"></i> </a>
            </div>
        </div>
    </div>
    

    <div class="container table margin-top-lg">
        <?php
            foreach($teamData['content'] as $u){
                require ('view/app/team/members/components/user_item.php');
            }
        ?>
    </div>

</div>





<div id="invite" style="display: none;">
    <form method="post">
        <input type="email" name="user_mail" id="user_mail" placeholder="Mail de l'utilisateur">
        <button class="btn primary-btn" name="invite_member">Inviter</button>
    </form>
</div>

<script>
    $('.invite').modaal();
</script>