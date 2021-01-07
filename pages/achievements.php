<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Achievements";
	$desc="This is the description of Achievements";
	if(!isset( $_SESSION['aid']))
	{
		header("location:login.php");
	}
	$qry="select a.*,Name from tblplayer p join tblachievements a on p.PlayerID=a.PlayerID";
	$sel=mysqli_query($con,$qry) or die(mysqli_error($con));
	
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
													<h5>Achievements</h5>
												</div>
												<div class="card-block">
													<div class="dt-responsive table-responsive">
														<table id="order-tables" class="table table-striped table-bordered nowrap">
															<thead>
																<tr>
																	<th>Achievements Title</th>
																	<th style="width: 300px;">Description</th>
																	<th>Profile Image</th>
																	<th>Player Name</th>
																</tr>
															</thead>
															<tbody>
																<?php while($row=mysqli_fetch_array($sel)) { ?>
																<tr>
																	<td><?= $row['Title']?></td>
																	<td style="width: 200px;" title="<?= $row['Description']?>"><?= substr($row['Description'], 0,30)?></td>
																	<td><img height="50px" width="50px" src="../files/image/<?= $row['Image']?>" /></td>
																	<td><?= $row['Name'] ?></td>
																</tr>
																<?php } ?>
															</tbody>
															<tfoot>
																<tr>
																	<th>Achievements Title</th>
																	<th style="width: 300px;">Description</th>
																	<th>Profile Image</th>
																	<th>Player Name</th>
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
