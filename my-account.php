<?php
include __DIR__."/loader.php";
?>
<style>
    .nav-pills>li.active>a{
       background-color: #D10024!important;
    }
</style>
		<div class="section">

<div class="container">

        <div class="col-md-12">
            <!-- <h3>Pills left</h3> -->
            <!-- tabs left -->
            <div class="tabbable">
                <ul class="nav nav-pills nav-stacked col-md-3">
                    <li><a href="#account" data-toggle="tab">Account</a></li>
                    <li class="active"><a href="#orders" data-toggle="tab">Orders</a></li>
                    <li><a href="#address" data-toggle="tab">Address</a></li>
                    <li><a href="logout.php" >Logout</a></li>
                </ul>
                <div class="tab-content col-md-9">
                    <div class="tab-pane active" id="account"><form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form></div>
                    <div class="tab-pane" id="orders">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. Aliquam in felis sit amet augue.</div>
                    <div class="tab-pane" id="address">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis elementum auctor accumsan. Duis pharetra
                    varius quam sit amet vulputate. Quisque mauris augue, molestie tincidunt condimentum vitae. </div>
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