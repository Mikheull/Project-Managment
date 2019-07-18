<div class="row head-bar mr-bot-lg">
    <div class="col">
        <h3 class="title-sm bold color-dark">Projets <span><?= $getUserProjects['count'] ;?>/5</span></h3>
        <p class="color-gray">Trouvez et rejoignez un projet, ou bien créez le votre dès maintenant.</p>
    </div>

    <div class="col text-align-right">
        <a href="<?= $config -> rootUrl() ;?>app/new/project" class="btn btn-sm primary-btn"> <i class="fas fa-plus"></i> Créer</a>
    </div>
</div>