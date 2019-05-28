<?php
    $owner = $team -> getTeamData($t['team_token'], 'founder_token');
?>

<div class="block-item">
    <div class="heading">
        <div class="container">
            <div class="row">
                <div class="col-8 left">
                    <div class="team_profilImage"><?= substr($team -> getTeamData($t['team_token'], 'name'), 0, 1) ;?></div>
                    <div class="name"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['team_token'] ?>"> <?= $team -> getTeamData($t['team_token'], 'name') ;?> </a> </div>
                    <div class="lock"> <?= $team -> getTeamData($t['team_token'], 'public') == true ? '<i class="fas fa-unlock" data-tippy="Équipe publique"></i>' : '<i class="fas fa-lock" data-tippy="Équipe privée"></i>' ;?> </div>
                </div> 
                
                <?php if($router -> getRouteParam('0') == 'account'){ ?>
                    <div class="col-4 right">
                        <i class="fas fa-ellipsis-h" id="act-<?= $t['team_token'] ;?>"></i>
                    </div>
                <?php } ?>
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
                        <div class="image">
                            <img src="<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData($owner, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $owner.'/profil_pic/'.$user -> getUserData($owner, 'profil_image') ;?>" alt="Image de profil" width="100%">
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
                                ?> <div class="item" data-tippy="<?= $user -> getUserData($member['user_public_token'], 'username') ?>"> <img src="<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData($member['user_public_token'], 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $member['user_public_token'].'/profil_pic/'.$user -> getUserData($member['user_public_token'], 'profil_image') ;?>" alt="Image de profil" width="100%"> </div> <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
</div>


<?php
if($router -> getRouteParam('0') == 'account'){
?>
    <div id="tp-<?= $t['team_token'] ?>" style="display: none;">
        <ul>
            <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['team_token'] ?>" class="dark-link">Accéder au panel</a> </li>
            <?php if($owner !== $main -> getToken()){?> <li> <a href="#leave" data-project="<?= $t['team_token'] ?>" class="short-act-btn dark-link" id="leave_frm">Quitter</a> </li> <?php } ;?>
            
            <div class="spacer-sm"></div>

            <?php
                if($owner == $main -> getToken()){
                ?>
                    <li> <a href="#invite-<?= $t['team_token'] ?>" class="invite dark-link">Inviter</a> </li>
                    <li> <a href="#delete" data-project="<?= $t['team_token'] ?>" class="short-act-btn dark-link" id="delete_frm">Supprimer</a> </li>
                <?php
                }
            ?>
            
        </ul>
    </div>


<div id="invite-<?= $t['team_token'] ?>" style="display: none;">
    <form method="post">
        <input type="hidden" name="team_token" id="team_token" value="<?= $t['team_token'] ?>">
        <input type="email" name="user_mail" id="user_mail" placeholder="Mail de l'utilisateur">
        <button class="btn primary-btn" name="invite_member">Inviter</button>
    </form>
</div>



    <script>

        var template = document.getElementById('tp-<?= $t['team_token'] ?>')
        tippy('#act-<?= $t['team_token'] ?>', {
            content: template.innerHTML,
            animation: 'fade',
            theme: 'light-border',
            interactive: true,
            placement: 'bottom',
            arrowType: 'round',
            arrow: true,
        })

    </script>
<?php
}
?>