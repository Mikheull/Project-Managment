<?php
    require_once ('controller/project.php') ;
    require_once ('controller/messenger.php') ;
    require_once ('controller/parsedown.php') ;
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/messenger/components/navbar.php') ?>

    <div class="container">
        

        <div class="row tabs margin-top-lg">
            <div class="col-md-3 col-12 light-border conv_list">
                <?php
                    $allChannels = $messenger -> getProjectChannels($router -> getRouteParam("2"));
                    foreach($allChannels['content'] as $channel){
                        $lastMessage = $messenger -> getLastMessagePosted($channel['channel_token']);

                        ?> 
                            <a class="conv-item row margin-top margin-bot" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger/<?= $channel['channel_token'] ;?>">
                                <div class="col-12 margin-bot color-lg-dark">#<?= $channel['name'] ;?></div> 
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
            </div>

            <div class="col-md-9 col-12 light-border conv_wrapper">
                <div class="row">

                    <?php
                        $allMessages = $messenger -> getMessages($router -> getRouteParam("5"));
                        foreach($allMessages['content'] as $message){
                            $mes = $parsedown -> text( $message['content_edited'] == null ? $message['content'] : $message['content_edited'] );
                            $mes = $utils -> parsedownChannel($mes, $router -> getRouteParam("2"));

                            if($message['author_token'] == $main -> getToken()){
                                ?>
                                <div class="msg-item msg-right">
                                    <?= $mes ;?>
                                </div>
                            <?php
                            }else{
                                ?>
                                <div class="msg-item msg-left">
                                    <?= $mes ;?>
                                </div>
                            <?php
                            }
                            
                        }
                    ?>
                    
                </div>
            </div>

        </div>
    </div>
    messages https://github.com/mervick/emojionearea
</div>
