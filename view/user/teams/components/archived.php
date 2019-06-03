<?php
    $owner = $team -> getTeamData($t['public_token'], 'founder_token');
?>

<div class="block-item">
    <div class="heading">
        <div class="container">
            <div class="row">
                <div class="col-8 left">
                    <div class="team_profilImage"><?= substr($team -> getTeamData($t['public_token'], 'name'), 0, 1) ;?></div>
                    <div class="name"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $t['public_token'] ?>"> <?= $team -> getTeamData($t['public_token'], 'name') ;?> </a> </div>
                    <div class="lock"> <?= $team -> getTeamData($t['public_token'], 'public') == true ? '<i data-feather="unlock" data-tippy="Équipe publique"></i>' : '<i data-feather="lock" data-tippy="Équipe privée"></i>' ;?> </div>
                </div> 
                
                <?php if($router -> getRouteParam('0') == 'account'){ ?>
                    <div class="col-4 right">
                        <i class="fas fa-ellipsis-h" id="act-<?= $t['public_token'] ;?>"></i>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php
if($router -> getRouteParam('0') == 'account'){
?>
    <div id="tp-<?= $t['public_token'] ?>" class="hidden">
        <ul class="margin-bot">
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