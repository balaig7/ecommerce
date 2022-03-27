<?php
include __DIR__."/loader.php";
$product=find($_GET['id'],'products');
$class="product-".$_GET['id'];
$userReviewStatus='';
$isReviewdByUser=mysqli_query($conn,"SELECT * from `ratings` where user_id='".$currentLoggedUserId."' and product_id='".$_GET['id']."'");
if(mysqli_num_rows($isReviewdByUser)>0){
	$userReviewStatus='Already Reviewed';
}
?>
<style>
li.active>a{
	color:#fff;
}
</style>
		<div class="section">
			<div class="container">
				<form method="post" class="<?=$class?>">
				<div class="row">
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<?php foreach(explode(",",$product->product_images) as $value){ ?>
							<div class="product-preview">
								<img src="<?=str_replace("../","",$product->product_images_path).$value?>" alt="">
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<?php foreach(explode(",",$product->product_images) as $value){ ?>
							<div class="product-preview">
								<img src="<?=str_replace("../","",$product->product_images_path).$value?>" alt="">
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?=$product->name?></h2>
							<div>
								<h3 class="product-price">$<?=$product->discounted_price?> <del class="product-old-price"><?=$product->original_price?></del></h3>
								<span class="product-available">In Stock</span>
							</div>
								<div><?=htmlspecialchars_decode($product->description)?></div>
							<div class="product-options">
								
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="hidden" name="mode" value="add-to-cart">
										<input type="number" name="quantity" class="quantity" min="1" value="1" max="<?=$product->quantity?>">
										<input type="hidden" name="product_id" class="product_id" value="<?=$_GET['id']?>">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn" type="button" onclick="addToCart($('.<?=$class?>').serialize())"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
							</form>

						</div>
					</div>
					<div class="col-md-12">
					<input type="hidden" class='is_already_reviewed' value="<?=$userReviewStatus?>">
					<input type="hidden" class='cur_user_id'name="user_id" value="<?=$currentLoggedUserId?>">
						<div id="product-tab">
							<!-- product tab nav -->
							
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
$(document).on("change",".quantity",function(){
   var quantity_in_stock=parseInt($(this).attr("max"));
   var currentRow=$(this).closest('tr');
   var product=$(".product_id").val();//get product id
   var quantity=parseInt($(this).val());
   if(quantity > quantity_in_stock){
      Swal.fire(
         "Sorry this product only contains "+quantity_in_stock+" in stock",
         '',
         'warning'
      )
      $(this).val(quantity_in_stock)
   
   }

})
getAllReviews(<?=$_GET['id']?>,'');
function getAllReviews(product,page){
	$.ajax({
         url:"view-ratings.php",
         type:"post",
         data:{
			 'product_id':product,
			 'page':page,
		 },
         success:function(data){
            var response=$.parseJSON(data)
			var reviews=i=''
			$("#product-tab").empty();
			reviews+='<ul class="tab-nav">'
				reviews+='<li class="active"><a data-toggle="tab" href="#tab3">Reviews ('+response.total_count+')</a></li>'
			reviews+='</ul>'
			reviews+='<div class="tab-content">'
				reviews+='<div id="tab3" class="tab-pane fade in active">'
					reviews+='<div class="row">'
						reviews+='<div class="col-md-3">'
							reviews+='<div id="rating">'
								reviews+='<ul class="rating">'
								$.each(response.rating_by_value,function(index,total){
									reviews+='<li>'
										reviews+='<div class="rating-stars">'
										for (i = 1; i <= index; i++) {
											reviews+='<i class="fa fa-star"></i>'
										}
										for (i = 1; i <= 5-index; i++) {
											reviews+='<i class="fa fa-star-o empty"></i>'
										}

										reviews+='</div>'
											reviews+='<span class="sum" style="margin-left: 10px;"><b>('+total+')</b></span>'
										reviews+='</li>'
								})
								reviews+='</ul>'
									reviews+='</div>'
										reviews+='</div>'
										if($('.is_already_reviewed').val()=='Already Reviewed' || $('.cur_user_id').val()=='0' ){
											var col='9'
										}else{
											var col='6'
											
										}
										reviews+='<div class="col-md-'+col+'">'
											reviews+='<div id="reviews">'
												reviews+='<ul class="reviews">'
												$.each(response.review_by_page,function(index,value){
													reviews+='<li>'
														reviews+='<div class="review-heading">'
															reviews+='<h5 class="name">'+value.display_name+'</h5>'
															reviews+='<p class="date">'+value.created_at+'</p>'
															reviews+='<div class="review-rating">'
																for (i = 1; i <= value.star_rating; i++) {
																	reviews+='<i class="fa fa-star"></i>'
																}
																for (i = 1; i <= 5-value.star_rating; i++) {
																	reviews+='<i class="fa fa-star-o empty"></i>'
																}
																// reviews+='<i class="fa fa-star"></i>'
															reviews+='</div>'
														reviews+='</div>'
														reviews+='<div class="review-body">'
															reviews+='<p>'+value.review+'</p>'
														reviews+='</div>'
													reviews+='</li>'
												})
												reviews+='</ul>'
												
												reviews+='<ul class="reviews-pagination">'
												$.each(response.total_page,function(index,pageNo){
													reviews+='<li class="pages '+pageNo.split("_")[1]+'"><a href="javascript:void(0)" onclick=getAllReviews('+$(".product_id").val()+','+(pageNo.split("_")[2])+') >'+pageNo.split("_")[0]+'</a></li>'
												})
												reviews+='</ul>'
												
										reviews+='</div>'
										reviews+='</div>'
										if($('.is_already_reviewed').val()=='' & $('.cur_user_id').val()!='0' ){
										reviews+='<div class="col-md-3">'
											reviews+='<div id="review-form">'
												reviews+='<form class="review-form">'
													reviews+='<input type="hidden" name="product_id" value='+$(".product_id").val()+'>'
													reviews+='<input type="hidden" name="user_id" value='+$('.cur_user_id').val()+'>'
													reviews+='<textarea class="input" name="review" placeholder="Your Review"></textarea>'
													reviews+='<div class="input-rating">'
														reviews+='<span>Your Rating: </span>'
														reviews+='<div class="stars">'
															reviews+='<input id="star5" name="star_rating" value="5" type="radio"><label for="star5"></label>'
															reviews+='<input id="star4" name="star_rating" value="4" type="radio"><label for="star4"></label>'
															reviews+='<input id="star3" name="star_rating" value="3" type="radio"><label for="star3"></label>'
															reviews+='<input id="star2" name="star_rating" value="2" type="radio"><label for="star2"></label>'
															reviews+='<input id="star1" name="star_rating" value="1" type="radio"><label for="star1"></label>'
														reviews+='</div>'
													reviews+='</div>'
													reviews+='<button class="primary-btn" type="button" onclick="postReview()">Submit</button>'
												reviews+='</form>'
										reviews+='</div>'
										reviews+='</div>'
										}
						reviews+='<div>'
						reviews+='<div>'
						reviews+='<div>'
			$('#product-tab').append(reviews);
         }
    })
}
function postReview(){
	$.ajax({
         url:"add-review.php",
         type:"post",
         data:$(".review-form").serialize(),
         success:function(data){
            var response=$.parseJSON(data)
            if(response.status=='success'){
				Swal.fire({
				title: response.message,
				text: '',
				icon: 'success',
				confirmButtonColor: '#D10024',

			}).then(function (result) {
				if (result.value) {
					location.reload();
				}
			});
            }
            
         }
    })
}
</script>

