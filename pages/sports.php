<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Sports";
	$desc="This is the description of Sports";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}
	$qry="select * from tblsports";
	$sel=mysqli_query($con,$qry) or die(mysqli_error());
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$title?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
		<?php include_once('topscript.php'); ?>
	</head>
	<body>
		<div class="loader-bg">
			<div class="loader-bar"></div>
		</div>
		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">
				<?php include_once('nav.php');?>
				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">
						<?php include_once('sidebar.php') ?>
						<div class="pcoded-content">

							<div class="page-header card">
								<div class="row align-items-end">
									<div class="col-lg-8">
										<div class="page-header-title">
											<!-- <i class="feather icon-home bg-c-blue"></i> -->
											<div class="d-inline">
											<h5><?= $title?></h5>
											<span><?= $desc ?></span>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="page-header-breadcrumb">
											<ul class=" breadcrumb breadcrumb-title">
												<li class="breadcrumb-item">
													<a class="btn btn-primary" href="add_sports.php">Add Sports</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						
							<!-- CB starts -->
							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="page-body">
											<!-- content to be written here -->
											<div class="card">
												<div class="card-header">
													<h5>Sports</h5>
												</div>
												<div class="card-block">
													<div class="dt-responsive table-responsive">
														<table id="order-tables" class="table table-striped table-bordered nowrap">
															<thead>
																<tr>
																	<th>Description</th>
																	<th>Image</th>
																	<th>Delete</th>
																</tr>
															</thead>
															<tbody>
																<?php while($row=mysqli_fetch_row($sel)) { ?>
																<tr>
																	<td><?= $row[1]?></td>
																	<td><img height="50px" width="50px" src="../files/image/<?= $row[2]?>" /></td>
																	<td></td>
																</tr>
																<?php } ?>
															</tbody>
															<tfoot>
																<tr>
																	<th>Description</th>
																	<th>Image</th>
																	<th>Delete</th>
																</tr>
															</tfoot>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- CB Ends -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once('Bottom.php') ?>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#order-tables').DataTable();
			});
		</script>
	</body>
</html>
