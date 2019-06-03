<?php
    require_once ('controller/project.php') ;
    $allUserProjects = $project -> getUserProject($main -> getToken());
?>



<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="fakeLoader"></div>

<div class="container-fluid main_wrapper text-align-center">
    <?php
        if($allUserProjects['count'] !== 0){
            require_once ('view/app/project/hub/components/home.php');
        }else{
            require_once ('view/app/project/hub/components/empty.php');
        }
    ?>
</div>