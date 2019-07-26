<?php // View Content ?>

<div class="container-fluid main_wrapper">

    <div class="content_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-12 flex mr-top">
                    <div style="width: 128px" class="mr-right">
                        <a class="navbar-brand" href="<?= $config -> rootUrl() ;?>./" title="Improove">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 28">
                                <defs><style>.cls-1,.cls-3{fill:#4c6cf6;}.cls-2{fill:none;stroke:#4c6cf6;stroke-linecap:round;stroke-miterlimit:10;stroke-width:2px;}.cls-3{font-size:16px;font-family:Nunito-Bold, Nunito;font-weight:700;}.cls-4{letter-spacing:-0.01em;}.cls-5{letter-spacing:-0.02em;}</style></defs>
                                <g id="Calque_2" data-name="Calque 2">
                                    <g id="Calque_1-2" data-name="Calque 1">
                                        <path class="cls-1" d="M26.5,0h-9a1.5,1.5,0,0,0,0,3h5.38L11.5,14.38a1.5,1.5,0,1,0,2.12,2.12L25,5.12V10.5a1.5,1.5,0,0,0,3,0v-9A1.5,1.5,0,0,0,26.5,0Z"/>
                                        <path class="cls-2" d="M1,14A13,13,0,0,0,14,27"/>
                                        <path class="cls-2" d="M14,27A13,13,0,0,0,27,14"/>
                                        <path class="cls-2" d="M14,1A13,13,0,0,0,1,14"/>
                                        <text class="cls-3" transform="translate(33.09 19.17)">IMPROOVE</text>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <?php
            if($recherche_utilisateur -> affinityDiagramIsOpen($router -> getRouteParam("1")) == false){
                ?>
                <div class="row mr-top-lg">
                    <div class="no-access">Ce diagramme n'est plus ouvert a d'autres réponses !</div>
                </div>
                <?php
            }else{

            ?>
                <div class="row mr-top-lg">
                    <div class="col-md-3 col-12 light-border p-2 text-align-center center">
                    <h2 class="title-sm bold color-lg-dark"><?= $utils -> getData('pr_user_research_affinity_diagram', 'name', 'diagram_token', $router -> getRouteParam("1")) ?></h2>
                    </div>
                </div>

                <div class="row mr-top-lg">
                    <div class="col-md-8 col-12 bg-light p-3 rounded">
                    <p><?= $utils -> getData('pr_user_research_affinity_diagram', 'topic', 'diagram_token', $router -> getRouteParam("1")) ?></p>
                    </div>
                </div>
                

                <div class="row mr-top-lg">
                    <div class="col-md-8 col-12">
                        asaasasasa
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>