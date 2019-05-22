<?php require ('view/components/navbar-header-light.php') ;?>

<section class="main_container">

    <div class="container home_pre">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center left">
                <h2>Eminuit autem inter humilia la supergressa iam impotentia</h2>
                <h3>Clematius nec hiscere nec loqui permissus</h3>
                <div class="btn"> <a href="<?= $config -> rootUrl() ;?>app" title="Débuter un projet" class="primary-btn">Lancez votre projet</a> </div>
                <div class="btn"> <a href="" title="Regarder la vidéo" class="light-btn"><i class="far fa-play-circle"></i> Regarder la vidéo</a> </div>
                
            </div>
            <div class="col-md-7 col-12 align-self-center right">
                <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/landing_home.svg" alt="" width="100%">
            </div>
        </div>
    </div>

    <div class="container home_partners">
        <div class="row">
            <div class="col-10 offset-1 partners-content">
                <div class="container">
                    <div class="title">Ils nous font confiance</div>
                    <div class="row justify-content-around">
                        <div class="col"> <img src="dist/images/content/logos/netflix.svg" alt="" height="64px"> </div>
                        <div class="col"> <img src="dist/images/content/logos/tesla.svg" alt="" height="64px"> </div>
                        <div class="col"> <img src="dist/images/content/logos/facebook.svg" alt="" height="64px"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container home_presentation">
        <div class="row pres-element">
            <div class="col-md-6 col-10 heading align-self-center">
                <h2>Gagnez en productivité</h2>
                <p>Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
            </div>
            <div class="col-md-6 col-10 illustration"> <img src="dist/images/illustrations/productivity.svg" alt="" width="80%"> </div>
        </div>

        <div class="row pres-element">
            <div class="col-md-6 col-10 illustration"> <img src="dist/images/illustrations/team_managment.svg" alt="" width="80%"> </div>
            <div class="col-md-6 col-10 heading align-self-center">
                <h2>Gérez votre équipe</h2>
                <p>Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
            </div>
        </div>

        <div class="row pres-element">
            <div class="col-md-6 col-10 heading align-self-center">
                <h2>Maintenez votre projet</h2>
                <p>Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
            </div>
            <div class="col-md-6 col-10 illustration"> <img src="dist/images/illustrations/project_managment.svg" alt="" width="80%"> </div>
        </div>
    </div>



</section>

<?php require ('view/components/footer.php') ;?>
