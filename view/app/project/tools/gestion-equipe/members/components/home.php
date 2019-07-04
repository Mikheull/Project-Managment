<?php // View Content ?>

<div class="col-12">
    <h3 class="title-sm bold color-dark margin-bot"><?= $allUsers['count'] ;?> membre<?= $allUsers['count'] > 1 ? 's' : '' ;?> :</h3>
</div>

<?php
    foreach($allUsers['content'] as $u){
        require ('view/app/project/tools/gestion-equipe/members/components/user_item.php');
    }
?>
