<?php
include __DIR__."/loader.php";
// getHeader();
$category=get('category');
$products=get('products');
?>

<div class="main-content">
<div class="row small-spacing">
   <div class="col-xs-12">
      <div class="box-content">
         <h4 class="box-title">Category</h4>
         <!-- /.box-title -->   
         <div class="dropdown js__drop_down">
            <a href="mod-category.php" class="btn btn-primary mb-2">Create</a>
            <!-- /.sub-menu -->
         </div>
         <!-- /.dropdown js__dropdown -->
         <table class="table table-striped table-bordered display datatable" style="width:100%">
            <thead>
               <tr>
                 
                   <?php 
                  tableHead(array('S.no','Name','Action'));
                  ?>
               </tr>
            </thead>
            
            <tbody>
                <?php foreach ($category as $key => $value) { ?>
               <tr>
                  
                  <td><?=$key+1?></td>
                  <td><?=$value->name?></td>
                  <td>
                     <a href="mod-category.php?id=<?=$value->id?>" class="btn btn-primary btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-pencil"></i></a>
                     <!-- <button type="button" class="btn btn-danger btn-circle btn-sm waves-effect waves-light" onclick=deleteData('ajax.php','<?=json_encode(array("id"=>$value->id,"action"=>"delete-category" ));?>','post')><i class="ico fa fa-trash"></i></button> -->
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
      <!-- /.box-content -->
   </div>
   <div class="col-xs-12">
      <div class="box-content">
         <h4 class="box-title">Products</h4>
         <!-- /.box-title -->
         <div class="dropdown js__drop_down">
            <a class="btn btn-primary mb-2" href="mod-products.php">Create</a>
            <!-- /.sub-menu -->
         </div>
         <!-- /.dropdown js__dropdown -->
         <table id="example" class="table table-striped table-bordered display datatable" style="width:100%">
            <thead>
               <tr>
                  <?php 
                  tableHead(array('S.no','Name','Quantity','Status','Original Price','Discounted Price','Action'));
                  ?>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($products as $key => $value) { ?>
               <tr>
                  <td><?=$key+1?></td>
                  <td><?=$value->name?></td>
                  <td><?=$value->quantity?></td>
                  <td><span class='notice <?=$value->status =='in stock' ? 'bg-success':'bg-danger' ?>  text-white'><?=strtoupper($value->status)?></span></td>
                  <td><?=$value->original_price?></td>
                  <td><?=$value->discounted_price?></td>
                  <td><a href="mod-products.php?id=<?=$value->id?>" class="btn btn-primary btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-pencil"></i></a></td>
               </tr>
               <?php } ?>
               
            </tbody>
         </table>
      </div>
      <!-- /.box-content -->
   </div>
</div>


<?php
include __DIR__."/layouts/footer.php";
?>
<script>
    $('.datatable').dataTable();
</script>

