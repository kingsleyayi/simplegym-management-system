<?php
session_start();
if(isset($_SESSION["user_data"]))
{
	header("location:./dashboard/admin/");
}
include './include/db_conn.php';

$check = "SELECT * FROM plan";
$checkresult =mysqli_query($con,$check);

if(isset($_POST["btnReg"])){
    function random_strings($length_of_string)
    {
        $str_result = '0123456789';
        return substr(str_shuffle($str_result),
                        0, $length_of_string);
    }
    $generate = random_strings(10);
    $qu = "SELECT * FROM users WHERE userid = '$generate'";
    $row = mysqli_query($con,$qu);
  
    if(mysqli_num_rows($row) >0){
        $generate = random_strings(20);
        }
        $name =$con -> real_escape_string($_POST['user_id_auth']);
        $email =$con -> real_escape_string($_POST['email']);
        $gender =$con -> real_escape_string($_POST['gender']);
        $password = $con -> real_escape_string($_POST['pass_key']);
        $phone = $con ->real_escape_string($_POST['phone']);
        $plan =$con -> real_escape_string($_POST['plan']);
        $dob =$con -> real_escape_string($_POST['dob']);
        $joindate = date("Y-m-d");


        $ql = "SELECT * FROM users WHERE email ='$email' || password ='$password'";
        $result = mysqli_query($con,$ql);
       
        if(mysqli_num_rows($result) >0){
        echo "User already exist";
        }
        
        elseif(mysqli_num_rows($result) == 0){
 
        $reg = "INSERT INTO users (userid, username, gender, mobile, email, dob, joining_date, plan, password) VALUES ('$generate','$name','$gender','$phone','$email','$dob','$joindate','$plan','$password')";
        $regquery = mysqli_query($con,$reg);
        if($regquery){
            $check = "SELECT * FROM plan WHERE planName = '$plan'";
            $checkresult =mysqli_query($con,$check);
           if($checkdetail=mysqli_fetch_array($checkresult,MYSQLI_ASSOC)){
            echo "yes";
            $planid = $checkdetail['pid']; 
            $val = $checkdetail['validity'];
            $day = $val * 30;
            $newdate=date('Y-m-d', strtotime("+$day days"));

            $puten = "INSERT INTO enrolls_to (pid, uid, paid_date, expire, renewal) VALUES ('$planid','$generate','$joindate','$newdate','yes')";
            $putenresult =mysqli_query($con,$puten);
            if($putenresult){
                header("location: index.php");
            }
           }
              
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gym | Login</title>
	<link rel="stylesheet" href="./css/style.css"/>
	<link rel="stylesheet" type="text/css" href="./css/entypo.css">
</head>
<body>

<body class="page-body login-page login-form-fall">
    	<div id="container">
			<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			
			<h1 style="color:white;">GYM System</h1>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>register...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<form method='post' id="bb">				
				<div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
							<input type="text" placeholder="username" class="form-control" name="user_id_auth" id="textfield" data-rule-minlength="6" data-rule-required="true">
					</div>
				</div>				
								
				<div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						<input type="password" name="pass_key" id="pwfield" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Password">
					</div>				
				</div>

                <div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						<input type="email" name="email" id="pwfield" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="email">
					</div>				
				</div>
                <div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						<input type="number" name="phone" id="pwfield" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="phone">
					</div>				
				</div>
                <div class="form-group">
                   <div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						<input type="date" name="dob" id="pwfield" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="date">
				 	</div>				
			     	
                </div>

                <div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
                        <select   name="gender" required id="pwfield" class="form-control" required style="color:black;">
                                <option value="none" style="">Select Gender: </option>
                                <option value="male">male</option>
                                <option value="female">female</option>

                            </select>
					</div>				
				</div>

                <div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
                        <select   name="plan" id="pwfield" class="form-control" required style="color:black;">
                        <option  style="">Select Plan: </option>
                        <?php
                        		   while($checkresultdetail=mysqli_fetch_array($checkresult,MYSQLI_ASSOC)){
                                    $planname = $checkresultdetail['planName'];
                                 
                                                                ?>
                                                    

                                <option value="<?php echo $planname;?>"><?php echo $planname;?></option>

                            <?php
                                                            }
                            ?>
                            </select>
					</div>				
				</div>
				
				<div class="form-group">
					<button type="submit" name="btnReg" class="btn btn-primary">
						Register
						<i class="entypo-login"></i>
					</button>
				</div>
			</form>
		
						
		</div>
		
	</div>
	
</div>

		</div>

</body>
</html>
