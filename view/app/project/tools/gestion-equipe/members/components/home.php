
<div class="container-fluid">
    <ul class="row pt-3 flex-column">
        <?php
            foreach($allUsers['content'] as $u){
                require ('view/app/project/tools/gestion-equipe/members/components/user_item.php');
            }
        ?>
    </ul>

</div>