
$('#loading_data').hide();
$('#website-search').focus();

$(document).on('keyup', '#website-search', function() {
	var min_length = 2;
    var keyword = $('#website-search').val();
    var type = $('#search_filter').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: rootUrl + 'controller/ajax/website-search.php',
            type: 'POST',
            data: {keyword:keyword, type:type},
            success:function(data){
                $('#public_data').hide();
                $('#loading_data').show();
                $('#output_data').hide();
                $('#output_data').html(data);
            }
        });
	}else{
        $('#public_data').show();
        $('#loading_data').hide();
        $('#output_data').empty();
        $('#output_data').hide();
	}
});


$(document).on("click", ".filter_btn", function(e) {
    event.preventDefault();
    let filter = this.dataset.filter;

    $('#website-search').val('');
    $('#website-search').focus();
    $('#public_data').show();
    $('#loading_data').hide();
    $('#output_data').empty();
    $('#output_data').hide();

    $('.filter_btn').removeClass('dark-btn');
    $('.filter_btn').addClass('light-btn-bordered');
    $(this).toggleClass('light-btn-bordered');
    $(this).toggleClass('dark-btn');
    $('#search_filter').val(filter);

});