<div class="container error">
    <div class="row">
        <div class="col-md-6 col-12 align-self-center content text-align-center">
            <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/error-empty.svg" alt="" width="50%">
        </div>

        <div class="col-md-6 col-12 align-self-center content">
            <div class="title">
                <p>Ce projet n'existe pas ou vous n'y avez pas accès !</p>
                <a href="<?= $config -> rootUrl() ;?>app/new-project" class="btn primary-btn">Rejoignez ou créez en un</a>
            </div>
        </div>
    </div>
</div>