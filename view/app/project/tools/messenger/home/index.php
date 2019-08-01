<?php
    require_once ('controller/project.php') ;
    require_once ('controller/messenger.php') ;

?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">
        <div class="container-fluid">
            <?php
                if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'messenger.access')){
                ?>
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
                                                            ?> <span role="status" class="avatar__status avatar__status--primary" aria-label="Active"></span> <?php
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

                    <div class="col-lg-9 col-10 align-self-center text-align-center conv_wrapper light-border">
                        <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/messenger.svg" alt="" width="30%" class="mr-top-lg mr-bot-lg">
                    </div>

                </div>
                <?php 
                }else{
                    ?>
                    <div class="no-access">Vous n'avez pas la permission nécessaire pour accéder a ce contenu</div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<div id="channel-list_output"></div>

<?php require_once ('view/app/project/components/footer.php') ?>