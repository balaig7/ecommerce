<?php
$id=$_GET['id'];
$title=empty($id) ? "ADD PRODUCT":"UPDATE PRODUCT";

include __DIR__."/loader.php";
$id=$_GET['id'];
$category= get('category');
$product=find($id,'products');
$formId=$action=empty($id) ? "create-product" : "update-product" ;
$successMessage=empty($id) ? "New Product Created" : "Product Details Updated";
$getmaxId=dbquery('select MAX(id) as uid from `products`');
$subcategory = dbQuery("SELECT id,name from `sub_category` where parent_id='" . $product->parent_category_id . "'");
$parentCategoryName=dbQuery("SELECT category.name FROM `category` INNER JOIN products on products.parent_category_id=category.id WHERE category.id='$product->parent_category_id'");
$subCategoryName=dbQuery("SELECT sub_category.name FROM `sub_category` INNER JOIN products on products.child_category_id=sub_category.id WHERE sub_category.id='$product->child_category_id'");
?>
<style>
   .ck-editor__editable {
    min-height: 500px;
}
</style>
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
                  <input type="text" name="name" value="<?=!empty($product->name) ? $product->name : '' ?>" class="form-control">
                  <input type="hidden" name="action" value="<?=$action?>">
                  <input type="hidden" name="success_message" value="<?=$successMessage?>">
                  <input type="hidden" name="redirect_url" value="products.php">
                  <?=!empty($id) ? '<input type="hidden" name="id" value="'.$id.'">' : '' ?> 
               </div>

               <div class="form-group cat">
                  <label>Category</label>
                  <?php if(!empty($id)){ ?>
                  <input type="text" class="form-control" disabled name="parent_category_id" value="<?=$parentCategoryName['0']->name?>">
                  <?php }else{ ?>
                  <select class="form-control" name="parent_category_id" onchange="getSubCategory(this)">
                     <option value="">Select Category</option>
                     <?php foreach ($category as $key => $value) { ?>
                     <option value="<?=$value->id."-".$value->name?>"><?=$value->name?></option>
                     <?php } ?>
                  </select>
                  <?php } ?>
               </div>
               <?php if($product->child_category_id>0){ ?>
               <div class="form-group sub-cat">
                <label>Sub Category</label>
               <input type="text" class="form-control" disabled name="parent_category_id" value="<?=$subCategoryName['0']->name?>">
                </div>
               <?php }?>
  
               <label>Status of stock<span class="text-danger">*</span></label>
               <div class="switch primary">
                  <input type="checkbox" id="switch-2" name="status" class="status-of-stock" value="<?=$product->status?>" <?=$product->status=='1' ? 'checked' : ''?>><label for="switch-2"></label>
               </div>
               <div class="form-group">
                  <label>Quantity <span class="text-danger">*</span></label>
                  <input type="number" name="quantity" value="<?=$product->quantity?>"  class="form-control">
               </div>
               <label>Description <span class="text-danger">*</span></label>
               <div class="box-content">
                  <textarea id="description" name="description" required><?=htmlspecialchars_decode($product->description)?></textarea>
               </div>
               <div class="form-group">
                  <label>Product Images(Choose Multiple Images)<span class="text-danger">*</span></label>
                  <input type="file" <?=!empty($id)? '': 'required'?> name="product_images[]" multiple  class="form-control" accept="image/*" >
               </div>
               <div class="container">

               <?php  if(!empty($product->product_images)) {
               foreach (explode(",",$product->product_images) as $key => $value) {
               ?>
               <i class="fa fa-minus-circle plus text-danger delete-image" style="margin-left: 45px;margin-top: 10px;position: absolute;" aria-hidden="true" data-id="<?=$product->id?>" data-image="<?=$value?>"></i>

               <img src="<?=$product->product_images_path.$value?>" width="80">
 
               <?php }} ?>
               </div>
               <div class="form-group">
                  <label>Thumnail Image<span class="text-danger">*</span></label>
                  <input type="file" <?=!empty($id)? '': 'required'?> name="thumnail_image" multiple  class="form-control" accept="image/*" >
                  <?php if(!empty($id) && !empty($product->thumnail_image)){ ?>
                  <img src="<?=$product->thumnail_image_path.$product->thumnail_image?>" width="80">
                  <?php } ?>

               </div>
               <div class="form-group">
                  <label>Discounted price<span class="text-danger">*</span></label>
                  <input type="number" name="discounted_price" value="<?=$product->discounted_price?>"  class="form-control">
               </div>
               <div class="form-group">
                  <label>Orginal Price<span class="text-danger">*</span></label>
                  <input type="number" name="original_price"  class="form-control" value="<?=$product->original_price?>">
               </div>
               <button type="<?=empty($id) ? 'submit' : 'button' ?>" class="btn btn-primary btn-sm waves-effect waves-light <?=empty($id)? '':'update-product-data'?>" >Save</button>
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
$(document).on('change','.status-of-stock',function(){
   if($(this).is(":checked")){
      $(this).val('1');
   }else{
      $(this).val('0');
   }
})
$(document).on('click', '.delete-image', function() {
    var image = $(this).data('image');
    var id = $(this).data('id');
    var action = "delete-image"
    swal({
        title: "Delete?",
        text: "Are you sure you want to delete?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f60e0e",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
    }, function(isConfirm){
      if (isConfirm) {
        $.ajax({
            url: "ajax.php",
            type: "post",
            data: {
                'image': image,
                'id': id,
                action: action
            },
            success: function(data) {
                var response = $.parseJSON(data);
                if (response.status == 'success') {
                    swal({
                        title: response.message,
                        text: '',
                        type: 'success'
                    }, function() {
                        window.location = response.redirectUrl;
                    });
                } else {
                    Swal({
                        title: 'Error',
                        text: '',
                        type: 'error'
                    })
                }
            }
        })
      }else{
             swal("Cancelled", "", "error");
      }
   })

})
let editor;

ClassicEditor
    .create(document.querySelector('#description'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],

        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    }).then(neweditor => {
        editor=neweditor;
    })
    .catch(error => {
        console.log(error);
    });


$(document).on('click','.update-product-data',function(){
   const editorData = editor.getData();
   postFiles($('#update-product'),'ajax.php','post',editorData);
})
$("#create-product").validate({
    rules: {
        name: {
            required: true,
        },
        quantity: {
            required: true,
        },
        description: {
            required: true,
        },
        category_id: {
            required: true,
        },
        product_images: {
            required: true,
        },
        thumnail_images: {
            required: true,
        },
        discounted_price: {
            required: true,
        },
        original_price: {
            required: true,
        },
    },
    messages: {

    },
    submitHandler: function (form) {
        const editorData = editor.getData();//get ckeditor data
        postFiles(form, "ajax.php", "post",editorData);
    }
});
   


</script>