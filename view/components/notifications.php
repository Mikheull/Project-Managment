<template id="notifications_tmpl">
    <ul>
        <?php
            if(empty($user -> getUnreadNotifs())){
                echo 'Aucune notifications';
            }else{
                foreach($user -> getUnreadNotifs() as $notif){
                    $content = json_decode( $notif['content'] );
                    $message = str_replace('%user%', $utils -> getData('imp_user', 'username', 'public_token', $content->{'sender'}), $content->{'message'});
                    
                    ?>
                    <li> <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $content->{'sender'}) ?>"><?= htmlspecialchars_decode($message) ?></a> </li>
                    <?php
                }
            }
        ?>
    </ul>
</template>