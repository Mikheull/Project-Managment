<?php
    require_once ('controller/project.php') ;
    require_once ('controller/messenger.php') ;
    require_once ('controller/parsedown.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">
        <div class="container-fluid">

            <div class="row tabs mr-top-lg light-border">
                <div class="col-md-3 col-12 conv_list">
                    <?php
                        $allChannels = $messenger -> getProjectChannels($router -> getRouteParam("2"));
                        foreach($allChannels['content'] as $channel){
                            $lastMessage = $messenger -> getLastMessagePosted($channel['channel_token']);

                            ?> 
                                <a class="conv-item row mr-top mr-bot" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger/<?= $channel['channel_token'] ;?>">
                                    <div class="col-12 mr-bot color-lg-dark">#<?= $channel['name'] ;?></div> 
                                    <?php
                                    if($lastMessage['content'] == null){
                                        ?>
                                            <div class="col-12 text-xs">Aucun message récent</div> 
                                        <?php
                                    }else{
                                        $mes = ($lastMessage['content_edited'] == null ? $lastMessage['content'] : $lastMessage['content_edited']);
                                        ?>
                                            <div class="col-8 text-xs"><?= substr($mes, 0, 30); ?>...</div> 
                                            <div class="col-4 text-xs"><?= $config -> time_elapsed_string($lastMessage['date_edited'] == null ? $lastMessage['date_creation'] : $lastMessage['date_edited']) ?></div> 
                                        <?php
                                    }
                                    ?>
                                </a> 
                            <?php
                        }
                    ?>
                    <a class="btn btn-sm primary-btn flex center" data-action="new_channel" data-pro="<?= $router -> getRouteParam('2') ?>" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger/<?= $router -> getRouteParam('5') ?>">Nouveau channel</a> 
                </div>

                <div class="col-md-9 col-12 conv_wrapper chat">
                    <div class="chat-history">
                        <div class="text-align-center">
                            <span class="text-xs color-primary">Début du channel : <?= $config -> time_elapsed_string($utils -> getData('pr_messenger_channels', 'date_creation', 'channel_token', $router -> getRouteParam("5"))) ?></span>
                        </div>

                        <ul>

                            <?php
                                $allMessages = $messenger -> getMessages($router -> getRouteParam("5"));
                                $group_count = 1;
                                foreach($allMessages['content'] as $message){
                                    $mes = $message['content_edited'] == null ? $message['content'] : $message['content_edited'];
                                    $mes = $utils -> parsedownChannel($mes, $router -> getRouteParam("2"));
                                    
                                    

                                    if($message['author_token'] == $main -> getToken()){
                                        ?>
                                        <li class="clearfix" data-token="<?= $message['message_token'] ?>">
                                            <?php
                                            if(isset($pre_sender)){
                                                if($pre_sender == $message['author_token']){
                                                    
                                                    $date1 = new DateTime($pre_sender_date);
                                                    $date1->modify('+15 minute');
                                                    $date2 = new DateTime($message['date_creation']);
                                                    
                                                    if ($date1 > $date2) {
                                                        $group_count = $group_count + 1;
                                                    }else{
                                                        $group_count = 1;
                                                        ?>
                                                            <script> $( 'li[data-token="<?= $message['message_token'] ?>"]' ).prev( "li" ).children().removeClass( "my-message-middle" ).addClass( "my-message-bottom" );</script>
                                                            <div class="message-data text-align-right mr-top"> <span class="message-data-time text-xs" ><?= $config -> time_elapsed_string($message['date_edited'] == null ? $message['date_creation'] : $message['date_edited']) ?></span> </div>
                                                        <?php
                                                    }
                                                }
                                            }else{
                                                ?>
                                                    <div class="message-data text-align-right mr-top"> <span class="message-data-time text-xs" ><?= $config -> time_elapsed_string($message['date_edited'] == null ? $message['date_creation'] : $message['date_edited']) ?></span> </div>
                                                <?php
                                            }
                                            ?>
                                            
                                            <div class="message my-message float-right flex justify-content-between <?= $group_count == 1 ? 'my-message-top' : 'my-message-middle' ?>">
                                                <?= $mes ;?>
                                                <?php
                                                    if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'messenger.tchat.manage')){
                                                        ?> <span class="actions"><i class="fas fa-ellipsis-v color-dark"></i></span> <?php
                                                    }
                                                ?>
                                            </div>
                                        </li>
                                        <?php


                                    }else{
                                        ?>
                                        <li>
                                            <?php
                                            if(isset($pre_sender)){
                                                if($pre_sender == $message['author_token']){
                                                    $date1 = new DateTime($pre_sender_date);
                                                    $date1->modify('+15 minute');
                                                    $date2 = new DateTime($message['date_creation']);
                                                    if ($date1 > $date2) {
                                                        // echo 'moins de 15 minutes, on groupe';
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="message-data flex">
                                                <span class="message-data-name flex text-xs">
                                                    <div class="avatar avatar--sm mr-right"> 
                                                        <figure class="avatar__figure" role="img">
                                                            <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                            <img class="avatar__img" src="<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $message['author_token']) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $message['author_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $message['author_token']) ;?>">
                                                        </figure>
                                                    </div>
                                                    <?= $utils -> getData('imp_user', 'username', 'public_token', $message['author_token']) ?>
                                                </span>&nbsp; &nbsp;
                                                <span class="message-data-time text-xs"><?= $config -> time_elapsed_string($message['date_edited'] == null ? $message['date_creation'] : $message['date_edited']) ?></span>
                                            </div>
                                            <div class="message other-message flex justify-content-between message-middle">
                                                <?= $mes ;?>
                                                <?php
                                                    if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'messenger.tchat.manage.other')){
                                                        ?> <span class="actions"><i class="fas fa-ellipsis-v color-dark"></i></span> <?php
                                                    }
                                                ?>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    $pre_token = $message['message_token'];
                                    $pre_sender = $message['author_token'];
                                    $pre_sender_date = $message['date_creation'];
                                }
                            ?>

                        </ul>
                    </div>

                    <div class="chat-message clearfix">
                        <form method="post">
                            <textarea name="message_content" id="emojionearea5" placeholder="Ecrivez un message" rows="3"></textarea>
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
    
});
</script>


<div id="channel-list_output"></div>
