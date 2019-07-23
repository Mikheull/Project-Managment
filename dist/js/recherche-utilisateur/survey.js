// $('.answer').hide();

$(document).ready(function() {
    
    $(document).on('input', '.question-input', function() {
        let input = $( this ).val();

        if( input.length < 1 ) { 
            $(this).parent().parent().find('.answer').hide();
        }else{
            $(this).parent().parent().find('.answer').show();  
        }
    });


    $(document).on("click", ".add_answerProp", function(e) {
        let numItems = this.dataset.nb;
        $( this ).parent().after( ' <div class="answer flex"> <div class="input-field input-half-al"> <input type="text" name="answer'+ numItems +'[]" id="answer'+ numItems +'" placeholder="Réponse"> </div><div class="mt-3 remove_answerProp link"> <i class="far fa-trash-alt"></i> </div></div> ' );
    });

    $(document).on("click", ".remove_answerProp", function(e) {
        $( this ).parent().remove();
    });


    $(document).on('change', '.answer_type', function() {
        let type = $( this ).val();

        if( type == 'text' ) { 
            $(this).parent().parent().find('.answers').hide();
        }else{
            $(this).parent().parent().find('.answers').show();  
        }
    });


    $(document).on("click", "#add_answer", function(e) {
        var numItems = $('.question-input').length;
        var numItems = numItems + 1;
        $( 'input[name="nb"]' ).val(numItems);
        $('#remove_question').remove();

        $( this ).before( ' <div class="input_group"> <div class="input-field input-half-al"> <label for="question1">Question n° '+ numItems +'</label> <input type="text" class="question-input" name="question'+ numItems +'" id="question1" placeholder="Question '+ numItems +'"> </div><br><div class="input-field input-half-al answer"> <div class="flex"> <span class="mr-right mt-2 bold color-lg-dark">Type de réponse</span> <select class="answer_type" name="answer_type'+ numItems +'" id="answer_type'+ numItems +'"> <option value="checkbox">Multiples options (checkbox)</option> <option value="radio">Option unique (radio)</option> <option value="text">Réponse libre (text)</option> </select> </div><div class="mr-top answers"> <span class="bold color-lg-dark">Réponses a la question n° '+ numItems +'</span> <br><div class="answer flex"> <div class="input-field input-half-al"> <input type="text" name="answer'+ numItems +'[]" id="answer'+ numItems +'" placeholder="Réponse"> </div><div class="mt-3 add_answerProp link" data-nb="'+ numItems +'"> <i class="fas fa-plus-circle"></i> </div></div> <span class="btn btn-sm red-btn" id="remove_question">Retirer la question</span> </div></div> <div class="spacebar spacebar-xl mt-5 mb-5"></div> </div> ' );
    });

    $(document).on("click", "#remove_question", function(e) {
        var numItems = $('.question-input').length;
        var numItems = numItems - 1;
        $( 'input[name="nb"]' ).val(numItems);
        
        $( this ).parent().parent().parent().remove();
    });
});

