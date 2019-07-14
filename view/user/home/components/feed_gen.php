<div class="container">
    <div class="row">
        <div class="col-12 margin-bot-lg">
            <h2 class="title-lg bold color-dark">A rejoins Improove</h2>
            <h3 class="title-sm color-dark "> <?= $config -> time_elapsed_string($utils -> getData('imp_user', 'date_join', 'public_token', $userToken )) ?> </h3>
        </div>

        <!-- <div class="col-12">
            <h2 class="title-lg bold color-dark">Dernière connexion</h2>
            <h3 class="title-sm color-dark "> <?= $config -> time_elapsed_string($utils -> getData('imp_user', 'date_last_join', 'public_token', $userToken )) ?> </h3>
        </div> -->
    </div>
</div>