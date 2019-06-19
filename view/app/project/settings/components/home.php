
<?php // View Content ?>

<?php require_once ('view/app/project/components/project_sidebar.php') ?>

<div class="content_wrapper container">

    <form method="POST">
        <div class="input_group">
            <div class="input-field input-half">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" placeholder="Nom" value="<?= $utils -> getData('pr_project', 'name', 'public_token', $project_token) ?>">
            </div>
        </div>

        <div class="input_group">
            <div class="input-field input-half-al">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" placeholder="Description"><?= $utils -> getData('pr_project', 'description', 'public_token', $project_token) ?></textarea>
            </div>
        </div>

        <div class="input_group status_team">
            <input type="radio" name="status" id="private" value="private" <?= $utils -> getData('pr_project', 'public', 'public_token', $project_token) == false ? 'checked' : '' ?>>
            <label class="margin-left" for="private">Privée</label>
            <input type="radio" name="status" id="public" value="public" <?= $utils -> getData('pr_project', 'public', 'public_token', $project_token) == true ? 'checked' : '' ?>>
            <label class="margin-left" for="public">Publique</label>
        </div>

        <button class="btn primary-btn" name="update_project_infos">Sauvegarder</button>
    </form>
</div>