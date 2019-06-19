<div class="row head-bar margin-bot-lg">
    <div class="col">
        <h3 class="title-sm bold color-dark">Projets <span><?= $getUserProjects['count'] ;?>/5</span></h3>
        <p class="color-gray">Trouvez et rejoignez un projet, ou bien créez le votre dès maintenant.</p>
    </div>

    <div class="col text-align-right">
        <!-- <a class="btn btn-sm light-btn-bordered"> <i class="fas fa-star"></i> Vues</a> -->
        <a href="<?= $config -> rootUrl() ;?>app/new/project" class="btn btn-sm primary-btn"> <i class="fas fa-plus"></i> Créer</a>
        <!-- <a class="btn btn-sm light-btn-bordered"> <i class="fas fa-search"></i></a> -->
    </div>
</div>