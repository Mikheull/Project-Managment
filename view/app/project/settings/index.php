<?php
    require_once ('controller/project.php') ;
    $project_token = $router -> getRouteParam('2');
?>


<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">
        <div class="container-fluid">
            <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'project.manage')){
            
            ?>

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
                        <label class="mr-left" for="private">Privée</label>
                        <input type="radio" name="status" id="public" value="public" <?= $utils -> getData('pr_project', 'public', 'public_token', $project_token) == true ? 'checked' : '' ?>>
                        <label class="mr-left" for="public">Publique</label>
                    </div>

                    <br>
                    <button class="btn primary-btn" name="update_project_infos">Sauvegarder</button>
                    <?php
                        if($utils -> getData('pr_project', 'founder_token', 'public_token', $project_token) == $auth -> getToken()){
                            ?> <button class="btn red-btn" name="delete_project">Supprimer</button> <?php
                        }
                    ?>
                </form>
            <?php
            }else{
                ?>
                <div class="no-access">Vous n'avez pas la permission nécessaire pour accéder a ce contenu</div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php require_once ('view/app/project/components/footer.php') ?>