<?php  
session_start();
include_once "api/functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Train Reservation</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
			<script>
			$(document).ready(function()
			{
				var x=(($(window).width())-1024)/2;
				$('.wrap').css("left",x+"px");
			});

		</script>
		<script type="text/javascript" src="js/main.js"></script>

	</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="booking-cta">
							<h1>Book your Train</h1>
							<p>Demo TRS by Sadashiv Mitra</p>
						</div>
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="booking-form">
							<div class="row">
								<!-- find train with qouta-->
								<div class="span4 well">
									<form method="post" action="index.php">
										<table class="table">
											<tr>
												<th style="border-top:0px;"><label> From <label></th>
												<td style="border-top:0px;"><input type="text" class="input-block-level" name="from" id="fr" ></td>
											</tr>
											<tr>
												<th style="border-top:0px;"><label> To <label></th>
												<td style="border-top:0px;"><input type="text" class="input-block-level" name="to" id="to1" ></td>
											</tr>
											<tr>
												<th style="border-top:0px;" ><label > Quota <label></th>
												<td style="border-top:0px;"><input list="q1" class="input-block-level" name="quota" id="q12" value="<?php if(isset($_POST['quota']))echo $_POST['quota'];?>">
												<datalist id="q1" >
												<option value="General">General</option>
												<option value="Tatkal">Tatkal</option>
												<option value="Ladies">Ladies</option>
												</datalist>
												</td>
											</tr>
											<tr>
												<th style="border-top:0px;"><label> Date<label></th>
												<td style="border-top:0px;"><input type="date" class="input-block-level input-medium" name="date" max="<?php echo date('Y-m-d',time()+60*60*24*90);?>" min="<?php echo date('Y-m-d')?>" value="<?php if(isset($_POST['date'])){echo $_POST['date'];}else {echo date('Y-m-d');}?>"> </td>
											</tr>
											<tr>
												<td style="border-top:0px;"><input class="btn btn-info" type="submit" value="OK"></td>
												<td style="border-top:0px;"><a href="index.php" class="btn btn-info" type="reset" value="Reset">Reset</a></td>
											</tr>
										</table>
									</form>
								</div>
			
		<!-- display train -->
								<div class="span8 well display">
									<div class="display" style="margin-top:0px;overflow:auto;">
										<table class="table">
											<?php  
												
												if($k==1)
												{
													
													echo "<script> document.getElementById(\"fr\").value=\"$from\";
																document.getElementById(\"to1\").value=\"$to\";
																
														</script>";
													$n=0;
													while($row=mysqli_fetch_array($result)){
												//$q="from: ".$from;
													if($from==$row['st1'])
													{	$q=$row['st1arri'];
														//echo $q;
													}
													else
													if($from==$row['st2'])
													{	$q=$row['st2arri']; }
													else if($from==$row['st3'])
													{	$q=$row['st3arri']; }
													else if($from==$row['st4'])
													{	$q=$row['st4arri']; }
													else if($from==$row['st5'])
													{	$q=$row['st5arri']; }
													else if($from==$row['Ori'])
													{	$q=$row['Oriarri']; }
													else if($from==$row['Dest'])
													{	$q=$row['Destarri'];}
													
													$p1=substr($q,0,2);
													$p2=substr($q,3,2);
													$p2=$p2+5;
													if($p2<10)
													{$p2="0".$p2;}
													$d=$p1.":".$p2;
												if($n%2==0)
												{
											
											?>
											<tr>
												<th style="width:80px;border-top:0px;"> Train No.</th>
												<th style="width:270px;border-top:0px;"> Train Name </th>
												<th style="width:65px;border-top:0px;"> Orig. </th>
												<th style="width:55px;border-top:0px;"> Des. </th>
												<th style="width:70px;border-top:0px;"> Arr. </th>
												<th style="width:80px;border-top:0px;"> Dep. </th>
												<th style="width:150px;border-top:0px;"></th>
											</tr>
											<tr class="text-error">
												<td style="width:70px;"> <?php   echo $row['Number']; ?> </td>
												<td style="width:250px;"> <?php echo $row['Name']; ?> </a></td>
												<td style="width:65px;"> <?php echo $row['Ori']; ?> </td>
												<td style="width:55px;"> <?php echo $row['Dest']; ?> </td>
												<td style="width:60px;"> <?php   echo $q; ?> </td>
												<td style="width:65px;"> <?php   echo $d; ?> </td>
												<td style="width:200px;">  
													<a class="text-error" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "1A";?>"><b>1A</b></a> 
													<a class="text-error" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "2A";?>"><b>2A</b></a>
													<a class="text-error" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "3A";?>"><b>3A</b></a> 
													<a class="text-error" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "SL";?>"><b>SL</b></a> 
													
												</td>
											</tr>
											<?php  
												}
												else
												{
											?>
											<tr class="text-info">
												<td style="width:70px;"> <?php  echo $row['Number']; ?> </td>
												<td style="width:210px;"><?php  echo $row['Name']; ?> </a> </td>
												<td style="width:65px;"> <?php  echo $row['Ori']; ?> </td>
												<td style="width:55px;"> <?php  echo $row['Dest']; ?> </td>
												<td style="width:60px;"> <?php  echo $q; ?> </td>
												<td style="width:65px;"> <?php  echo $d; ?> </td>
												<td style="width:200px;">
													<a class="text-info" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "1A";?>"><b>1A</b> </a> 
													<a class="text-info" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "2A";?>"><b>2A</b></a>
													<a class="text-info" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "3A";?>"><b>3A</b></a>
													<a class="text-info" href="seat-selection.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn ?>&doj=<?php echo $doj ?>&quota=<?php echo $quota;?>&class=<?php echo "SL";?>"><b>SL</b></a>
												</td>
											</tr>
											<?php  
												}
												$n++;
												}
											}
											else
											{
												echo "<div class=\"alert alert-error\"  style=\"margin:100px 180px;\"> please search the train.. </div>";
											}
												
												mysqli_close($conn);
											?> 
										</table>
									</div>
								</div>
							</div>
						</div>
					<!-- <form>
								<div class="form-group">
									<div class="form-checkbox">
										<label for="roundtrip">
											<input type="radio" id="roundtrip" name="flight-type">
											<span></span>Roundtrip
										</label>
										<label for="one-way">
											<input type="radio" id="one-way" name="flight-type">
											<span></span>One way
										</label>
										<label for="multi-city">
											<input type="radio" id="multi-city" name="flight-type">
											<span></span>Multi-City
										</label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Flying from</span>
											<input class="form-control" type="text" placeholder="City or airport">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Flyning to</span>
											<input class="form-control" type="text" placeholder="City or airport">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Departing</span>
											<input class="form-control" type="date" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Returning</span>
											<input class="form-control" type="date" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Adults (18+)</span>
											<select class="form-control">
												<option>1</option>
												<option>2</option>
												<option>3</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Children (0-17)</span>
											<select class="form-control">
												<option>0</option>
												<option>1</option>
												<option>2</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Travel class</span>
											<select class="form-control">
												<option>Economy class</option>
												<option>Business class</option>
												<option>First class</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>
								<div class="form-btn">
									<button class="submit-btn">Show flights</button>
								</div>
							</form> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>