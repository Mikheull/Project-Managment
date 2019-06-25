
<div class="details_container container light-border">
    <div id="close" class="link" style="position: absolute;right: 30px;top: 10px;z-index: 99"> <i class="fas fa-times"></i> </div>

    <div class="row margin-bot-lg margin-top">
        <div class="col-12 text-align-center"><h2 class="title-md bold color-primary">Événement</h2></div>
    </div>

    <div class="row">
        <div class="col-12 margin-bot-lg">
            <h3 class="title-xs bold title-sm-shadow">Details</h3>
            <ul>
                <li class="margin-left margin-top">Nom : <span class="color-lg-dark"><?= $utils -> getData('pr_event', 'name', 'event_token', $exp[1] ) ;?></span> </li>
                <li class="margin-left">Description : <span class="color-lg-dark"><?= $utils -> getData('pr_event', 'description', 'event_token', $exp[1] ) ;?></span> </li>
                <li class="margin-left">Date : <span class="color-lg-dark"><?= $utils -> getData('pr_event', 'date_begin', 'event_token', $exp[1] ) ;?></span> </li>
            </ul>
        </div>

        <div class="col-12 margin-bot-lg">
            <h3 class="title-xs bold title-sm-shadow">Log</h3>
            <ul>
                <li class="margin-left margin-top">Date de création : <span class="color-lg-dark">undefined</span> </li>
                <li class="margin-left">Créateur : <span class="color-lg-dark">undefined</span> </li>
            </ul>
        </div>
    </div>


    <div class="row">
        <div class="col-12 flex margin-bot">
            <div class="btn btn-sm dark-btn margin-right" data-action="edit_event" data-ref="<?= $exp[1] ?>"><i class="fas fa-edit"></i></div>
            <div class="btn btn-sm margin-right dark-btn" id="sharing"><i class="far fa-share-square"></i></div>
            <div class="btn btn-sm margin-right dark-btn" data-action="delete_event" data-ref="<?= $exp[1] ?>"><i class="far fa-trash-alt"></i></div>
            <?php
                $date = new DateTime( $utils -> getData('pr_event', 'date_begin', 'event_token', $exp[1] ) );
                $date = date_format($date, 'Ymd');
            ?>
            <a class="btn btn-sm light-btn-bordered" target="blank" href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?= $utils -> getData('pr_event', 'name', 'event_token', $exp[1] ) ;?>&dates=<?= $date ;?>/<?= $date ;?>&details=<?= $utils -> getData('pr_event', 'description', 'event_token', $exp[1] ) ;?>"><i class="fab fa-google"></i></a>
        </div>
    </div>
</div>





<div id="share_links"  class="hidden">
    <ul class="margin-top margin-bot text-align-left">
        <?php $url_message = "%F0%9F%93%8B%20%C3%89v%C3%A9nement%20".$utils -> getData('pr_event', 'name', 'event_token', $exp[1] )."%0A%F0%9F%93%85%20Le%20".$utils -> getData('pr_event', 'date_begin', 'event_token', $exp[1] )."%0A%F0%9F%93%9D%20(undefined_description)" ?>
        <li class="nav-item"> <a target="blank" href="https://twitter.com/intent/tweet?text=<?= $url_message ;?>" class="dark-link"> Partager sur Twitter </a> </li>
        <li class="nav-item"> <a href="whatsapp://send?text=<?= $url_message ;?>" class="dark-link"> Partager sur Whatsapp </a> </li>
        <li class="nav-item"> <a target="blank" href="" class="dark-link"> Partager sur Messenger </a> </li>
        <li class="nav-item"> <a href="mailto:?subject=Partage d'évènement&body=📋 Évènement <?= $utils -> getData('pr_event', 'name', 'event_token', $exp[1] ) ?> 📅 Le <?= $utils -> getData('pr_event', 'date_begin', 'event_token', $exp[1] ) ?> 📝(undefined_description)" class="dark-link"> Partager par Mail </a> </li>
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