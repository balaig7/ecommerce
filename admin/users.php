<?php
$title="USERS";
include __DIR__."/loader.php";
$users=dbQuery('select `login`.id,`login`.display_name,`login`.status,`login`.created_at,`users`.address,`users`.city,`users`.country from `login` inner join `users` on `login`.profile_id=`users`.id');
// echo "<pre>";
// print_r($users);
?>

<div class="main-content">
<div class="row small-spacing">
   <div class="col-xs-12">
      <div class="box-content">
         <h4 class="box-title">Users</h4>
         <table class="table table-striped table-bordered display datatable" style="width:100%">
            <thead>
               <tr>
                 <?php 
                  tableHead(array('S.no','Name','Address','City','Country','Joined On','Status','Action'));
                 ?>
               </tr>
            </thead>
            
            <tbody>
                <?php foreach ($users as $key => $value) { ?>
               <tr>
                  
                  <td><?=$key+1?></td>
                  <td><?=$value->display_name?></td>
                  <td><?=$value->address?></td>
                  <td><?=$value->city?></td>
                  <td><?=$value->country?></td>
                  <td><?=date('d-M-Y',strtotime($value->created_at))?></td>
                  <td><span class="notice text-white <?=$value->status=='1' ? 'bg-success' : 'bg-danger'?>"><?=$value->status=='1' ? 'Active' : 'Inactive'?></span></td>
                  <td>
                      <?php if($value->status=='1'){ ?>
                      <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="userAction('<?=$value->id?>','0')">Block</button>
                      <?php }else{ ?>
                         <button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="userAction('<?=$value->id?>','1')">Unblock</button>
                    <?php } ?>

                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php
include __DIR__."/layouts/footer.php";
?>
<script>
function userAction(user,status){
    $.ajax({
        url:'user-action.php',
        type:"post",
        data:{
            user_id:user,
            status:status
        },
        success:function(data){
             var response = $.parseJSON(data);
                if (response.status == 'success') {
                    swal({
                        title: response.message,
                        text: '',
                        type: 'success'
                    }, function() {
                        location.reload();
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
}
</script>
