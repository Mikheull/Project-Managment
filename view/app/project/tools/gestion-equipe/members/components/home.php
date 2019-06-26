<?php // View Content ?>


<div class="full-width">
    
    <div class="container margin-top-lg">
        <table class="table">
            <thead class="text-align-left">
                <tr>
                <th scope="col">Utilisateur</th>
                <th scope="col">Rôles</th>
                <th scope="col">Date d'arrivée</th>
                <th scope="col">Dernière connexion</th>
                <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($allUsers['content'] as $u){
                        require ('view/app/project/tools/gestion-equipe/members/components/user_item.php');
                    }
                ?>
            </tbody>
        </table>
    </div>

</div>

