<?php
include('header.php');
$today_date=date('Y-m-d');
$session_branch_id=$_SESSION["branch_id"];
$department_id=$_REQUEST["department_id"];
$visitor_id=$_REQUEST["visitor_id"];
$fun_res_visitor=get_data("visitor_master","visitor_id=".$visitor_id);
$row_inquiry = mysqli_fetch_array($fun_res_visitor,MYSQLI_ASSOC);
$inquiry_id=$row_inquiry["inquiry_id"];
$fun_department_data=get_data("department","department_id=".$department_id);
$res_department_data= mysqli_fetch_array($fun_department_data,MYSQLI_ASSOC);
$fun_staff_data=get_data("usermaster","user_type_id='4' and branch_id='".$session_branch_id."'");
$res_staff_data= mysqli_fetch_array($fun_staff_data,MYSQLI_ASSOC);
$token_assign_to_staff=$res_staff_data["user_id"];
$token_no=0;
$token_where="branch_id='".$session_branch_id."' and token_date='".$today_date."'";
$fun_token_data=get_data("visitor_token",$token_where);
$res_token_data=mysqli_fetch_array($fun_token_data,MYSQLI_ASSOC);
$no_of_row=mysqli_num_rows($fun_token_data);
$select_max_no="select MAX(token_no) as max_today_token from visitor_token where $token_where";
$res_max_token=mysqli_query($link,$select_max_no);
$row_max_token=mysqli_fetch_array($res_max_token,MYSQLI_ASSOC);
if($no_of_row < 1){
	$token_no="1";
}
else{
	$token_no=$row_max_token["max_today_token"]+1;
}
$token_no=sprintf("%'03d", $token_no);
$fun_education = get_data("inquiry_education","inquiry_id=".$inquiry_id);
$row_education = mysqli_num_rows($fun_education);

if($row_education >0 || ($department_id =='4' || $department_id =='5')){

	$insert_token="insert into visitor_token(visitor_id,token_date,token_no,token_department,token_staff,token_status,branch_id,token_time) values('$visitor_id','$today_date','$token_no','$department_id','$token_assign_to_staff','Assign','$session_branch_id','$current_time')";
	if(mysqli_query($link,$insert_token)){
		$last_inserted_token=mysqli_insert_id($link);
		$mobile_no=$row_inquiry["visitor_mobile"];
		$visitor_email=$row_inquiry["visitor_email"];
		$visitor_name=$row_inquiry["visitor_first_name"]." ".$row_inquiry["visitor_last_name"];
		$department_name=$res_department_data["department"];
		if($notification==1 && $notification_email==1){
			$address=$visitor_email;
			$subject="Welcome to the ".$company_name;
			$student_fullname=$visitor_name;
			$body_token="<p style='font-weight: 600; font-size: 18px; margin-bottom: 0;'>Hey</p>
				<p style='font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #ff5850;'>".$student_fullname." !</p>
				<p class='sm-leading-32' style='font-weight: 600; font-size: 20px; margin: 0 0 16px; --text-opacity: 1; color: #263238;'>
				Thanks for Visit ! </p>
				
				<p style='margin: 0 0 24px;'>Dear ".$student_fullname.", your First Step towards your Dream is right here.</p>
				<p margin: 0 0 12px; color:#7367f0;'>TOKEN NO : ".$token_no."</p> 
				<p style='margin:0 0 12px; color:#7367f0;' >".$department_name."</p>
				";

				$attachment="";
				
				// shoot_email($attachment,$body_token,$subject,$address,$sender);
		}
		// $update_inquiry="update inquiry SET owner='".$token_assign_to_staff."',added_by='".$session_user_id."' where inquiry_id='".$inquiry_id."'";
		// mysqli_query($link,$update_inquiry);
		
		header('Location:token.php?token_id='.$last_inserted_token);
	}
	else{

	}
}else{
	header('Location:feed-inquiry-data.php?inquiry_id='.$inquiry_id.'&visitor_id='.$visitor_id);
}
?>
<?php
include('footer.php');
?>