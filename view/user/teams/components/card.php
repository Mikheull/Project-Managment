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
                    <div class="lock"> <?= $team -> getTeamData($t['team_token'], 'public') == true ? '<i data-feather="unlock" data-tippy="Équipe publique"></i>' : '<i data-feather="lock" data-tippy="Équipe privée"></i>' ;?> </div>
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
                                ?> 
                                    <div class="item" data-tippy="<?= $user -> getUserData($member['user_public_token'], 'username') ?>"> 
                                        <div class="profil_picture-xs">
                                            <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData($member['user_public_token'], 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $member['user_public_token'].'/profil_pic/'.$user -> getUserData($member['user_public_token'], 'profil_image') ;?>');"></div>
                                        </div>
                                    </div> 
                                <?php
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
    <div id="tp-<?= $t['team_token'] ?>" class="hidden">
        <ul class="margin-bot">
            <li class="margin-top margin-bot"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['team_token'] ?>" class="btn btn-sm dark-btn">Accéder au panel</a> </li>
            <?php
                if($owner == $main -> getToken()){
                    ?>
                        <li> <a href="" data-action="invite" data-ref="<?= $t['team_token'] ?>" class="link dark-link">Inviter</a> </li>
                        <li> <a href="" data-action="rename" data-ref="<?= $t['team_token'] ?>" class="link dark-link">Renommer</a> </li>
                        <li class="margin-bot"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['team_token'] ?>/settings" class="link dark-link">Gérer</a> </li>
                        <li> <a href="" data-action="archive" data-ref="<?= $t['team_token'] ?>" class="link dark-link">Archiver</a> </li>
                        <li> <a href="" data-action="delete" data-ref="<?= $t['team_token'] ?>" class="link red-link">Supprimer</a> </li>
                    <?php
                }else{
                    ?>
                        <li> <a href="" data-action="leave" data-ref="<?= $t['team_token'] ?>" class="link red-link">Quitter</a> </li>
                    <?php
                }
            ?>
        </ul>
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