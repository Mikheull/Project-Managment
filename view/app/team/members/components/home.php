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
    

    <div class="container table_content margin-top-lg">
        <div class="row member_heading margin-bot-lg">
            <div class="col-md-3 col-6 bold">Utilisateur</div>
            <div class="col-md-5 col-6 bold">Rôles</div>
            <div class="col-md-3 col-10 bold">Date d’arrivée</div>
            <div class="col-md-1 col-2 bold"></div>
        </div>

        <?php
            foreach($teamData['content'] as $u){
                require ('view/app/team/members/components/user_item.php');
            }
        ?>
    </div>

</div>





<div id="invite" style="display: none;">

    <div class="container">
        <div class="row">
            <div class="col text-align-center margin-bot-lg">
                <h2 class="title-md bold color-dark">Invitation</h2>
                <h3 class="title-xs color-gray">Entrez un email ci-dessous</h3>
            </div>
        </div>

        <form method="post" class="row">
            <div class="col-6 offset-3">
                <div class="input-field">
                    <label for="email" class="color-gray">Mail de l'utilisateur</label>
                    <input type="email" placeholder="john-doe@domain.com" name="user_mail" id="user_mail" ">
                </div>
            </div>
            <div class="col-12 text-align-center margin-bot-lg margin-top-lg">
                <button class="btn primary-btn" name="invite_member">Inviter</button>
            </div>
        </form>
    </div>
   
</div>

<script>
    $('.invite').modaal();
</script>