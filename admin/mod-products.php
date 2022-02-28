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
               <div class="form-group cat">
                  <label>Category</label>
                  <select class="form-control" name="parent_category_id" onchange="getSubCategory(this)">
                     <option value="">Select Category</option>
                     <?php foreach ($category as $key => $value) { ?>
                     <option value="<?=$value->id."-".$value->name?>"><?=$value->name?></option>
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
                  <div class="dropdown js__drop_down">
                     <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                     <ul class="sub-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else there</a></li>
                        <li class="split"></li>
                        <li><a href="#">Separated link</a></li>
                     </ul>
                  </div>
                  <textarea id="tinymce" name="description" required></textarea>
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
               <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" >Save</button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
function getSubCategory(id) {
    var value = id.value.split("-");
	var parent_id=value[0];

    $.ajax({
        url: "ajax.php",
        type: "post",
        data: {
            "action": "get-sub-category",
            "parent_id": parent_id
        },
        success: function(data) {
			$(".sub-cat").remove()
            var subcat = ''
            var response = JSON.parse(data);
            if (response.length > 0) {
                subcat += '<div class="form-group sub-cat">'
                subcat += '<label>Sub Category</label>'
                subcat += '<select class="form-control" name="child_category_id">'
                subcat += '<option value="">Select Category</option>'
                $.each(response, function(index, elements) {
                    subcat += '<option value="'+elements.id+'-' + elements.name + '">' + elements.name + '</option>'
                })
                subcat += '</select>'
                subcat += '</div>'
                $(".cat").after(subcat)
            } else {
                subcat = "<div class='form-group sub-cat'><input type='hidden' name='child_category_id' value=''>"
                $(".cat").after(subcat)
            }


        }

    })
}
</script>