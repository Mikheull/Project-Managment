<div class="heading nav-left">
    <h3>Équipes <span><?= $getUserTeams['count'] ;?>/5</span></h3>
    <small>Trouvez et rejoignez une équipe, ou bien créez la votre dès maintenant.</small>
</div>
<div class="buttons nav-right">
    <a class="btn light-btn-bordered"> <i class="fas fa-star"></i> Vue des favoris</a>
    <a href="<?= $config -> rootUrl() ;?>app/new-team" class="btn primary-btn"> <i class="fas fa-plus"></i> Nouvelle équipe</a>
</div>