<?php
    require_once ('controller/team.php') ;

    if($auth -> isConnected() == true){

        require_once ('view/content/app/components/sidebar.php');
?>


        <div class="container-fluid main_wrapper">
            <form action="" method="post">
                <input type="text" name="name" id="name" placeholder="Nom">
                <input type="text" name="desc" id="desc" placeholder="Description">

                <button class="primary-btn" name="create_team">Créer</button>
            </form>
        </div>


<?php
    }else{
        header('location: ../../login?return_url=app%2Fteam');
    }
?>