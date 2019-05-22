<?php
    if($auth -> isConnected() == true){
        $userToken = $main -> getToken();
?>






<a href="app/team/">Equipes</a>     
<a href="app/project/">projets</a>     






<?php
    }else{
        header('location: login?return_url=app');
    }
?>