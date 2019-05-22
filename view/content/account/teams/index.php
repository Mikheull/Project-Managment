<?php
    require ('controller/team.php') ;

    if($auth -> isConnected() == true){
        $userToken = $_SESSION['user_token'];
    
        $getUserInvitations = $team -> getUserTeamInvitations($_SESSION['user_token']);
        $getUserTeams = $team -> getUserTeam($_SESSION['user_token']);
?>

        <div id="account-bg">
            <?php require ('view/components/navbar-header-dark.php') ;?>
        </div>



        <div class="container account floating_container">
            <?php require ('view/content/account/components/heading_account.php') ;?>

            <div class="team">
                <div class="row bar">
                    <div class="col">
                        <div class="heading nav-left">
                            <h3>Équipes <span><?= $getUserTeams['count'] ;?>/5</span></h3>
                            <small>Trouvez et rejoignez une équipe, ou bien créez la votre dès maintenant.</small>
                        </div>
                        <div class="buttons nav-right">
                            <a class="light-btn light-border-btn"> <i class="fas fa-star"></i> Vue des favoris</a>
                            <a href="<?= $config -> rootUrl() ;?>app/new-team" class="primary-btn"> <i class="fas fa-plus"></i> Nouvelle équipe</a>
                        </div>
                    </div>
                </div>

                <div class="row content">
                    <?php
                        if($getUserTeams['count'] !== 0){
                            require ('view/content/account/teams/components/home.php');
                        }else{
                            require ('view/content/account/teams/components/empty.php');
                        }
                    ?>
                </div>
            </div>



        </div>


        <?php require ('view/components/footer.php') ;?>
<?php
    }else{
        header('location: login?return_url=account%2Fteams');
    }
?>