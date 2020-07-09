<script>
	$(document).ready(function(){
	$("body").on("change", "#sortby", function() {

    var sortingMethod = $(this).val();
    console.log(sortingMethod);

    if(sortingMethod == 'pasc')
    {
        sortProductsPriceAscending();
    }
    else if(sortingMethod == 'pdesc')
    {
        sortProductsPriceDescending();
    }

	});
	function sortProductsPriceAscending()
	{
	    var products = $('.searchbox');
	    products.sort(function(a, b){ return $(a).data("price")-$(b).data("price")});
	    $(".maindiv").html(products);

	}

	function sortProductsPriceDescending()
	{
	    var products = $('.searchbox');
	    products.sort(function(a, b){ return $(b).data("price") - $(a).data("price")});
	    $(".maindiv").html(products);

	}
	});
</script>