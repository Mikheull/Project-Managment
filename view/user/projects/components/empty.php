<div class="row text-align-center">
    <div class="col-8 offset-2 margin-top-lg">
        <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_teams.svg" alt="" width="60%">
    </div>
    <div class="col-8 offset-2 margin-top-lg margin-bot-lg">
        <?php
            if($router -> getRouteParam('0') == 'account'){
                ?> <p class="color-black">Vous n'avez pas encore rejoins de projets !</p> <?php
            }else{
                ?> <p class="color-black">L'utilisateur n'a pas encore rejoins de projets !</p> <?php
            }
        ?>
    </div>
</div>