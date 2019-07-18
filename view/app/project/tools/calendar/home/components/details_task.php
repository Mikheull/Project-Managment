<div class="details_container container light-border">
    <div id="close" class="link" style="position: absolute;right: 30px;top: 10px;z-index: 99"> <i class="fas fa-times"></i> </div>

    <div class="row mr-bot-lg mr-top">
        <div class="col-12 text-align-center"><h2 class="title-md bold color-primary">Tâche</h2></div>
    </div>

    <div class="row">
        <div class="col-12 mr-bot-lg">
            <h3 class="title-xs bold title-sm-shadow">Details</h3>
            <ul>
                <li class="mr-left mr-top">Nom : <span class="color-lg-dark"><?= $utils -> getData('pr_task_item', 'name', 'task_token', $exp[1] ) ;?></span> </li>
                <li class="mr-left">Tableau : <span class="color-lg-dark"><?= $utils -> getData('pr_task_tab', 'name', 'tab_token', $utils -> getData('pr_task_item', 'tab_token', 'task_token', $exp[1] ) ) ;?></span> </li>
                <li class="mr-left mr-top">Durée prévue : <span class="color-lg-dark"><?= $utils -> getData('pr_task_item', 'duration', 'task_token', $exp[1] ) ;?></span> </li>
                <li class="mr-left">Fin prévue : <span class="color-lg-dark"><?= $utils -> getData('pr_task_item', 'deadline', 'task_token', $exp[1] ) ;?></span> </li>
            </ul>
        </div>

        <div class="col-12 mr-bot-lg">
            <h3 class="title-xs bold title-sm-shadow">Log</h3>
            <ul>
                <li class="mr-left mr-top">Date de création : <span class="color-lg-dark"><?= $utils -> getData('pr_task_item', 'date_creation', 'task_token', $exp[1] ) ;?></span> </li>
                <li class="mr-left">Créateur : <span class="color-lg-dark">undefined</span> </li>
            </ul>
        </div>
    </div>


    <div class="row">
        <div class="col-12 flex mr-bot">
        
            <a class="btn btn-sm light-btn-bordered mr-right" href="gestion-projet"><i class="fas fa-link"></i></a>
            <div class="btn btn-sm dark-btn mr-right" data-action="edit_task" data-ref="<?= $exp[1] ?>"><i class="fas fa-edit"></i></div>
            <div class="btn btn-sm mr-right dark-btn" id="sharing"><i class="far fa-share-square"></i></div>
            <div class="btn btn-sm dark-btn" data-action="delete_task" data-ref="<?= $exp[1] ?>"><i class="far fa-trash-alt"></i></div>
        </div>
    </div>
</div>





<div id="share_links"  class="hidden">
    <ul class="mr-top mr-bot text-align-left">
        <?php $url_message = "%F0%9F%93%8B%20%Tache%20".$utils -> getData('pr_task_item', 'name', 'task_token', $exp[1] )."%0A%F0%9F%93%85%20Le%20".$utils -> getData('pr_task_item', 'date_creation', 'task_token', $exp[1] ) ?>
        <li class="nav-item"> <a target="blank" href="https://twitter.com/intent/tweet?text=<?= $url_message ;?>" class="dark-link"> Partager sur Twitter </a> </li>
        <li class="nav-item"> <a href="whatsapp://send?text=<?= $url_message ;?>" class="dark-link"> Partager sur Whatsapp </a> </li>
        <li class="nav-item"> <a target="blank" href="" class="dark-link"> Partager sur Messenger </a> </li>
        <li class="nav-item"> <a href="mailto:?subject=Partage de tache&body=📋 Tache <?= $utils -> getData('pr_task_item', 'name', 'task_token', $exp[1] ) ?> 📅 Le <?= $utils -> getData('pr_task_item', 'date_creation', 'task_token', $exp[1] ) ?>" class="dark-link"> Partager par Mail </a> </li>
    <ul>
</div>


<script>
    var template = document.getElementById('share_links')
    tippy('#sharing', {
        content: template.innerHTML,
        animation: 'fade',
        theme: 'light-border',
        interactive: true,
        placement: 'bottom',
        arrowType: 'round',
        arrow: true,
    })
</script>