<?php
    $owner = $project -> getProjectData($t['public_token'], 'founder_token');
?>


<div class="col-md-4 col-12">
    <div class="card-item light-border mr-bot">
        <div class="header relative">
            <div class="head-bg absolute">
                <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 43.78"><path style="fill: #242e5a" d="M0,0H64V35C32,43.78,0,43.78,0,43.78Z"/><path style="fill: #242e5a" d="M64,35"/></svg>
            </div>

            <div class="flex justify-content-between">
                <div class="status mr-top mr-left <?= $utils -> getData('pr_project', 'public', 'public_token', $t['public_token']) == true ? 'bg-primary' : 'bg-red' ;?> color-light text-xs">
                    <?= $utils -> getData('pr_project', 'public', 'public_token', $t['public_token']) == true ? 'publique' : 'privée' ;?>
                </div>

                <?php if($router -> getRouteParam('0') == 'account'){ ?>
                    <div class="options color-light link mr-top mr-right">
                        <i class="fas fa-ellipsis-h" id="act-<?= $t['public_token'] ;?>"></i>
                    </div>
                <?php } ?>
            </div>

            <div class="heading text-align-center mr-top-lg">
                <div class="team_profilImage"><?= substr($utils -> getData('pr_project', 'name', 'public_token', $t['public_token']), 0, 1) ;?></div>
                <div class="name title-sm bold"> <a class="link light-link"> <?= $utils -> getData('pr_project', 'name', 'public_token', $t['public_token']) ;?> </a> </div>
            </div>
        </div>

        <div class="content mr-bot-lg text-align-center">
            <div class="desc color-red mr-top-lg"> Le projet est actuellement archivé, désarchivé là pour y avoir accès </div>
        </div>

    </div>
</div>






<?php
if($router -> getRouteParam('0') == 'account'){
?>
    <div id="tp-<?= $t['public_token'] ?>" class="hidden">
        <ul class="mr-bot mr-top">
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