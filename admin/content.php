<?php
include __DIR__."/layouts/menu.php";
include __DIR__."/layouts/header.php";
?>
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">

<div class="main-content">
<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Products</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a class="btn btn-primary mb-2">Create</a>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<table id="example" class="table table-striped table-bordered display datatable" style="width:100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Quantity</th>
								<th>Status</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<td>Tiger Nixon</td>
								<td>System Architect</td>
								<td>Edinburgh</td>
								<td>61</td>
								<td>2011/04/25</td>
							</tr>
							<tr>
								<td>Garrett Winters</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>63</td>
								<td>2011/07/25</td>
							</tr>
							
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

