<?php
    $userToken = $main -> getToken();
?>



<?php // View Content ?>

<div id="account-bg"> <?php require_once ('view/components/navbar-header-dark.php') ;?> </div>

<div class="container account floating_container edit">
    <?php require_once ('view/user/components/heading_user.php') ;?>

    <form method="POST">
        <div class="input_group">
            <div class="input-field input-half">
                <label for="first_name">Prénom</label>
                <input type="text" name="first_name" id="first_name" placeholder="Prénom" value="<?= $user -> getUserData($main -> getToken(), 'first_name') ?>">
            </div>
            <div class="input-field input-half">
                <label for="last_name">Nom</label>
                <input type="text" name="last_name" id="last_name" placeholder="Nom" value="<?= $user -> getUserData($main -> getToken(), 'last_name') ?>">
            </div>

            <div class="input-field input-half-al">
                <label for="username">Pseudo</label>
                <input type="text" name="username" id="username" placeholder="Pseudo" value="<?= $user -> getUserData($main -> getToken(), 'username') ?>">
            </div>
        </div>

        <div class="input_group">
            <div class="input-field input-half-al">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" placeholder="Bio"><?= $user -> getUserData($main -> getToken(), 'bio') ?></textarea>
            </div>
        </div>

        <button class="btn primary-btn" name="update_user_infos">Sauvegarder</button>
    </form>

    <div class="spacer-lg"></div>

    <form method="POST">
        <div class="input_group">
            <div class="input-field input-half-al">
                <label for="old_password">Ancien mot de passe</label>
                <input type="password" name="old_password" id="old_password">
            </div>
            <div class="spacer-xs"></div>
            <div class="input-field input-half">
                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" name="new_password" id="new_password">
            </div>

            <div class="input-field input-half">
                <label for="confirm_password">Confirmer le nouveau mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password">
            </div>
        </div>

        <button class="btn primary-btn" name="update_user_pass">Sauvegarder</button>
    </form>
    
</div>

<?php require_once ('view/components/footer.php') ;?>
