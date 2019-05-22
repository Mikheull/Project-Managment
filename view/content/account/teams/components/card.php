<div class="col-md-5 col-11 block-item">
    <div class="heading">
        <div class="fs-line">
            <div class="team_profilImage"><?= substr($team -> getTeamData($t['team_token'], 'name'), 0, 1) ;?></div>
            <div class="actions">
                <?= $team -> getTeamData($t['team_token'], 'public') == true ? '<i class="fas fa-unlock" data-tippy="Équipe publique"></i>' : '<i class="fas fa-lock" data-tippy="Équipe privée"></i>' ;?>
                <i class="fas fa-ellipsis-h short-act"></i>
            </div>
        </div>
        <div class="name"> <?= $team -> getTeamData($t['team_token'], 'name') ;?> </div>
    </div>

    <div class="body"> <?= $team -> getTeamData($t['team_token'], 'description') ;?> </div>
    
    <div class="footer">
        <div class="founder">
            <div class="profilImage"></div>
            <span>Créer le <?= date("d M Y", strtotime($team -> getTeamData($t['team_token'], 'date_begin') )) ;?> par <strong><?= $user -> getUserData($_SESSION['user_token'], 'first_name') .' '. $user -> getUserData($_SESSION['user_token'], 'last_name') ;?></strong></span>
        </div>

        <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['team_token'] ?>"> <i class="fas fa-external-link-alt"></i> </a>
        <span class="date">Créer le <?= date("d M Y", strtotime($team -> getTeamData($t['team_token'], 'date_begin') )) ;?></span>
    </div>
    
</div>