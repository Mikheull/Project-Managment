<template id="notifications_tmpl">
    <ul>
        <?php
            if(empty($user -> getUnreadNotifs())){
                echo 'Aucune notifications';
            }else{
                foreach($user -> getUnreadNotifs() as $notif){
                    $content = json_decode( $notif['content'] );
                    $message = str_replace('%user%', $user -> getUserData( $content->{'sender'}, 'username' ), $content->{'message'});
                    
                    ?>
                    <li> <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getUserData( $content->{'sender'}, 'username' ) ?>"><?= htmlspecialchars_decode($message) ?></a> </li>
                    <?php
                }
            }
        ?>
    </ul>
</template>