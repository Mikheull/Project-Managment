<?php
    require_once ('controller/project.php') ;
    require_once ('controller/messenger.php') ;
    require_once ('controller/projectTeam.php') ;

    if($messenger -> isChannelMember($main -> getToken(), $router -> getRouteParam("2"), $router -> getRouteParam("5")) == false){
        $messenger -> registerMemberChannel($main -> getToken(), $router -> getRouteParam("2"), $router -> getRouteParam("5"));
    }

    $lastChannelMessage = $messenger -> getLastMessagePosted($router -> getRouteParam("5"));
    $messenger -> setLastViewedMessage($main -> getToken(), $router -> getRouteParam("2"), $router -> getRouteParam("5"), $lastChannelMessage['message_token'])
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">
        <div class="container-fluid">

            <div class="row tabs mr-top-lg">
                <div class="col-lg-3 col-2 light-border conv_wrapper">
                    <?php
                        $allChannels = $messenger -> getProjectChannels($router -> getRouteParam("2"));
                        foreach($allChannels['content'] as $channel){
                            $lastMessage = $messenger -> getLastMessagePosted($channel['channel_token']);

                            ?> 
                                <a class="conv-item row mr-top mr-bot" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger/<?= $channel['channel_token'] ;?>">
                                    
                                    <div class="col-2">
                                        <div class="avatar avatar--md">
                                            <figure class="avatar__figure" role="img" aria-label="James Powell">
                                                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                <div class="avatar__initials"><span class="color-lg-dark"><?= strtoupper(substr($channel['name'], 0, 1)).substr($channel['name'], 1, 1) ;?></span></div>
                                            </figure>
                                            <?php
                                                if($lastMessage['content'] !== null){
                                                    $lastChannelMessage = $messenger -> getLastMessagePosted($channel['channel_token']);
                                                    if($lastChannelMessage['message_token'] !== $messenger -> getLastViewedMessage($main -> getToken(), $router -> getRouteParam("2"), $channel['channel_token'])){
                                                        ?> <span role="status" class="avatar__status avatar__status--active avatar__status--primary" aria-label="Active"></span> <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-10 lg-hide">
                                        <div class="flex justify-content-between">
                                            <span class="text-sm"><?= $channel['name'] ;?></span>
                                            <span class="text-xs"><?= $config -> time_elapsed_string($lastMessage['date_edited'] == null ? $lastMessage['date_creation'] : $lastMessage['date_edited']) ?></span>
                                        </div>
                                        <div class="mr-top mr-bot">
                                            <?php
                                                if($lastMessage['content'] == null){
                                                    ?>
                                                        <div class="text-xs">Aucun message récent</div> 
                                                    <?php
                                                }else{
                                                    $mes = ($lastMessage['content_edited'] == null ? $lastMessage['content'] : $lastMessage['content_edited']);
                                                    ?>
                                                        <div class="text-xs"><?= substr($mes, 0, 30); ?>...</div> 
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>


                                    
                                </a> 
                            <?php
                        }
                    ?>
                    <a class="lg-hide btn btn-sm primary-btn flex center" data-action="new_channel" data-pro="<?= $router -> getRouteParam('2') ?>" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger">Nouveau channel</a> 
                    <a class="lg-show btn btn-sm primary-btn flex center" data-action="new_channel" data-pro="<?= $router -> getRouteParam('2') ?>" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger"><i data-feather="plus-circle"></i></a> 
                </div>

                <div class="col-md-9 col-10 conv_wrapper chat">
                    <div class="chat-history overflow">

                        <!-- <div id="loader" style="text-align:center;"><img src="<?= $config -> rootUrl() ;?>dist/images/content/loading-64px.gif" /></div> -->
                        <ul>

                            <?php
                                $allMessages = $messenger -> getMessages($router -> getRouteParam("5"));
                                $group_count = 1;
                                foreach($allMessages['content'] as $message){
                                    $mes = $message['content_edited'] == null ? $message['content'] : $message['content_edited'];
                                    $mes = $messenger -> convertMarkdown($mes, $router -> getRouteParam("2"));
                                    
                                    $check = false;
                                    if(isset($pre_sender)){
                                        if($pre_sender == $message['author_token']){
                                            $date1 = new DateTime($pre_sender_date);
                                            $date1->modify('+15 minute');
                                            $date2 = new DateTime($message['date_creation']);
                                            if ($date1 < $date2) {
                                                $check = true;
                                            }
                                        }else{
                                            $check = true;
                                        }
                                    }else{
                                        $check = true;
                                    }
                                    ?>
                                        <li class="message-item <?= ($check == true) ? 'mr-top-lg mb-2' : 'mb-2' ?>" data-token="<?= $message['message_token'] ?>">
                                            
                                            <?php
                                            if($check == true){
                                                ?>
                                                <div class="message-data flex">
                                                    <span class="message-data-name flex text-xs">
                                                        <div class="avatar avatar--md mr-right"> 
                                                            <figure class="avatar__figure" role="img">
                                                                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                                <img class="avatar__img" src="<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $message['author_token']) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $message['author_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $message['author_token']) ;?>">
                                                            </figure>
                                                        </div>
                                                        <?php
                                                            $ch = $projectTeam -> getHighTeamMember($message['author_token'], $router -> getRouteParam("2"));
                                                            if($ch !== ''){
                                                                ?>
                                                                    <span class="mt-1 mr-1 role bold" style="border: <?= $utils -> getData('pr_project_team', 'color', 'public_token', $ch ) ?> solid 1px;color: <?= $utils -> getData('pr_project_team', 'color', 'public_token', $ch ) ?>"> <?= $utils -> getData('pr_project_team', 'name', 'public_token', $ch ) ?> </span> 
                                                                <?php
                                                            }
                                                        ?>
                                                        <span class="mt-1"> <?= $utils -> getData('imp_user', 'username', 'public_token', $message['author_token']) ?></span> 
                                                        <span class="mt-1 mr-left color-gray text-xs"><?= $config -> time_elapsed_string($message['date_edited'] == null ? $message['date_creation'] : $message['date_edited']) ?></span>
                                                    </span>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="flex justify-content-between">
                                                <div class="message flex justify-content-between">
                                                    <p> <?= $mes ;?> </p>
                                                </div>
                                                <!-- <span class="mt-1 mr-left color-dark-lg text-xs"><?= $message['content_edited'] !== null ? 'edité' : ''; ?></span> -->
                                                <?php
                                                    if($message['author_token'] == $main -> getToken() && $permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'messenger.tchat.manage')){
                                                        ?> <span class="actions link" data-tippy-content='<span class="message-data-time text-xs" ><?= $message['date_creation'] ?></span><br class="mr-bot"><a class="link dark-link" data-action="edit_message" data-message="<?= $message['message_token'] ?>">Éditer</a><br><a class="link dark-link" data-action="delete_message" data-message="<?= $message['message_token'] ?>">Supprimer</a>'><i class="fas fa-ellipsis-v color-dark"></i></span> <?php
                                                    }else{
                                                        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'messenger.tchat.manage.other')){
                                                            ?> <span class="actions link" data-tippy-content='<span class="message-data-time text-xs" ><?= $message['date_creation'] ?></span><br class="mr-bot"><a class="link dark-link" data-action="delete_message" data-message="<?= $message['message_token'] ?>">Supprimer</a>'><i class="fas fa-ellipsis-v color-dark"></i></span> <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            
                                        </li>
                                        <?php

                                    $pre_token = $message['message_token'];
                                    $pre_sender = $message['author_token'];
                                    $pre_sender_date = $message['date_creation'];
                                }
                            ?>

                        </ul>
                        <div id="anchor"></div>
                    </div>

                    <div class="chat-message clearfix">
                        <form method="post">
                            <textarea name="message_content" id="emojionearea5" placeholder="Ecrivez un message" rows="3"></textarea>
                            <input type="hidden" name="edit_id" value="">
                            <button name="message_send" class="link primary-link">Envoyer</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
$(document).ready(function() {
    $("#emojionearea5").emojioneArea({
        pickerPosition: "top",
        filtersPosition: "bottom",
        hidePickerOnBlur: false
    });
    $("#emojionearea5")[0].emojioneArea.setFocus();
});

tippy('.message-item .actions', {
    animation: 'fade',
    theme: 'light-border',
    interactive: true,
    placement: 'bottom',
    arrowType: 'round',
    arrow: true,

})

$('.overflow').scrollTop($('#anchor').offset().top);


</script>


<div id="channel-list_output"></div>

<?php require_once ('view/app/project/components/footer.php') ?>
