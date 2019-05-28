<div class="row empty">
    <div class="col-8 offset-2">
        <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_teams.svg" alt="" width="50%">
        <?php
            if($router -> getRouteParam('0') == 'account'){
                ?> <span>Vous n'avez pas encore rejoins d'équipe !</span> <?php
            }else{
                ?> <span>L'utilisateur n'a pas encore rejoins d'équipe !</span> <?php
            }
        ?>
    </div>
</div>