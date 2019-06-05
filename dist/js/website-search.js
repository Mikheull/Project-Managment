
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
                $('#empty').hide();
                $('.search_result #output').html(data);
            }
        });
	}else{
        $('#empty').show();
        $('.search_result #output').empty();
	}
});