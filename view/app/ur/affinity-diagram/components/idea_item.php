<div class="container-fluid">
    <div class="row">

        <?php
            if($utils -> getData('pr_user_research_affinity_diagram', 'need_approved', 'diagram_token', $diagram_token) == true){
                $allIdeas = $recherche_utilisateur -> getApprovedIdea($diagram_token);
            }else{
                $allIdeas = $recherche_utilisateur -> getIdea($diagram_token);
            }

            foreach($allIdeas['content'] as $idea){
                ?>
                    <div class="col-lg-2 col-md-5 col-12 post-it-note mr-right mr-bot-lg color-dark">
                        <p><?= $idea['name'] ?></p>
                    </div>
                <?php
            }
        ?>

    </div>
</div>
