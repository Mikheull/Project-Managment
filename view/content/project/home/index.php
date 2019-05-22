<?php require ('controller/project.php') ;?>


<section class="content">
    <div class="container">
        <div class="row">
            <?php

                if($project -> checkIfProjectExist($router -> getRouteParam('1'))){
                    ?>
                    Il existe
                    <?php
                }else{
                    ?>
                    <div class="col-12">
                        <div class="title">
                            <h2>Ce projet n'existe pas !</h2>
                        </div>
                    </div>
                    <?php
                }

            ?>
        </div>
    </div>
</section>

