<?php
    $owner = $team -> getTeamData($t['team_token'], 'founder_token');
?>

<div class="block-item inv">
    <div class="invitation">
        <div class="heading">
            <div class="container">
                <div class="row">
                    <div class="col-8 left">
                        <div class="team_profilImage"><?= substr($team -> getTeamData($t['team_token'], 'name'), 0, 1) ;?></div>
                        <div class="name"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['team_token'] ?>"> <?= $team -> getTeamData($t['team_token'], 'name') ;?> </a> </div>
                        <div class="lock"> <?= $team -> getTeamData($t['team_token'], 'public') == true ? '<i data-feather="unlock"></i>' : '<i data-feather="lock"></i>' ;?> </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="body"> 
            <div class="desc"> <?= $team -> getTeamData($t['team_token'], 'description') ;?> </div>  
            <div class="container infos">
                <div class="row">
                    <div class="col-8 part">
                        <div class="head_title">Créer par</div>
                        <div class="owner"> 
                            <div class="col-md-3 profil_picture-sm">
                                <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData($owner, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $owner.'/profil_pic/'.$user -> getUserData($owner, 'profil_image') ;?>');"></div>
                            </div>
                            <span class="txt"><?= $user -> getUserData($owner, 'first_name') ?> <?= $user -> getUserData($owner, 'last_name') ?> - <?= $config -> time_elapsed_string($team -> getTeamData($t['team_token'], 'date_begin') ) ?></span>
                        </div>
                    </div>
                    <div class="col-4 part">
                        <div class="head_title">Membres</div>
                        <div class="members">
                            <?php 
                                $team_member = $team -> getTeamMembers($t['team_token']);
                                foreach($team_member['content'] as $member){
                                    ?> <div class="item"> 
                                        <div class="profil_picture-xs">
                                            <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData($member['user_public_token'], 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $member['user_public_token'].'/profil_pic/'.$user -> getUserData($member['user_public_token'], 'profil_image') ;?>');"></div>
                                        </div>
                                    </div> <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    
    <div class="overlay">
        <div class="heading">
            <div class="title"><strong><?= $team -> getTeamData($t['team_token'], 'name') ;?></strong> souhaite vous inviter dans son équipe</div>
        </div>
        <div class="buttons">
            <form method="POST">
                <input type="hidden" name="invitation" value="<?= $t['team_token'] ?>">
                <button class="btn primary-btn" name="accept_invitation">Accepter</button>
                <button class="btn dark-btn" name="decline_invitation">Refuser</button>
            </form>
        </div>
    </div>

</div>