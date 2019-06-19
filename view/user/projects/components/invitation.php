<?php
    $owner = $project -> getProjectData($t['project_token'], 'founder_token');
?>

<div class="col-md-4 col-12">
    <div class="card-item light-border">

        <div class="header">
            <div class="options text-align-right margin-right margin-top">
                <div class="lock"> <?= $utils -> getData('pr_project', 'public', 'public_token', $t['project_token']) == true ? '<i data-feather="unlock"></i>' : '<i data-feather="lock"></i>' ;?> </div>
                <div class="dropdown margin-left">
                    <?php if($router -> getRouteParam('0') == 'account'){ ?>
                        <i class="fas fa-ellipsis-h" id="act-<?= $t['project_token'] ;?>"></i>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="content margin-bot-lg margin-top text-align-center">
            <div class="team_profilImage"><?= substr($utils -> getData('pr_project', 'name', 'public_token', $t['project_token']), 0, 1) ;?></div>
            <div class="name title-sm bold color-dark"> <a> <?= $utils -> getData('pr_project', 'name', 'public_token', $t['project_token']) ;?> </a> </div>
            <div class="desc color-lg-dark margin-top"> Ce projet souhaite vous inviter a la rejoindre </div>
        </div>

        <div class="footer">
            <form method="POST">
                <input type="hidden" name="invitation" value="<?= $t['project_token'] ?>">
                <button class="btn primary-btn" name="accept_invitation">Accepter</button>
                <button class="btn dark-btn" name="decline_invitation">Refuser</button>
            </form>
        </div>

    </div>
</div>