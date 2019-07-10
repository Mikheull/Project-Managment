<?php
    require_once ('controller/project.php') ;
    require_once ('controller/messenger.php') ;
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/messenger/components/navbar.php') ?>

    <div class="container">
        <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'messenger.access')){
               ?>
               <div class="row tabs margin-top-lg">
                    <div class="col-md-3 col-12 light-border" style="height:80vh">
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

                    <div class="col-md-9 col-12 align-self-center text-align-center light-border" style="height:80vh">
                        <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/messenger.svg" alt="" width="30%" class="margin-top-lg margin-bot-lg">
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
