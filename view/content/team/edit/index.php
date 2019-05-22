<?php require ('controller/team.php') ;?>


<?php
    if($auth -> isConnected() == true){
?>

    <section class="content">
        <div class="container">
            <div class="row">
                <?php

                    if($team -> teamExist($router -> getRouteParam('1'))){
                        if($team -> canAcess($router -> getRouteParam('1'), $_SESSION['user_token'])){
                            ?>
                                Accès autorisé ! on affiche la page
                            <?php
                        }else{
                            ?>
                                <div class="col-12">
                                    <div class="title">
                                        <h2>Cette équipe n'existe pas ou vous n'y avez pas accès !</h2>
                                    </div>
                                </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="col-12">
                            <div class="title">
                                <h2>Cette équipe n'existe pas ou vous n'y avez pas accès !</h2>
                            </div>
                        </div>
                        <?php
                    }

                ?>
            </div>
        </div>
    </section>

<?php
    }else{
        header('location: login?return_url=team');
    }
?>