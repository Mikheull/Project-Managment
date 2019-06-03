<?php
    $owner = $project -> getProjectData($t['project_token'], 'founder_token');
?>

<div class="block-item inv">
    <div class="invitation">
        <div class="heading">
            <div class="container">
                <div class="row">
                    <div class="col-8 left">
                        <div class="team_profilImage"><?= substr($project -> getProjectData($t['project_token'], 'name'), 0, 1) ;?></div>
                        <div class="name"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>"> <?= $project -> getProjectData($t['project_token'], 'name') ;?> </a> </div>
                        <div class="lock"> <?= $project -> getProjectData($t['project_token'], 'public') == true ? '<i data-feather="unlock"></i>' : '<i data-feather="lock"></i>' ;?> </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="body"> 
            <div class="desc"> <?= $project -> getProjectData($t['project_token'], 'description') ;?> </div>  
            <div class="container infos">
                <div class="row">
                    <div class="col-8 part">
                        <div class="head_title">Créer par</div>
                        <div class="owner"> 
                            <div class="col-md-3 profil_picture-sm">
                                <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData($owner, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $owner.'/profil_pic/'.$user -> getUserData($owner, 'profil_image') ;?>');"></div>
                            </div>
                            <span class="txt"><?= $user -> getUserData($owner, 'first_name') ?> <?= $user -> getUserData($owner, 'last_name') ?> - <?= $config -> time_elapsed_string($project -> getProjectData($t['project_token'], 'date_begin') ) ?></span>
                        </div>
                    </div>
                    <div class="col-4 part">
                        <div class="head_title">Membres</div>
                        <div class="members">
                            <?php 
                                $project_member = $project -> getProjectMembers($t['project_token']);
                                foreach($project_member['content'] as $member){
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
            <div class="title"><strong><?= $project -> getProjectData($t['project_token'], 'name') ;?></strong> souhaite vous inviter dans son équipe</div>
        </div>
        <div class="buttons">
            <form method="POST">
                <input type="hidden" name="invitation" value="<?= $t['project_token'] ?>">
                <button class="btn primary-btn" name="accept_invitation">Accepter</button>
                <button class="btn dark-btn" name="decline_invitation">Refuser</button>
            </form>
        </div>
    </div>

</div>