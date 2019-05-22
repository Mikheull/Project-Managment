<div class="col-md-5 col-11 block-item">
    <div class="invitation">
        <div class="heading">
            <div class="fs-line">
                <div class="team_profilImage"><?= substr($team -> getDataFromTeamToken($t['team_token'], 'name'), 0, 1) ;?></div>
                <div class="actions">
                    <?= $team -> getDataFromTeamToken($t['team_token'], 'public') == true ? '<i class="fas fa-unlock"></i>' : '<i class="fas fa-lock"></i>' ;?>
                    <i class="fas fa-ellipsis-h"></i>
                </div>
            </div>
            <div class="name"> <?= $team -> getDataFromTeamToken($t['team_token'], 'name') ;?> </div>
        </div>

        <div class="body"> <?= $team -> getDataFromTeamToken($t['team_token'], 'description') ;?> </div>
        
        <div class="footer">
            <span> <i class="fas fa-external-link-alt"></i> </span>
            <span class="date">Créer le <?= date("d M Y", strtotime($team -> getDataFromTeamToken($t['team_token'], 'date_begin') )) ;?></span>
        </div>
    </div>

    <div class="overlay">
        <div class="heading">
            <div class="title"><strong><?= $team -> getDataFromTeamToken($t['team_token'], 'name') ;?></strong> souhaite vous inviter dans son équipe</div>
        </div>
        <div class="buttons">
            <form method="POST">
                <input type="hidden" name="invitation" value="<?= $t['team_token'] ?>">
                <button class="primary-btn" name="accept_invitation">Accepter</button>
                <button class="red-btn" name="decline_invitation">Refuser</button>
            </form>
        </div>
    </div>
</div>