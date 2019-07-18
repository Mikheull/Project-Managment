<div class="back-bg-gray"></div>

<div class="row hub_select mr-top-lg">
    <div class="col-10 offset-1">
        <h3 class="title-sm bold color-light mr-bot mr-top-lg">Selectionner un projet</h3>

        <div class="col-12 flex justify-content-between" id="loading_data">
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
        </div>

        <form action="" method="post">
            <select name="goto_project">
                <option data-display="Select" disabled>Aucun</option>
                <?php
                    foreach($allUserProjects['content'] as $all){
                        ?> <option value="<?= $project -> getProjectData($all['project_token'], 'public_token') ?>"><?= $project -> getProjectData($all['project_token'], 'name') ?></option> <?php
                    }
                ?>
            </select>
        </form>

        <span class="color-light">OU</span>
        <div class="spacer-md"></div>

        <a href="<?= $config -> rootUrl() ;?>app/new/project" class="btn primary-btn">Créez en un</a>
    </div>
</div>


<script>
setTimeout(function() {
    $('#loading_data').fadeOut( 600 );
    setTimeout(function() {
        $('#output_data').show();
    }, 300);
}, 1000);
</script>