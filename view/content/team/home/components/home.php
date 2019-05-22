<h2>Selectionner une équipe</h2>

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