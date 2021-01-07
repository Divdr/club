<?php
	session_start();
	include_once("../resources/connection.php");
	$title="Tournament Info";
	$desc="Shows the tournament's all info";

	if(!isset($_SESSION['aid']))
	{
		header("location:login.php");
	}

	if(isset($_GET['tid'])){
		$tid=$_GET['tid'];
		$qry="select * from tbltournament t join tblclub c on c.ClubID=t.ClubID where TournamentID=$tid";
		$r=mysqli_query($con,$qry)or die(mysqli_error($con));
		$ROW=mysqli_fetch_array($r);

		$qry1="select * from tblteamreg where TournamentID=$tid";
		$r1=mysqli_query($con,$qry1)or die(mysqli_error($con));

		$qry2="select tr.*,t.* from tbltournamentresult tr join tblteamreg t on tr.WinnerTeamID=t.TeamRegID or tr.RunnersupTeamID=t.TeamRegID where tr.TournamentID=$tid";
		$r2=mysqli_query($con,$qry2)or die(mysqli_error($con));
	}else
		header("location:tournament.php");
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
											<i class="feather icon-home bg-c-blue"></i>
											<div class="d-inline">
												<h5><?= $title?></h5>
												<span><?= $desc ?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<!-- CB starts -->
							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="page-body">
											<div class="card">
												<div class="card-header">
													<h5 style="font-weight: 600;font-size: 2em"><?= $ROW['Title'] ?></h5>
												</div>
												<div class="card-body">
													<font style="font-weight:600;font-size: 1.2em; ">Description</font>
													<p class="m-l-20 m-t-10"><?= $ROW['Description'] ?></p>
												</div>
												<div class="m-l-50 m-t-20 col-sm-12 col-xl-8">
													<dl class="dl-horizontal row">
														<dt class="col-sm-3 m-t-5">Club Name</dt>
														<dd class="col-sm-9 m-t-5"><?= $ROW['Name'] ?></dd>
														<dt class="col-sm-3 m-t-5">Date - Time</dt>
														<dd class="col-sm-9 m-t-5"><?= $ROW['Date']." - ".$ROW['Time'] ?></dd>
														<dt class="col-sm-3 m-t-5">Stating Date</dt>
														<dd class="col-sm-9 m-t-5"><?= $ROW['RegistrationSDate'] ?></dd>
														<dt class="col-sm-3 m-t-5">Ending Date</dt>
														<dd class="col-sm-9 m-t-5"><?= $ROW['RegistrationEDate'] ?></dd>
														<dt class="col-sm-3 m-t-5">Min. player</dt>
														<dd class="col-sm-9 m-t-5"><?= $ROW['NoOfPlayerMin'] ?></dd>
														<dt class="col-sm-3 m-t-5">Max. player</dt>
														<dd class="col-sm-9 m-t-5"><?= $ROW['NoOfPlayerMax'] ?></dd>
														<dt class="col-sm-3 m-t-5">No. Of Team</dt>
														<dd class="col-sm-9 m-t-5"><?= $ROW['NoOfteams'] ?></dd>
													</dl>
												</div>
											</div>
											<div class="card">
												<div class="card-header">
													<h5>Team</h5>
												</div>
												<div class="card-block m-l-50">

													<?php
														while($ROW1=mysqli_fetch_array($r1)){
													?>
														<code style="padding: 10px;margin:10px;"><a href="team_info.php?trid=<?= $ROW['0'] ?>"><?= $ROW1['Title'] ?></a></code>
													<?php
														}
													?>
												</div>
											</div>
											<div class="card">
												<div class="card-header">
													<h5>Result</h5>
												</div>
												<div class="card-block m-l-50">
													<div class="row">
														<?php
															$c=0;
															while ($data=mysqli_fetch_array($r2)) 
															{
																if($c){
														?>
																	<div class="col-md-6 col-xs-12">
																		<img src="../files/image/runnerup.png" height="200px" width="180px">
																		<code style="padding: 10px;margin:10px;"><?= $data['Title'] ?></code>
																	</div>
														<?php

																}else{
														?>
																	<div class="col-md-6 col-xs-12">
																		<img src="../files/image/winner.png" height="200px" width="180px">
																		<code style="padding: 10px;margin:10px;"><?= $data['Title'] ?></code>
																	</div>
														<?php			
																}
																$c++;
															}
														?>
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
	</body>
</html>
