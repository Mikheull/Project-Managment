<div class="row team-container justify-content-around">
    <?php
        
        foreach($getUserTeams['content'] as $t){
            require ('view/content/account/teams/components/card.php');
        }
    ?>

    <?php require ('view/content/account/teams/components/modals.php'); ?>
</div>




<div id="tippy_t-short-act" style="display: none;">
    a
</div>

<script>

    const template = document.getElementById('tippy_t-short-act')

    tippy('.short-act', {
        content: template.innerHTML,
        animation: 'fade',
        trigger: 'click',
        interactive: true,
        placement: 'bottom',
        arrowType: 'round',
        arrow: true,
    })

</script>