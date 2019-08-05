<?php
    $userToken = $main -> getToken();
?>



<?php // View Content ?>
<?php require_once ('view/components/navbar-header-light.php') ;?>

<div class="container account mr-top-lg mr-bot-lg">

    <div class="row">
        <div class="col-md-3 col-12">
            <?php require_once ('view/user/components/heading_user.php') ;?>
        </div>
        
        <div class="col-md-8 col-12">
            <?php require_once ('view/user/components/navbar_user.php') ;?>
            
            <form method="POST">
                <div class="input_group">
                    <div class="input-field input-half">
                        <label for="first_name">Prénom</label>
                        <input type="text" name="first_name" id="first_name" placeholder="Prénom" value="<?= $utils -> getData('imp_user', 'first_name', 'public_token', $main -> getToken()) ?>">
                    </div>
                    <div class="input-field input-half">
                        <label for="last_name">Nom</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Nom" value="<?= $utils -> getData('imp_user', 'last_name', 'public_token', $main -> getToken()) ?>">
                    </div>

                    <div class="input-field input-half-al">
                        <label for="username">Pseudo</label>
                        <input type="text" name="username" id="username" placeholder="Pseudo" value="<?= $utils -> getData('imp_user', 'username', 'public_token', $main -> getToken()) ?>">
                    </div>
                </div>

                <div class="input_group">
                    <div class="input-field input-half-al">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" placeholder="Bio"><?= $utils -> getData('imp_user', 'bio', 'public_token', $main -> getToken()) ?></textarea>
                    </div>
                </div>

                <button class="btn primary-btn" name="update_user_infos">Sauvegarder</button>
            </form>

            <div class="spacer-lg"></div>

            <form method="POST" enctype="multipart/form-data">
                <div class="input_group">
                    <div class="input-field input-half-al">
                        <label for="imported_file">Votre photo de profil</label>
                        <input type="file" class="filepond" name="imported_file" data-max-file-size="2MB"/>
                    </div>
                </div>

                <button class="btn primary-btn" name="update_profil_pic">Sauvegarder</button>
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

            <div class="spacebar"><div class="spacer-lg"></div></div>

            <a href="<?= $config -> rootUrl() ;?>account/my-data" target="blank" class="btn dark-btn">Exporter mes données</a>
            <a class="btn red-btn" id="delete-account">Supprimer mon compte</a>
        </div>
    </div>

</div>


<?php require_once ('view/components/footer.php') ;?>



<script>
// Suppression
$(document).on("click", "#delete-account", function(e) {
    event.preventDefault();

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de supprimer définitivement votre compte de la plateforme.",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel',
                className: 'btn dark-btn'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm',
                className: 'btn primary-btn'
            }
        },
        callback: function (result) {
            if(result == true){
                $.ajax({
                    url:  rootUrl + 'controller/ajax/delete_account.php',
                    type: 'POST',
                    data: {},
                    success:function(data){
                        location.href="../";
                    }
                });
            }
        }
    });
});
</script>