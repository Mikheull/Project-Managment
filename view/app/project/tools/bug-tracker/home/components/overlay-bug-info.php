<?php
// Les variables $bug_token et $project_token sont définies en AJAX !
$date_creation = new DateTime( $utils -> getData('pr_bug', 'date_creation', 'bug_token', $bug_token ) );

?>
<div class="container" id="bug-content">
    <div id="bug-if" data-ref="<?= $bug_token ?>" data-pro="<?= $project_token ?>"></div>

    <div class="row">
        <div class="col-md-6 offset-md-3 col-10 offset-1 bug_popup">

            <div class="container pt-2">

                <div class="row head">
                    <div class="col-12 flex justify-content-between">
                        <h3 class="title-sm bold color-lg-dark">[<span style="color: #9c36b5"><?= $bug_token ?></span>] - <?= $utils -> getData('pr_bug', 'name', 'bug_token', $bug_token ) ?></h3>
                        <a class="link color-lg-dark" id="close-bug-popup"><i class="far fa-times-circle"></i></a>
                    </div>
                    <div class="col-12 flex justify-content-between">
                        <span class="text-xs">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span></span>
                    </div>
                </div>    

                <div class="row">
                    <div class="col-md-9 col-10 head_menu mr-top">
                        <ul>
                            <li class="mr-3 active" data-page="informations"> <a class="link">Informations</a> </li>
                            <li class="mr-3" data-page="assigned_members"> <a class="link">Membres assignés</a> </li>
                            <li class="" data-page="assigned_teams"> <a class="link">Équipes assignées</a> </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-2 head_settings mr-top">
                        <ul>
                            <li class="mb-2"> <div class="link dark-link" data-action="assign_bug"><i data-feather="user-plus"></i> <span class="md-hide">Assigner</span> </div> </li>
                            <li class="mb-2"> <div class="link dark-link" data-action="edit_bug"><i data-feather="edit"></i> <span class="md-hide">Modifier</span> </div> </li>
                            <li class="mb-2"> <div class="link red-link" data-action="delete_bug"><i data-feather="trash-2"></i> <span class="md-hide">Supprimer</span> </div> </li>
                            <?php
                            if($utils -> getData('pr_bug', 'date_working', 'bug_token', $bug_token ) == NULL){
                                ?> <li class="mr-top-lg mb-2 link" style="color: #d9480f" id="move-to-working"> En cours <i class="fas fa-arrow-right"></i> </li> <?php
                            }else if($utils -> getData('pr_bug', 'date_end', 'bug_token', $bug_token ) == NULL){
                                $date_end = new DateTime( $utils -> getData('pr_bug', 'date_end', 'bug_token', $bug_token ) );
                                ?> <li class="mr-top-lg mb-2 link" style="color: #2b8a3e" id="move-to-end"> Terminé <i class="fas fa-arrow-right"></i> </li> <?php
                            }else{
                                $date_end = new DateTime( $utils -> getData('pr_bug', 'date_end', 'bug_token', $bug_token ) );
                                ?> <li class="mr-top-lg mb-2 link" style="color: #d9480f"> </li> <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-12 menu-content">
                        <div id="informations" class="page_el">
                            <div class="mr-bot">Crée le : <span class="color-lg-dark"><?= $utils -> getData('pr_bug', 'date_creation', 'bug_token', $bug_token ) ;?></span> </div>
                            <?php
                            if($utils -> getData('pr_bug', 'date_working', 'bug_token', $bug_token ) !== NULL){
                                $date_working = new DateTime( $utils -> getData('pr_bug', 'date_working', 'bug_token', $bug_token ) );
                                ?> <div class="mr-bot">"En cours" le : <span class="color-lg-dark"><?= date_format($date_working, 'd/m/Y à H:i') ;?></span> </div> <?php
                            }

                            if($utils -> getData('pr_bug', 'date_end', 'bug_token', $bug_token ) !== NULL){
                                $date_end = new DateTime( $utils -> getData('pr_bug', 'date_end', 'bug_token', $bug_token ) );
                                ?> <div class="mr-bot">Terminé le : <span class="color-lg-dark"><?= date_format($date_end, 'd/m/Y à H:i') ;?></span> </div> <?php
                            }
                            ?>
                        </div>

                        <div id="assigned_members" class="page_el hidden">
                            <?php
                                $allMembersAssigned = $bug -> getAllMemberAssigned($project_token, $bug_token);
                                if($allMembersAssigned['count'] !== 0){
                                    ?> 
                                    <ul>
                                        <?php 
                                        foreach($allMembersAssigned['content'] as $ms){
                                            if($ms !== ''){
                                                ?> 
                                                <li class="color-lg-dark flex">
                                                    <div class="avatar avatar--xs mr-right"> 
                                                        <figure class="avatar__figure" role="img">
                                                            <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                            <img class="avatar__img" src="../../../../dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $ms) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $ms.'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $ms) ;?>">
                                                        </figure>
                                                    </div>
                                                    <span> <?= $utils -> getData('imp_user', 'username', 'public_token', $ms ) ?> </span>
                                                </li> 
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </ul>
                                    <?php
                                }else{
                                    ?> 
                                    <span class="bold text-sm color-lg-dark">Aucun membre assigné !</span>
                                    <?php
                                }
                            ?>
                        </div>

                        <div id="assigned_teams" class="page_el hidden">
                            <?php
                                $allTeamsAssigned = $bug -> getAllTeamAssigned($project_token, $bug_token);
                                if($allTeamsAssigned['count'] !== 0){
                                    ?> 
                                    <ul>
                                        <?php 
                                        foreach($allTeamsAssigned['content'] as $ts){
                                            if($ts !== ''){
                                                ?> 
                                                <li class="color-lg-dark flex">
                                                    <span> <?= $utils -> getData('pr_project_team', 'name', 'public_token', $ts ) ?> </span>
                                                </li> 
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </ul>
                                    <?php
                                }else{
                                    ?> 
                                    <span class="bold text-sm color-lg-dark">Aucune équipe assigné !</span>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    feather.replace()
});
</script>