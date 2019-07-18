<div class="container error mr-top-lg">
    <div class="row text-align-center">
        <div class="col-6 offset-3 align-self-center">
            <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/invitation_public.svg" alt="" width="50%">
        </div>

        <div class="col-8 offset-2 mr-top-lg">
            <div class="title">
                <h3 class="title-md color-dark">Rejoindre le projet : </h3>
                <h2 class="title-sm bold color-lg-dark"><?= $utils -> getData('pr_project', 'name', 'public_token', $project_token) ?></h2>
            </div>

            <div class="mr-top-lg">
                <a href="<?= $config -> rootUrl() ;?>app/join/project/<?= $project_token ?>" class="btn primary-btn">Rejoindre</a>
            </div>
        </div>
    </div>
</div>