<?php require_once ('view/components/navbar-header-light.php') ;?>

<div id="head_deco" style="background-image: url('<?= $config -> rootUrl() ;?>dist/images/illustrations/head_decoration-search.svg?>')"></div>

<div class="container">

    <div class="row title search_head">
        <div class="col text-align-center margin-bot-lg margin-top-lg">
            <h2 class="title-lg bold color-dark ">Recherche</h2>
            <h3 class="title-xs color-gray">Clematius nec hiscere nec loqui permissus</h3>
        </div>
    </div>
    
    <div class="row search_container margin-bot-lg">
        <div class="col-md-8 col-10 search_bar light-border">
            <form method="post">
                <div class="input-field" style="display: flex">
                    <input type="text" placeholder="Recherche" name="website-search" id="website-search" class="margin-right">

                    <select name="search_filter" id="search_filter">
                        <option data-display="Select" disabled>Aucun</option>
                        <option value="member">Membre</option>
                        <option value="team">Équipes</option>
                        <option value="project">Projet</option>
                        <option value="help-article">Article Aide</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="col-md-6 col-8 search_result light-border">
            <div id="empty" class="text-align-center"> 
                <img class="margin-top-lg margin-bot-lg" src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_search.svg" alt="" width="20%"> 
                <h3 class="title-xs color-dark margin-top-lg  margin-bot">Commencez par écrire dans la barre pour lancer la recherche</h3>
            </div>

            <div id="output"></div>
        </div>
    </div>
    
</div>


<?php require ('view/components/footer.php') ;?>
