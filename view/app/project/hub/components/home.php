<div class="row hub_select margin-top-lg">
    <div class="col-10 offset-1">
        <h3 class="title-sm bold color-dark margin-bot margin-top-lg">Selectionner un projet</h3>

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

        <span>OU</span>
        <div class="spacer-md"></div>

        <a href="<?= $config -> rootUrl() ;?>app/new/project" class="btn primary-btn">Créez en un</a>
    </div>
</div>
