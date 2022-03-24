<?php
$title="HOME";
include __DIR__."/loader.php";
function totalUsers(){
	$totalUsers=dbQuery("SELECT * FROM `users`");
	return $totalUsers;
}
function totalCategories(){
	$totalCategory=dbQuery("SELECT * FROM `category`");
	return $totalCategory;
}
function totalProducts(){
	$totalProducts=dbQuery("SELECT * FROM `products`");
	return $totalProducts;
}
function totalSubCategories(){
	$subCategory=dbQuery("SELECT * FROM `sub_category`");
	return $subCategory;
}
?>

<div class="main-content">
<div class="row row-inline-block small-spacing">
   <div class="col-lg-4 col-md-6 col-xs-12">
      <div class="box-content bordered info js__card">
         <h4 class="box-title with-control">
            Total Users
            <span class="controls">
            <button type="button" class="control fa fa-minus js__card_minus"></button>
            </span>
         </h4>
         <div class="js__card_content">
            <h2><?=count(totalUsers())?></h2>
         </div>
      </div>
      <!-- /.box-content -->
   </div>
   <div class="col-lg-4 col-md-6 col-xs-12">
      <div class="box-content bordered danger js__card">
         <h4 class="box-title with-control">
            Total Categories
            <span class="controls">
            <button type="button" class="control fa fa-minus js__card_minus"></button>
            </span>
         </h4>
         <div class="js__card_content">
            <h2><?=count(totalCategories())?></h2>
         </div>
      </div>
      <!-- /.box-content -->
   </div>
   <div class="col-lg-4 col-md-6 col-xs-12">
      <div class="box-content bordered warning js__card">
         <h4 class="box-title with-control">
            Total Products
            <span class="controls">
            <button type="button" class="control fa fa-minus js__card_minus"></button>
            </span>
         </h4>
         <div class="js__card_content">
            <h2><?=count(totalProducts())?></h2>
         </div>
      </div>
      <!-- /.box-content -->
   </div>
   <div class="col-lg-4 col-md-6 col-xs-12">
      <div class="box-content bordered success js__card">
         <h4 class="box-title with-control">
            Total SubCategories
            <span class="controls">
            <button type="button" class="control fa fa-minus js__card_minus"></button>
            </span>
         </h4>
         <div class="js__card_content">
            <h2><?=count(totalSubCategories())?></h2>
         </div>
      </div>
      <!-- /.box-content -->
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>

