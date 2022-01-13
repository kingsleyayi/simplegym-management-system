<?php
require '../../include/db_conn.php';
page_protect();
    
    
   $uid=$_POST['uid'];
   $uname=$_POST['uname'];
   $gender=$_POST['gender'];
   $mobile=$_POST['phone'];
   $email=$_POST['email'];
   $dob=$_POST['dob'];
   $jdate=$_POST['jdate'];

    
    $query1="update users set username='".$uname."',gender='".$gender."',mobile='".$mobile."',email='".$email."',dob='".$dob."',joining_date='".$jdate."' where userid='".$uid."'";

   if(mysqli_query($con,$query1)){
      echo "<html><head><script>alert('Member Update Successfully');</script></head></html>";
      echo "<meta http-equiv='refresh' content='0; url=view_mem.php'>";

   }else{
    echo "<html><head><script>alert('ERROR! Update Opertaion Unsucessfull');</script></head></html>";
    echo "error".mysqli_error($con);
   }
    

?>
