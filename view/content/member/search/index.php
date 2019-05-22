<div id="account-bg">
    <?php require ('view/components/navbar-header-dark.php') ;?>
</div>



<div class="container account search floating_container">

    <div class="row title">
        <div class="col-10 offset-1">
            <h2>Rechercher un membre</h2>
        </div>
    </div>
    
    <div class="row search_container">
        <div class="col-6 offset-3">
            <div class="input-field">
                <input type="text" placeholder="John Doe" name="user_research" id="user_research">
            </div>
            <div id="reseach_result"> <ul class="ouput"> </ul> </div>
        </div>
    </div>
    
</div>


<?php require ('view/components/footer.php') ;?>
