<?php
    $owner = $project -> getProjectData($t['project_token'], 'founder_token');
?>

<div class="col-md-4 col-12">
    <div class="card-item light-border mr-bot">

        <div class="header relative">
            <div class="head-bg absolute">
                <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 43.78"><path style="fill: #5956f2" d="M0,0H64V35C32,43.78,0,43.78,0,43.78Z"/><path style="fill: #5956f2" d="M64,35"/></svg>
            </div>

            <div class="flex justify-content-between">
                <div class="status mr-top mr-left <?= $utils -> getData('pr_project', 'public', 'public_token', $t['project_token']) == true ? 'bg-primary' : 'bg-red' ;?> color-light text-xs">
                    <?= $utils -> getData('pr_project', 'public', 'public_token', $t['project_token']) == true ? 'publique' : 'privée' ;?>
                </div>
            </div>

            <div class="heading text-align-center mr-top-lg">
                <div class="team_profilImage"><?= substr($utils -> getData('pr_project', 'name', 'public_token', $t['project_token']), 0, 1) ;?></div>
                <div class="name title-sm bold"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>" class="link light-link"> <?= $utils -> getData('pr_project', 'name', 'public_token', $t['project_token']) ;?> </a> </div>
            </div>
        </div>

        <div class="content mr-bot-lg text-align-center">
            <div class="desc color-lg-dark mr-top-lg"> Ce projet souhaite vous inviter à la rejoindre </div>
        </div>

        <div class="footer">
            <form method="POST" class="mr-top mr-bot text-align-center full-width">
                <input type="hidden" name="invitation" value="<?= $t['project_token'] ?>">
                <button class="btn primary-btn" name="accept_invitation">Accepter</button>
                <button class="btn dark-btn" name="decline_invitation">Refuser</button>
            </form>
        </div>

    </div>
</div>