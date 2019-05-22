<?php require ('controller/team.php') ;?>


<?php
    if($auth -> isConnected() == true){
?>



    <?php require ('view/components/navbar-header-light.php') ;?>

        <section class="content">
            <?php

                if($team -> teamExist($router -> getRouteParam('1'))){

                    if($team -> canAcess($router -> getRouteParam('1'), $_SESSION['user_token'])){
                        require ('view/content/team/dashboard/components/home.php');
                    }else{
                        require ('view/content/team/dashboard/components/error.php');
                    }

                }else{
                    require ('view/content/team/dashboard/components/error.php');
                }

            ?>
        </section>

    <?php require ('view/components/footer.php') ;?>



<?php
    }else{
        header('location: login?return_url=team');
    }
?>