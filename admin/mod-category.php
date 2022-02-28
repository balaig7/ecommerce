<?php
   include __DIR__."/loader.php";
   $id=$_GET['id'];
   $category=find($id,'category');
   $formId=$action=empty($id) ? "create-category" : "update-category" ;
   $successMessage=empty($id) ? "New Category Created" : "Category Updated" ;
?>
<style>
	.d-flex{
		display:flex;
	}
	.plus{
		padding: 7px;
		font-size:25px!important;
	}
   .d-none{
      display:none
   }
   .d-block{
      display:block;
   }
	</style>
<div class="main-content">
<div class="row small-spacing">
   <div class="col-lg-12 col-xs-12">
      <div class="box-content card white">
         <h4 class="box-title"><?=empty($id) ? 'Create New' : 'Update' ?> Category</h4>
         <div class="card-content">
            <form method="post" id="<?=$formId?>">
               <div class="form-group">
                  <label>Parent Category</label>
                  <input type="text" name="name" value="<?=!empty($category->name) ? $category->name : '' ?>" class="form-control">
                  <input type="hidden" name="action" value="<?=$action?>">
                  <input type="hidden" name="success_message" value="<?=$successMessage?>">
                  <input type="hidden" name="redirect_url" value="products.php">
                  <?=empty(!$id) ? '<input type="hidden" name="id" value="'.$id.'">' : '' ?> 
               </div>
               <label>Status</label>
               <div class="switch primary">
                  <input type="checkbox" id="switch-2" class="status" name="status" value="<?=$category->status?>" <?=$category->status=='1'?'checked':''?>><label for="switch-2"></label>
               </div>
               <label>Are you want to add subcategory?</label>
               <div class="form-group">
                  <input type="checkbox" name="is_childrens" class="add-subcategory" value="<?=$category->is_childrens?>" <?=$category->is_childrens=='1'?'checked':''?> onchange=showChildCategories($(this))>
               </div>
               <?php if($category->is_childrens=='1'){ ?>
               <p style="font-weight: 500;" class="sub-cat-label">Sub Category</p>
               <div class="col-xs-6 col-sm-6 sub-cat " >
               <?php if($category->is_childrens=='1'){
                  $subCategories=dbQuery("SELECT * from `sub_category` where parent_id='".$id."'");
                  $lastArray=count($subCategories);
                  foreach ($subCategories as $key => $value) {
                     
               ?>

                  <div class="form-group col-xs-12 col-sm-12 ">
                     <div class="d-flex">   
                        <input type="text" name="sub_category[<?=$value->id?>]" class="form-control" value=<?=$value->name?>><?=$lastArray==$key+1? '<i class= "fa fa-plus-circle plus text-primary" aria-hidden="true"></i>' :'<i class="fa fa-minus-circle plus text-danger" aria-hidden="true"></i>' ?>
                     </div>
                  </div>
               <?php }} ?>   
               </div>
               <?php }else{ ?>
               <p style="font-weight: 500;" class="d-none sub-cat-label">Sub Category</p>
               <div class="col-xs-6 col-sm-6 sub-cat d-none" >
                  <div class="form-group col-xs-12 col-sm-12 ">
                     <div class="d-flex">   
                        <input type="text" name="sub_category[]" class="form-control"><i class="fa fa-plus-circle plus text-primary" aria-hidden="true"></i>
                     </div>
                  </div>
               </div>
               <?php } ?>   
               <div class="col-xs-12 col-sm-12" style="margin-bottom: 13px;">
                  <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="post($('#<?=$formId?>').serialize(),'ajax.php','post')">Save</button>
               </div>
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
<script>
	function showChildCategories(current){
      if(current.is(":checked")){
         $('.sub-cat, .sub-cat-label').removeClass("d-none");
         $('.sub-cat, .sub-cat-label').addClass("d-block");
         $(current).val('1');
      }else{
         $('.sub-cat, .sub-cat-label').removeClass("d-block");
         $('.sub-cat, .sub-cat-label').addClass("d-none");
         $(current).val('0');

      }
   }
   $(document).on('change','.status',function(){
          if($(this).is(":checked")){
            $(this).val('1');
          }else{
            $(this).val('0');
          }

      
   })
	$(document).on('click','.fa-plus-circle',function(){
		$(this).removeClass("fa-plus-circle text-primary")
		$(this).addClass("fa-minus-circle text-danger")
		var html='<div class="form-group col-xs-12 col-sm-12"><div class="d-flex"><input type="text" name="sub_category[]" class="form-control"><i class="fa fa-plus-circle plus text-primary" aria-hidden="true"></i></div></div>';
		$('.sub-cat').append(html)
	})
	$(document).on('click','.fa-minus-circle',function(){
		$(this).parent().parent().remove()
	})
	
</script>