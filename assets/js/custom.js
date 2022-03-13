function addToCart(data){
    $('.loader-img').show();

	$.ajax({
		url:"cart-core.php",
		type:"post",
		data:data,
		// data:$(this.form).serialize(),
		success:function(data){
            $('.loader-img').hide();

			var response = $.parseJSON(data);
			if(response.status=='success'){
				Swal.fire({
                   title: response.message,
                    text:'',
                    icon:'success'
				}).then(function (result) {
     				if (result.value) {
						location.reload();
     				}
   				});

		
			}else{
				Swal.fire(
                    response.message,
                    '',
                    'error'
                )
			}

		}
	})

}

function addToWishlist(product){
	$('.loader-img').show();

	$.ajax({
	url:"cart-core.php",
	type:"post",
	data:{
		'product_id': product,
		'mode':'add-to-wishlist'
	},
	success:function(data){
		$('.loader-img').hide();
		var response = $.parseJSON(data);
		if(response.status == 'success'){
			Swal.fire({
				title: response.message,
				text: '',
				icon: 'success'
			}).then(function (result) {
				if (result.value) {
					location.reload();
				}
			});
		}else{
			Swal.fire(
				response.message,
				'',
				'error'
			)
		}

	}
	})
}