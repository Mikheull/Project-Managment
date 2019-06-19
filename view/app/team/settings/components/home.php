
<?php // View Content ?>

<?php require_once ('view/app/team/components/team_sidebar.php') ?>

<div class="content_wrapper container">

    <form method="POST">
        <div class="input_group">
            <div class="input-field input-half">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" placeholder="Nom" value="<?= $utils -> getData('pr_team', 'name', 'public_token', $team_token) ?>">
            </div>
        </div>

        <div class="input_group">
            <div class="input-field input-half-al">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" placeholder="Description"><?= $utils -> getData('pr_team', 'description', 'public_token', $team_token) ?></textarea>
            </div>
        </div>

        <div class="input_group status_team">
            <input type="radio" name="status" id="private" value="private" <?= $utils -> getData('pr_team', 'public', 'public_token', $team_token) == false ? 'checked' : '' ?>>
            <label class="margin-left" for="private">Privée</label>
            <input type="radio" name="status" id="public" value="public" <?= $utils -> getData('pr_team', 'public', 'public_token', $team_token) == true ? 'checked' : '' ?>>
            <label class="margin-left" for="public">Publique</label>
        </div>

        <button class="btn primary-btn" name="update_team_infos">Sauvegarder</button>
    </form>
</div>