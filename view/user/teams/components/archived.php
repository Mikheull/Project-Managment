<?php
    $owner = $utils -> getData('pr_team', 'founder_token', 'public_token', $t['public_token']);
?>



<div class="col-md-4 col-12">
    <div class="card-item light-border">

        <div class="header">
            <div class="options text-align-right margin-right margin-top">
                <div class="dropdown margin-left">
                    <?php if($router -> getRouteParam('0') == 'account'){ ?>
                        <i class="fas fa-ellipsis-h" id="act-<?= $t['public_token'] ;?>"></i>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="content margin-bot-lg margin-top text-align-center">
            <div class="team_profilImage"><?= substr($utils -> getData('pr_team', 'name', 'public_token', $t['public_token']), 0, 1) ;?></div>
            <div class="name title-sm bold color-dark"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['public_token'] ?>"> <?= $utils -> getData('pr_team', 'name', 'public_token', $t['public_token']) ;?> </a> </div>
            <div class="desc color-lg-dark margin-top"> L'équipe est actuellement archivé, désarchivé là pour y avoir accès </div>
        </div>
    </div>
</div>









<?php
if($router -> getRouteParam('0') == 'account'){
?>
    <div id="tp-<?= $t['public_token'] ?>" class="hidden">
        <ul class="margin-bot margin-top">
            <?php
                if($owner == $main -> getToken()){
                    ?>
                        <li> <a href="" data-action="unarchive" data-ref="<?= $t['public_token'] ?>" class="link dark-link">Désarchiver</a> </li>
                        <li> <a href="" data-action="delete" data-ref="<?= $t['public_token'] ?>" class="link red-link">Supprimer</a> </li>
                    <?php
                }
            ?>
        </ul>
    </div>

    <script>
        var template = document.getElementById('tp-<?= $t['public_token'] ?>')
        tippy('#act-<?= $t['public_token'] ?>', {
            content: template.innerHTML,
            animation: 'fade',
            theme: 'light-border',
            interactive: true,
            placement: 'bottom',
            arrowType: 'round',
            arrow: true,
        })
    </script>
<?php
}
?>