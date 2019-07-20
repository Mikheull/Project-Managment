<div class="back-bg-gray"></div>

<div class="row hub_select mr-top-lg">
    <div class="col-10 offset-1">
        <h3 class="title-sm bold color-light mr-bot mr-top-lg">Selectionner un projet</h3>

        <div class="col-12 flex justify-content-between" id="loading_data">
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
        </div>

        <div id="output_data" class="col-12">
            <div class="row flex">
                <?php
                    foreach($allUserProjects['content'] as $all){
                        require ('view/app/hub/components/card.php');
                    }
                ?>
            </div>
        </div>
        

        <span class="color-light">OU</span>
        <div class="spacer-md"></div>

        <a href="<?= $config -> rootUrl() ;?>app/new/project" class="btn primary-btn">Créez en un</a>
    </div>
</div>


<script>
$('#output_data').hide();
setTimeout(function() {
    $('#loading_data').fadeOut( 600 );
    setTimeout(function() {
        $('#output_data').show();
    }, 587);
}, 1000);
</script>