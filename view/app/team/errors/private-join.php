<div class="container error margin-top-lg">
    <div class="row text-align-center">
        <div class="col-6 offset-3 align-self-center">
            <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/invitation_private.svg" alt="" width="50%">
        </div>

        <div class="col-8 offset-2 margin-top-lg">
            <div class="title">
                <h3 class="title-md color-dark">Rejoindre l'équipe : </h3>
                <h2 class="title-sm bold color-lg-dark"><?= $utils -> getData('pr_team', 'name', 'public_token', $team_token) ?></h2>
            </div>

            <div class="margin-top-lg">
                <a href="<?= $config -> rootUrl() ;?>app/join/team/<?= $team_token ?>" class="btn primary-btn">Rejoindre</a>
            </div>
        </div>
    </div>
</div>