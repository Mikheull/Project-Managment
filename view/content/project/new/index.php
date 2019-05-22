<?php require ('controller/team.php') ;?>


<?php require ('view/components/navbar-header-light.php') ;?>


<div class="container">
    <div class="row project-navbar">
        <div class="col col-12">
            <div class="nav-left">
                <a href="" class="active">Équipes</a>
                <a href="">Projets</a>
            </div>

            <div class="nav-right">
                <a href="#ex1" class="add" rel="modal:open"><i class="fas fa-plus"></i></a>
                <input type="text" name="search" placeholder="Rechercher">
            </div>
        </div>
    </div>

    <?php

    $teams_return = $team -> getUserTeam($_SESSION['user_token']);

    if($teams_return['count'] !== 0){
        ?>
        <div class="row row_team-container">
            <?php
                foreach($teams_return['content'] as $t){
                    ?>
                    <div class="col-lg-3 col-md-5 col-10 block-item">
                        <div class="heading">
                            <div class="fs-line">
                                <div class="team_profilImage">?</div>
                                <div class="actions">
                                    <?php
                                        if($team -> getDataFromTeamToken($t['team_token'], 'public') == true){
                                            echo '<i class="fas fa-unlock" data-tippy="Équipe publique"></i>';
                                        }else{
                                            echo '<i class="fas fa-lock" data-tippy="Équipe privée"></i>';
                                        }
                                    ;?>
                                    <i class="fas fa-ellipsis-h"></i>
                                </div>
                            </div>
                            <div class="name"> <?= $team -> getDataFromTeamToken($t['team_token'], 'name') ;?> </div>
                        </div>

                        <div class="body"> <?= $team -> getDataFromTeamToken($t['team_token'], 'description') ;?> </div>
                        
                        <div class="footer">
                            <a href="<?= $config -> rootUrl() ;?>app/<?= $t['team_token'] ?>"> <i class="fas fa-external-link-alt"></i> </a>
                            <span class="date">Créer le <?= date("d M Y", strtotime($team -> getDataFromTeamToken($t['team_token'], 'date_begin') )) ;?></span>
                        </div>
                        
                    </div>
                    <?php
                }
            ?>
        </div>
        <?php
    }else{
        ?>
        <div class="row empty">
            <div class="col">
                <img src="dist/images/illustrations/empty_teams.svg" alt="" width="50%">
                <span>Vous n'avez pas encore rejoins d'équipe !</span>
            </div>
        </div>
        <?php
    }
    ?>
    <!-- Modal HTML embedded directly into document -->
<div id="ex1" class="modal">
  <p>Thanks for clicking. That felt good.</p>
  <a href="#" rel="modal:close">Close</a>
</div>

<!-- Link to open the modal -->
<p><a href="#ex1" rel="modal:open">Open Modal</a></p>
</div>


<?php require ('view/components/footer.php') ;?>