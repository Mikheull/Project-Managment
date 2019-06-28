<div class="row head-bar margin-bot-lg">
    <div class="col">
        <h3 class="title-sm bold color-dark">Équipes <span><?= $getUserTeams['count'] ;?></span></h3>
        <p class="color-gray">Trouvez et rejoignez une équipe, ou bien créez la votre dès maintenant.</p>
    </div>

    <div class="col text-align-right">
        <a href="<?= $config -> rootUrl() ;?>app/new/team" class="btn btn-sm primary-btn"> <i class="fas fa-plus"></i> Créer</a>
    </div>
</div>