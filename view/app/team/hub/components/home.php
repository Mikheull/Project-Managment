<div class="row hub_select margin-top-lg">
    <div class="col-10 offset-1">
        <h3 class="title-sm bold color-dark margin-bot margin-top-lg">Selectionner une équipe</h3>

        <form action="" method="post">
            <select name="goto_team">
                <option data-display="Select" disabled>Aucun</option>
                <?php
                    foreach($allUserTeams['content'] as $all){
                        ?> <option value="<?= $team -> getTeamData($all['team_token'], 'public_token') ?>"><?= $team -> getTeamData($all['team_token'], 'name') ?></option> <?php
                    }
                ?>
            </select>
        </form>

        <span>OU</span>
        <div class="spacer-md"></div>

        <a href="<?= $config -> rootUrl() ;?>app/new/team" class="btn primary-btn">Créez en une</a>
    </div>
</div>
