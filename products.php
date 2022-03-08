<?php
include __DIR__."/loader.php";
$product=find(1,'products');
$category=dbQuery('SELECT * from `category` where name ="'.$_GET["category"].'"');
$subCategories=dbQuery('SELECT * from `sub_category` where parent_id ="'.$category[0]->id.'"');
?>
<style>
li.active>a{
	color:#fff;
}
</style>
<div class="section">
   <div class="container">
	            <input type="hidden" id="sess_status" value=<?=$isUserActive?>>

      <div class="row">
         <div id="aside" class="col-md-3">
			 <!-- load sub categories -->
            <div class="aside sub-categories"></div>
            <!-- <div class="aside">
               <h3 class="aside-title">Price</h3>
               <div class="price-filter">
                  <div id="price-slider"></div>
                  <div class="input-number price-min">
                     <input id="price-min" type="number">
                     <span class="qty-up">+</span>
                     <span class="qty-down">-</span>
                  </div>
                  <span>-</span>
                  <div class="input-number price-max">
                     <input id="price-max" type="number">
                     <span class="qty-up">+</span>
                     <span class="qty-down">-</span>
                  </div>
               </div>
            </div> -->
         </div>
         <div id="store" class="col-md-9">
            <div class="row load-products">
               <!-- load products -->
            </div>
            <div class="store-filter clearfix">
               <span class="store-qty"></span>
               <ul class="store-pagination">
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
var parent_cat_id="<?=$category[0]->id?>"
loadData(parent_cat_id)
var sessionStatus=$("#sess_status").val();

function loadData(parentCategory,subcategory='',page=''){
	$.ajax({
		url:"view-data.php",
		type:"post",
		data:{
			parent_cat:parentCategory,
			sub_cat:subcategory,
			page:page
		},
		success:function(data){
			var parsedData=JSON.parse(data);
			var subCat=productsData=pages='';
			$("ul.store-pagination").empty();
			$(".load-products").empty();

			//load sub categories
			if(parsedData.sub_categories.length>0){
				subCat+='<h3 class="aside-title">Categories</h3>'
                    subCat+='<div class="checkbox-filter">'
						$.each(parsedData.sub_categories,function(index,categories){
							 subCat+='<div class="input-checkbox">'
								subCat+='<input type="checkbox" id="category-'+index+'" value='+categories.id+' class="brands" name="sub_categories">'
								  subCat+='<label for="category-'+index+'">'
									subCat+='<span></span>'
										subCat+=categories.name
									 subCat+='<small>('+categories.total+')</small>'
								  subCat+='</label>'
							 subCat+='</div>'
						});
				subCat+='</div>'
				if($(".sub-categories").html()==''){
					$('.sub-categories').append(subCat);
				}
			}
			//load products
			if(parsedData.products.length>0){
				$("span.store-qty").text(parsedData.showing_limits)

				$.each(parsedData.products,function(index,products){
					productsData+="<a href='content.php?id="+products.id+"'>"
					productsData+="<form>"
					productsData+='<div class="col-md-4 col-xs-6">'
					productsData+='<div class="product">'
						productsData+='<div class="product-img">'
							productsData+='<img src="'+products.thumnail_image_path+''+products.thumnail_image+'" alt="">'
							productsData+='<div class="product-label">'
								productsData+='<span class="sale">-30%</span>'
								productsData+='<span class="new">NEW</span>'
							productsData+='</div>'
						productsData+='</div>'
						productsData+='<div class="product-body">'
							productsData+='<h3 class="product-name"><a href="#">'+products.name+'</a></h3>'
							productsData+='<h4 class="product-price">$'+products.discounted_price+'<del class="product-old-price">$'+products.original_price+'</del></h4>'
							productsData+='<div class="product-rating">'
								productsData+='<i class="fa fa-star"></i>'
								productsData+='<i class="fa fa-star"></i>'
								productsData+='<i class="fa fa-star"></i>'
								productsData+='<i class="fa fa-star"></i>'
								productsData+='<i class="fa fa-star"></i>'
							productsData+='</div>'
							if(sessionStatus==1){
							productsData+='<div class="product-btns">'
								productsData+='<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>'
							productsData+='</div>'
							}
						productsData+='</div>'
						productsData+='<div class="add-to-cart">'
							productsData+='<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>'
						productsData+='</div>'
					productsData+='</div>'
				productsData+='</div>'
				productsData+="</form>"

				productsData+='</a>'

				});
				var active=pageData=""
				$.each(parsedData.total_page,function(index,pageNo){
					pages+='<li class="pages '+pageNo.split("_")[1]+'"><a href="javascript:void(0)" onclick=loadData('+parent_cat_id+','+$('input[name="sub_categories"]:checked').val()+','+(pageNo.split("_")[2])+')>'+pageNo.split("_")[0]+'</a></li>'
				});
				$('.load-products').append(productsData);
				$('ul.store-pagination').append(pages);
				}else{
					$("span.store-qty").text('')
				productsData='<h3 class="text-danger" style="margin-top: 20%;">SORRY NO PRODUCTS ARE AVAILABLE IN THIS CATEGORY<h2>'
				$('.load-products').append(productsData);
			}
		}
	})
}
$(document).on("change",'.brands',function(){
	$(".brands").prop('checked', false);
    $(this).prop('checked', true);
	var value=$(this).val()
	loadData(parent_cat_id,value,page='')
})


</script>