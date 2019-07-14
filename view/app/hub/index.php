<?php
    require_once ('controller/project.php') ;
    $allUserProjects = $project -> getUserProject($main -> getToken());
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper text-align-center">
    <?php
        if($allUserProjects['count'] !== 0){
            require_once ('view/app/hub/components/home.php');
        }else{
            require_once ('view/app/hub/components/empty.php');
        }
    ?>
</div>