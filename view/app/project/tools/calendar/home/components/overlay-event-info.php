<?php
// Les variables $event_token et $project_token sont définies en AJAX !

$date1 = new DateTime();
$date_creation = new DateTime( $utils -> getData('pr_event', 'date_creation', 'event_token', $event_token ) );

?>
<div class="container" id="event-content">
    <div id="event-if" data-ref="<?= $event_token ?>" data-pro="<?= $project_token ?>"></div>

    <div class="row">
        <div class="col-md-6 offset-md-3 col-10 offset-1 event_popup">

            <div class="container pt-2">

                <div class="row head">
                    <div class="col-12 flex justify-content-between">
                        <h3 class="title-sm bold color-lg-dark"><?= $utils -> getData('pr_event', 'name', 'event_token', $event_token ) ?></h3>
                        <a class="link color-lg-dark" id="close-event-popup"><i class="far fa-times-circle"></i></a>
                    </div>
                    <div class="col-12 flex justify-content-between">
                        <span class="text-xs">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span></span>
                    </div>
                </div>    

                <div class="row">
                    <div class="col-md-9 col-10 head_menu mr-top">
                        <ul>
                            <li class="mr-3 active" data-page="informations"> <a class="link">Informations</a> </li>
                            <li class="mr-3" data-page="activity"> <a class="link">Activité</a> </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-2 head_settings mr-top">
                        <ul>
                            <li class="mb-2"> <div class="link dark-link" data-action="edit_event"><i data-feather="edit"></i> <span class="md-hide">Modifier</span> </div> </li>
                            <li class="mb-2"> <div class="link dark-link" id="sharing"><i data-feather="share"></i> <span class="md-hide">Partager</span> </div> </li>
                            <li class="mb-2"> <div class="link red-link" data-action="delete_event"><i data-feather="trash-2"></i> <span class="md-hide">Supprimer</span> </div> </li>
                        </ul>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-12 menu-content">
                        <div id="informations" class="page_el">
                            <ul>
                                <li class="mr-left">Description : <span class="color-lg-dark"><?= $utils -> getData('pr_event', 'description', 'event_token', $event_token ) ;?></span> </li>
                                <li class="mr-left">Date de début : <span class="color-lg-dark"><?= $utils -> getData('pr_event', 'date_begin', 'event_token', $event_token ) ;?></span> </li>
                                <li class="mr-left">Date de fin : <span class="color-lg-dark"><?= $utils -> getData('pr_event', 'date_end', 'event_token', $event_token ) ;?></span> </li>
                            </ul>
                        </div>

                        <div id="activity" class="page_el hidden">
                            <ul class="list-activity">
                                <?php
                                $task_activity = $activity -> getActivity($project_token, $event_token);
                                if($task_activity['count'] !== 0){
                                    foreach($task_activity['content'] as $act_item){
                                        $date = new DateTime( $act_item['date'] );
                                        ?>
                                        <li class="mr-bot">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-8 flex">
                                                        <div class="avatar avatar--md mr-right"> 
                                                            <figure class="avatar__figure" role="img">
                                                                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                                <img class="avatar__img" src="../../../../dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $act_item['user_public_token']) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $act_item['user_public_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $act_item['user_public_token']) ;?>">
                                                            </figure>
                                                        </div>
                                                        <span class="mt-1 color-lg-dark"> <?= $utils -> getData('imp_user', 'username', 'public_token', $act_item['user_public_token'] ) ?>
                                                            <?php
                                                                if($act_item['type'] == 'create-event-calendar'){
                                                                    ?> <span> à créer l'évènement </span><?php
                                                                }
                                                                if($act_item['type'] == 'edit-event-calendar'){
                                                                    ?> <span> à modifier l'évènement </span><?php
                                                                }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-8 ml-5">
                                                        <span class="color-gray text-xs"> le <?= date_format($date, 'd/m/Y à H:i') ;?> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spacebar mr-top"><div class="spacebar-lg"></div></div>
                                        </li>
                                            
                                        <?php
                                        
                                    }
                                }else{
                                    ?>Aucune activité pour cette tâche<?php
                                }
                                ?>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<div id="share_links"  class="hidden">
    <ul class="mr-top mr-bot text-align-left">
        <?php $url_message = "%F0%9F%93%8B%20%C3%89v%C3%A9nement%20".$utils -> getData('pr_event', 'name', 'event_token', $exp[1] )."%0A%F0%9F%93%85%20Le%20".$utils -> getData('pr_event', 'date_begin', 'event_token', $exp[1] )."%0A%F0%9F%93%9D%20(undefined_description)" ?>
        <li class="nav-item"> <a target="blank" href="https://twitter.com/intent/tweet?text=<?= $url_message ;?>" class="dark-link"> Partager sur Twitter </a> </li>
        <li class="nav-item"> <a href="whatsapp://send?text=<?= $url_message ;?>" class="dark-link"> Partager sur Whatsapp </a> </li>
        <li class="nav-item"> <a href="mailto:?subject=Partage d'évènement&body=📋 Évènement <?= $utils -> getData('pr_event', 'name', 'event_token', $exp[1] ) ?> 📅 Le <?= $utils -> getData('pr_event', 'date_begin', 'event_token', $exp[1] ) ?> 📝(undefined_description)" class="dark-link"> Partager par Mail </a> </li>
    <ul>
</div>


<script>
    var template = document.getElementById('share_links')
    tippy('#sharing', {
        content: template.innerHTML,
        animation: 'fade',
        theme: 'light-border',
        interactive: true,
        placement: 'bottom',
        arrowType: 'round',
        arrow: true,
    })
</script>


<script>
$(document).ready(function() {
    feather.replace()
});
</script>