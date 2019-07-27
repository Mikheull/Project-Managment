<?php require_once ('view/components/navbar-header-light.php') ;?>

    <section class="container p-0">

        <div class="page_head row justify-content-md-center">
            <div class="col-12 mr-bot-lg mr-top-lg">
                <h2 class="title-lg bold color-dark mr-bot">Tarifs</h2>
                <div class="flex justify-content-center">
                    <span>A l'année</span>
                    <div class="mr-left mr-right">
                        <input class="tgl tgl-light" id="billing" type="checkbox" checked/>
                        <label class="tgl-btn" for="billing"></label>
                    </div>
                    <span>Par mois</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 offset-md-0 col-10 offset-1 p-2">
                <div class="container-fluid">
                    <div class="row justify-content-center justify-content-around">
                        <div class="col-md-3 col-12 light-border p-2 mr-bot" id="offer-1">
                            <div class="color-lg-dark pl-3 mr-top mr-bot-lg">Petite équipe</div>
                            <div class="price color-dark bold pl-3 mr-bot title-lg">0€</div>
                            <div class="pl-3 mr-bot-lg">
                                <ul>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Jusqu'a 5 membres</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Accès a tout les outils</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Jusqu'a 3 équipes</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Gestion des permissions</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> 10Go d'upload de documents</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Statistiques générales</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Support</li>
                                </ul>
                            </div>
                            <div class="pl-3 mr-bot-lg"> <a href="<?= $config -> rootUrl() ;?>app" title="Débuter un projet" class="btn primary-btn full-width">Lancez votre projet</a> </div>
                        </div>

                        <div class="col-md-3 col-12 light-border p-2 mr-bot" id="offer-2">
                            <div class="color-lg-dark pl-3 mr-top mr-bot-lg">Grande équipe</div>
                            <div class="price color-dark bold pl-3 mr-bot title-lg">10€ <span class="text-sm">/mois</span></div>
                            <div class="pl-3 mr-bot-lg">
                                <ul>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Avantages de l'offre gratuite </li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Jusqu'a 15 membres</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Jusqu'a 5 équipes</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Permissions personnalisées</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> 50Go d'upload de documents</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Statistiques avancées</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Double Authentification</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Support premium</li>
                                </ul>
                            </div>
                            <div class="pl-3 mr-bot-lg"> <a href="<?= $config -> rootUrl() ;?>app" title="Séléctionner cette offre" class="btn primary-btn full-width">Séléctionner cette offre</a> </div>
                        </div>

                        <div class="col-md-3 col-12 light-border p-2 mr-bot" id="offer-3">
                            <div class="color-lg-dark pl-3 mr-top mr-bot-lg">Société</div>
                            <div class="price color-dark bold pl-3 mr-bot title-lg">Custom</div>
                            <div class="pl-3 mr-bot-lg">
                                <ul>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Avantages de l'offre "Grande équipe" </li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Membres illimités</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Équipes illimitées</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Pas de limite d'upload</li>
                                    <li class="mb-2"><i data-feather="check-circle"></i> Lien de projet personnalisable</li>
                                </ul>
                            </div>
                            <div class="pl-3 mr-bot-lg"> <a href="<?= $config -> rootUrl() ;?>app" title="Séléctionner cette offre" class="btn primary-btn full-width">Séléctionner cette offre</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </section>

<?php require_once ('view/components/footer.php') ;?>


<script>
$(document).ready(function() {
    $( "#billing" ).change(function() {
        if($('input[type=checkbox]').prop('checked') == true){
            $('#offer-2 .price').html('10€ <span class="text-sm">/mois</span>');
        }else{
            $('#offer-2 .price').html('7€ <span class="text-sm">/mois pendant 1an</span>');
        }
    });

});
</script>