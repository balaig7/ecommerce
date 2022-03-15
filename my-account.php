<?php
   include __DIR__."/loader.php";
   $userDetails=$_SESSION['current_user'];
  //  echo "<pre>";
  //  print_r($_SESSION);
?>
<style>
   .nav-pills>li.active>a,.update{
   background-color: #D10024!important;
   }
   .update,.update:hover{
     color:#fff;
   }
   .update:hover{
     opacity: 0.9;
   }
</style>
<div class="section">
   <div class="container">
      <div class="col-md-12">
         <!-- <h3>Pills left</h3> -->
         <!-- tabs left -->
         <div class="tabbable">
            <ul class="nav nav-pills nav-stacked col-md-3">
               <li class="active"><a href="#account" data-toggle="tab">Account</a></li>
               <li ><a href="#orders" data-toggle="tab">Orders</a></li>
               <li><a href="logout.php" >Logout</a></li>
            </ul>
            <div class="tab-content col-md-9">
               <div class="tab-pane active" id="account">
                  <form>
                        <div class="form-group col-md-12">
                           <label>Username</label>
                           <input type="text" class="form-control" value="<?=$userDetails['user_name']?>" >
                        </div>
                     <div class="form-group col-md-12">
                        <label>Address</label>
                        <input type="text" class="form-control" value="<?=$userDetails['address']?>" >
                     </div>
                     <div class="form-row">
                        <div class="form-group col-md-6">
                           <label>City</label>
                           <input type="text" class="form-control" value="<?=$userDetails['city']?>">
                        </div>
                        <div class="form-group col-md-6">
                           <label>Country</label>
                           <input type="text" class="form-control" value="<?=$userDetails['country']?>">
                        </div>
                     </div>
                     <div class="form-group col-md-12">
                        <button type="submit" class="btn update">Update</button>
                     </div>
                  </form>
               </div>
               <div class="tab-pane" id="orders">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. Aliquam in felis sit amet augue.</div>
            </div>
         </div>
         <!-- /tabs -->
      </div>
      <!-- /row -->
   </div>
</div>
<hr>
<?php
   include __DIR__."/layouts/footer.php";
   ?>