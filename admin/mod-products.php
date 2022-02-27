<?php
include __DIR__."/loader.php";
$id=$_GET['id'];
// $category=find($id,'products');
$category= get('category');
$formId=$action=empty($id) ? "create-product" : "update-product" ;
$successMessage=empty($id) ? "New Product Created" : "Product Details Updated" ;
?>
<div class="main-content">
<div class="row small-spacing">

<div class="col-lg-12 col-xs-12">
				<div class="box-content card white">
					<h4 class="box-title"><?=empty($id) ? 'Create New' : 'Update' ?> Product</h4>
					<!-- /.box-title -->
					<div class="card-content">
						<form method="post" id="<?=$formId?>" enctype="multipart/form-data">
							<div class="form-group">
								<label>Name <span class="text-danger">*</span></label>
								<input type="text" name="name" value="<?=!empty($category->name) ? $category->name : '' ?>" class="form-control">
                                <input type="hidden" name="action" value="<?=$action?>">
                                <input type="hidden" name="success_message" value="<?=$successMessage?>">
                                <input type="hidden" name="redirect_url" value="products.php">
								<?=empty(!$id) ? '<input type="hidden" name="id" value="'.$id.'">' : '' ?> 
							</div>
                            <div class="form-group">
								<label>Category</label>
							<select class="form-control" name="category_id">
								<option value="">Select Category</option>
								<?php foreach ($category as $key => $value) { ?>
								<option value="<?=$value->id?>"><?=$value->name?></option>
								<?php } ?>
							</select>							
						</div>
                            <div class="form-group">
								<label>SKU</label>
								<input type="text" name="name"  class="form-control">
							</div>
                            <div class="form-group">
								<label>Quantity <span class="text-danger">*</span></label>
								<input type="number" name="quantity"  class="form-control">
						    </div>

                <label>Description <span class="text-danger">*</span></label>
				<div class="box-content">
					<!-- <h4 class="box-title">Default</h4> -->
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else there</a></li>
							<li class="split"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<textarea id="tinymce" name="description" required>
						
					</textarea>
				</div>
                 			<div class="form-group">
								<label>Product Images(Choose Multiple Images)<span class="text-danger">*</span></label>
								<input type="file" required name="product_images[]" multiple  class="form-control" accept="image/*" >
							</div>
							 <div class="form-group">
								<label>Thumnail Image<span class="text-danger">*</span></label>
								<input type="file" required name="thumnail_image" multiple  class="form-control" accept="image/*" >
							</div>
                           
                            <div class="form-group">
								<label>Discounted price<span class="text-danger">*</span></label>
								<input type="number" name="discounted_price"  class="form-control">
						    </div>
							 <div class="form-group">
								<label>Orginal Price<span class="text-danger">*</span></label>
								<input type="number" name="original_price"  class="form-control">
						    </div>
				<!-- /.box-content -->
						<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" >Save</button>
						</form>
					</div>
					<!-- /.card-content -->
				</div>
				<!-- /.box-content -->
			</div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>