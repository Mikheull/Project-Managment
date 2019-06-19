<?php
if($type == 'member'){
?>
    <div class="result_item margin-bot">
        <div class="container">
            <div class="row">
                <div class="col-1 align-self-center margin-bot">
                    <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $item ) ?>" title="Accéder au compte de <?= $utils -> getData('imp_user', 'first_name', 'public_token', $item )?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $item )?>">
                        <div class="col-md-3 profil_picture-sm">
                            <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $item ) == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $item .'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $item ) ;?>"></div>
                        </div>       
                    </a>
                </div>
                <div class="col-8 align-self-center">
                    <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $item ) ?>" title="Accéder au compte de <?= $utils -> getData('imp_user', 'first_name', 'public_token', $item )?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $item )?>">
                        <p class="title-xs bold color-dark"><?= $utils -> getData('imp_user', 'username', 'public_token', $item ) ?></p>
                        <p class="color-dark"> <?= $utils -> getData('imp_user', 'first_name', 'public_token', $item )?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $item )?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>



<?php
if($type == 'team'){
?>
    <div class="result_item margin-bot">
        <div class="container">
            <div class="row">
                <div class="col-8 align-self-center">
                    <a href="<?= $config -> rootUrl() ;?>app/team/<?= $item ?>" title="Accéder a l'équipe <?= $utils -> getData('pr_team', 'name', 'public_token', $item) ?>">
                        <p class="title-xs bold color-dark"><?= $utils -> getData('pr_team', 'name', 'public_token', $item) ?></p>
                        <p class="color-dark"><?= $utils -> getData('pr_team', 'description', 'public_token', $item)?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>




<?php
if($type == 'project'){
?>
    <div class="result_item margin-bot">
        <div class="container">
            <div class="row">
                <div class="col-8 align-self-center">
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $item ?>" title="Accéder au projet <?= $project -> getProjectData($item, 'name') ?>">
                        <p class="title-xs bold color-dark"><?= $project -> getProjectData($item, 'name') ?></p>
                        <p class="color-dark"><?= $project -> getProjectData($item, 'description')?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

