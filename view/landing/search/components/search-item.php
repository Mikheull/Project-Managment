<?php
if($type == 'member'){
?>
    <div class="result_item margin-bot">
        <div class="container">
            <div class="row">
                <div class="col-1 align-self-center margin-bot">
                    <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getUserData($item, 'username') ?>" title="Accéder au compte de <?= $user -> getUserData($item, 'first_name')?> <?= $user -> getUserData($item, 'last_name')?>">
                        <div class="col-md-3 profil_picture-sm">
                            <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData($item, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $item .'/profil_pic/'.$user -> getUserData($item, 'profil_image') ;?>"></div>
                        </div>       
                    </a>
                </div>
                <div class="col-8 align-self-center">
                    <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getUserData($item, 'username') ?>" title="Accéder au compte de <?= $user -> getUserData($item, 'first_name')?> <?= $user -> getUserData($item, 'last_name')?>">
                        <p class="title-xs bold color-dark"><?= $user -> getUserData($item, 'username') ?></p>
                        <p class="color-dark"> <?= $user -> getUserData($item, 'first_name')?> <?= $user -> getUserData($item, 'last_name')?></p>
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
                    <a href="<?= $config -> rootUrl() ;?>app/team/<?= $item ?>" title="Accéder a l'équipe <?= $team -> getTeamData($item, 'name') ?>">
                        <p class="title-xs bold color-dark"><?= $team -> getTeamData($item, 'name') ?></p>
                        <p class="color-dark"><?= $team -> getTeamData($item, 'description')?></p>
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

