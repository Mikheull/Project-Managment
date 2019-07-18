<div class="container error">
    <div class="row">
        <div class="col-md-6 col-12 align-self-center content text-align-center">
            <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/error-empty.svg" alt="" width="50%">
        </div>

        <div class="col-md-6 col-12 align-self-center content">
            <div class="title">
                <p>Cette étude n'existe pas ou vous n'y avez pas accès !</p>
                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="btn primary-btn">Retourner en arrière</a>
            </div>
        </div>
    </div>
</div>