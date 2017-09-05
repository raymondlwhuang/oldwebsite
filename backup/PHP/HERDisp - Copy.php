<?php
include("../config.php");
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
}
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);
include("endec.php");
$e = new endec(); 
$zero = $e->new_encode("0");
$month_array = array ();
$month_array[1] = "January";
$month_array[2] = "February";
$month_array[3] = "March";
$month_array[4] = "April";
$month_array[5] = "May";
$month_array[6] = "June";
$month_array[7] = "July";
$month_array[8] = "August";
$month_array[9] = "September";
$month_array[10] = "October";
$month_array[11] = "November";
$month_array[12] = "December";
$ErrorMessage = '';
$user_id = (int)$_REQUEST['user_id'];
$category_id = (int)$_REQUEST['category_id'];
$item_id = (int)$_REQUEST['item_id'];
$comment_id = (int)$_REQUEST['comment_id'];
$amount = (float)$_REQUEST['amount'];
$amount_neg = $amount * (-1);
$expenses = $e->new_encode("$amount");
$expenses_neg = $e->new_encode("$amount_neg");
$spender_id = (int)mysql_real_escape_string($_REQUEST['spender_id']);
$type_id = (int)$_REQUEST['type_id'];
$bank_id = (int)$_REQUEST['bank_id'];
$to_bank = (int)$_REQUEST['to_bank'];
$frequency_id = (int)$_REQUEST['frequency_id'];
$refer_date = mysql_real_escape_string($_REQUEST['start_date']);
$year_month = mysql_real_escape_string($_REQUEST['year_month']);
$yearly = (int)$_REQUEST['yearly'];
$action = mysql_real_escape_string($_REQUEST['action']);
$fmyear=substr($refer_date,6,4);
$fmmonth=substr($refer_date,0,2);
$fmday=substr($refer_date,3,2);
$toyear = date("Y");
$tomonth = date("m");
$today = date("d");
$start_date = ($fmyear.$fmmonth.$fmday."000000");
$curr_date = date("Y-m-d");
$start_date1=gregoriantojd($fmmonth, $fmday, $fmyear);   
$end_date=gregoriantojd($tomonth, $today, $toyear);   
$daysdiff = $end_date - $start_date1;
$date = "$fmyear-$fmmonth-$fmday";
$CategoryResult=mysql_query("SELECT * FROM `spending_category` where user_id = $user_id or user_id = 0 order by category");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option1 = mysql_fetch_array($CategoryResult)) {
	$optionCategory["$option1[id]"] = $option1['category'];
}
$GetInsertData = mysql_query("SELECT * FROM `item_frequency` where user_id=$user_id and activated <= '$curr_date'");
while($ResultRow=mysql_fetch_array($GetInsertData)){
	$item_curr_id = $ResultRow['id'];
	$reupdate_date = $ResultRow['activated']."000000";
	$org_date = strtotime ($ResultRow['start_date']."000000");
	$amount10 = $ResultRow['amount'];
	$fq_amount10 = $e->new_decode("$amount10");
	$fq_amount10_neg = $e->new_decode("$amount10") * (-1);
	$amount10_neg = $e->new_encode("$fq_amount10_neg");
	$spender_id10 = $ResultRow['spender_id'];
	$category_id10 = $ResultRow['category_id'];
	$item_id10 = $ResultRow['item_id'];
	$type_id10 = $ResultRow['type_id'];
	$bank_id10 = $ResultRow['bank_id'];
	$to_bank_id10 = $ResultRow['to_bank_id'];
	$reupdateyear=substr($reupdate_date,0,4);
	$reupdatemonth=substr($reupdate_date,5,2);
	$reupdateday=substr($reupdate_date,8,2);
	$reupdate_date2 = ($reupdateyear.$reupdatemonth.$reupdateday."000000");
	$reupdate_date1=gregoriantojd($reupdatemonth, $reupdateday, $reupdateyear);   
	$daysdiff1 = $end_date - $reupdate_date1 + 1;
	
	$BankResult4=mysql_query("SELECT * FROM `sp_bank` where id=$bank_id10");          // query executed 
	$fq_Cash = 0;
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($fq_OnHand = mysql_fetch_array($BankResult4)) {
		if($fq_OnHand['balance'] == '') $fq_Cash = 0;
		else $fq_Cash = $e->new_decode("$fq_OnHand[balance]");
	}		
	$ToBankResult4=mysql_query("SELECT * from sp_bank where id=$to_bank_id10 limit 1 ");
	$fq_Cash_to = 0;
	echo mysql_error();
	while($GetToBank4 = mysql_fetch_array($ToBankResult4)) {						
		if($GetToBank4['balance'] == '') $fq_Cash_to = 0;
		else $fq_Cash_to = $e->new_decode("$GetToBank4[balance]");
	}
	$queryMonthly=mysql_query("SELECT * from sp_monthly where user_id=$user_id order by reset_date desc limit 1 ");
	echo mysql_error();
	while($CurrResult = mysql_fetch_array($queryMonthly)) {
		$fq_income2 = 0;
		$fq_expenses3 = 0;
		if($category_id10 == 1) {	
			$fq_income2 = $e->new_decode("$CurrResult[monthly_income]");
			$fq_income3 = $fq_income2 + $amount10;
			$fq_income4 = $e->new_encode("$fq_income3");
		}
		else {
			$fq_expenses3 = $e->new_decode("$CurrResult[monthly_expenese]");
			$fq_expenses4 = $fq_expenses3 + $amount10;
			$fq_expenses5 = $e->new_encode("$fq_expenses4");
		}
	}
	$month3=date('m');
	$year3=date('Y');
	$MonthlyDetail3=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id10 and item_id=$item_id10 and month=$month3 and year=$year3 limit 1");
	echo mysql_error();
	if (mysql_num_rows($MonthlyDetail3) != 0) {
		while($Row = mysql_fetch_array($MonthlyDetail3)) {
			$fq_Monthly_id = $Row['id'];
			$fq_expenses6 = $e->new_decode("$Row[expenses]");
			$fq_expenses7 = $fq_expenses6 + $amount10;
			$fq_expenses8 = $e->new_encode("$fq_expenses7");
		}
	}
	else {
		mysql_query("INSERT INTO sp_monthly_detail(user_id,category_id,item_id,expenses,month,year) VALUES($user_id,$category_id10,$item_id10,'$zero',$month3,$year3)");
		$MonthlyDetail4=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id10 and item_id=$item_id10 and month=$month3 and year=$year3 limit 1");
		echo mysql_error();
		while($Row1 = mysql_fetch_array($MonthlyDetail4)) {
			$fq_Monthly_id = $Row1['id'];
		}
		$fq_expenses6 = 0;
		$fq_expenses7 = $amount10;
		$fq_expenses8 = $e->new_encode("$fq_expenses7");
	}	
	$fq_CashOnHand = 0;
	$fq_CashOnHand_to = 0;
	$fq_adjustment = 0;
	$fq_adjustment_neg = 0;
	$fq_amount_tot = $fq_income2;
	$fq_expenses_tot = $fq_expenses3;
	if($ResultRow['frequency_id'] == 2) {	/* Daily */
		for ($i = 1; $i <= $daysdiff1; $i++) {
			if($category_id10==1 && $item_id10 != 77) {
				$fq_CashOnHand = $fq_Cash + $fq_amount10;
				$fq_CashOnHand_to = 0;
			}
			else {
				$fq_CashOnHand = $fq_Cash - $fq_amount10;
				$fq_CashOnHand_to = $fq_Cash_to + $fq_amount10;
			}
			if($item_id10 != 77) {
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
			}
			else {
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10_neg',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$to_bank_id10,1)");
			}
			$fq_adjustment = $fq_adjustment + $fq_amount10;
			$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount10;
			$fq_amount_tot = $fq_amount_tot + $fq_amount10;
			$fq_expenses_tot = $fq_expenses_tot + $fq_amount10;
			$fq_expenses6 = $fq_expenses6 + $fq_amount10;
		}
		echo mysql_error();
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id10==1) {
			if($item_id10 != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id10 != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id10 == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$optionCategory[$category_id10]=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id10");
			if($item_id10 == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id10");
			if($item_id10 != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id10 == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id10,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}
		}
		
		$newdate = strtotime ( "+$daysdiff1 day" , strtotime ( $reupdate_date2 ) ) ;
		$activated = date ( 'Y-m-d' , $newdate );
		mysql_query("update item_frequency set activated = '$activated' where id=$item_curr_id order by id limit 1");
		echo mysql_error(); 
	}
	else if ($ResultRow['frequency_id'] == 3) {		/* Weekly */
		$j = 0;
		for ($i = 1; $i <= $daysdiff1; $i=$i+7) {
			if($category_id10==1 && $item_id10 != 77) {
				$fq_CashOnHand = $fq_Cash + $fq_amount10;
				$fq_CashOnHand_to = 0;
			}
			else {
				$fq_CashOnHand = $fq_Cash - $fq_amount10;
				$fq_CashOnHand_to = $fq_Cash_to + $fq_amount10;
			}		
			if($item_id10 != 77) {
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
			}
			else {
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10_neg',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$to_bank_id10,1)");
			}		
			$j++;
			$fq_adjustment = $fq_adjustment + $fq_amount10;
			$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount10;
			$fq_amount_tot = $fq_amount_tot + $fq_amount10;
			$fq_expenses_tot = $fq_expenses_tot + $fq_amount10;
			$fq_expenses6 = $fq_expenses6 + $fq_amount10;
		}
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id10==1) {
			if($item_id10 != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id10 != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id10 == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$optionCategory[$category_id10]=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id10");
			if($item_id10 == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id10");
			if($item_id10 != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id10 == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id10,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}
		$adday = $j * 7;
		$newdate = strtotime ( "+$adday day" , strtotime ( $reupdate_date2 ) ) ;
		$activated = date ( 'Y-m-d' , $newdate );
		mysql_query("update item_frequency set activated = '$activated' where id=$item_curr_id order by id limit 1");
		echo mysql_error(); 
	}
	else if ($ResultRow['frequency_id'] == 4) {  /* Bi-Weekly */
		$j = 0;
		for ($i = 1; $i <= $daysdiff1; $i=$i+14) {
			if($category_id10==1 && $item_id10 != 77) {
				$fq_CashOnHand = $fq_Cash + $fq_amount10;
				$fq_CashOnHand_to = 0;
			}
			else {
				$fq_CashOnHand = $fq_Cash - $fq_amount10;
				$fq_CashOnHand_to = $fq_Cash_to + $fq_amount10;
			}		
			if($item_id10 != 77) {
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
			}
			else {
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10_neg',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
				mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$to_bank_id10,1)");
			}
			$j++;
			$fq_adjustment = $fq_adjustment + $fq_amount10;
			$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount10;
			$fq_amount_tot = $fq_amount_tot + $fq_amount10;
			$fq_expenses_tot = $fq_expenses_tot + $fq_amount10;
			$fq_expenses6 = $fq_expenses6 + $fq_amount10;
		}
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id10==1) {
			if($item_id10 != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id10 != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id10 == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$optionCategory[$category_id10]=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id10");
			if($item_id10 == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id10");
			if($item_id10 != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id10 == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id10,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}
		$adday = $j * 14;			
		$newdate = strtotime ( "+$adday day" , strtotime ( $reupdate_date2 ) ) ;
		$activated = date ( 'Y-m-d' , $newdate );
		mysql_query("update item_frequency set activated = '$activated' where id=$item_curr_id order by id limit 1");
		echo mysql_error(); 
	}
	else if ($ResultRow['frequency_id'] == 5) {	/* Monthly */
		if($category_id10==1 && $item_id10 != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount10;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount10;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount10;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount10;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount10;
		if($item_id10 != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10_neg',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$to_bank_id10,1)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount10;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount10;
		$fq_expenses6 = $fq_expenses6 + $fq_amount10;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id10==1) {
			if($item_id10 != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id10 != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id10 == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$optionCategory[$category_id10]=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id10");
			if($item_id10 == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id10");
			if($item_id10 != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id10 == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id10,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}
		$newdate = strtotime ( "+1 month" , strtotime ( $reupdate_date2 ) ) ;
		$activated = date ( 'Y-m-d' , $newdate );
		if(date('d',$org_date) != date('d',$newdate)) $activated = date('Y-m-d', strtotime('last day of next month', strtotime ($reupdate_date)));
		mysql_query("update item_frequency set activated = '$activated' where id=$item_curr_id order by id limit 1");
		echo mysql_error(); 
	}
	else if ($ResultRow['frequency_id'] == 6) {	/* Quarterly */
		if($category_id10==1 && $item_id10 != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount10;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount10;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount10;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount10;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount10;
		if($item_id10 != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10_neg',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$to_bank_id10,1)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount10;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount10;
		$fq_expenses6 = $fq_expenses6 + $fq_amount10;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id10==1) {
			if($item_id10 != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id10 != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id10 == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$optionCategory[$category_id10]=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id10");
			if($item_id10 == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id10");
			if($item_id10 != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id10 == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id10,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}
		$newdate = strtotime ( "+3 month" , strtotime ( $reupdate_date2 ) ) ;
		$activated = date ( 'Y-m-d' , $newdate );
		mysql_query("update item_frequency set activated = '$activated' where id=$item_curr_id order by id limit 1");
		echo mysql_error(); 
	}
	else if ($ResultRow['frequency_id'] == 7) {	/* Semi-Annually */
		if($category_id10==1 && $item_id10 != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount10;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount10;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount10;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount10;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount10;
		if($item_id10 != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10_neg',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$to_bank_id10,1)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount10;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount10;
		$fq_expenses6 = $fq_expenses6 + $fq_amount10;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id10==1) {
			if($item_id10 != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id10 != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id10 == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$optionCategory[$category_id10]=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id10");
			if($item_id10 == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id10");
			if($item_id10 != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id10 == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id10,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}
		$newdate = strtotime ( "+6 month" , strtotime ( $reupdate_date2 ) ) ;
		$activated = date ( 'Y-m-d' , $newdate );
		mysql_query("update item_frequency set activated = '$activated' where id=$item_curr_id order by id limit 1");
		echo mysql_error(); 
	}
	else if ($ResultRow['frequency_id'] == 8) {	/* Yearly */
		if($category_id10==1 && $item_id10 != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount10;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount10;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount10;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount10;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount10;
		if($item_id10 != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10_neg',NOW(),$spender_id10,$type_id10,$bank_id10,1)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id10,$item_id10,'$amount10',NOW(),$spender_id10,$type_id10,$to_bank_id10,1)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount10;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount10;
		$fq_expenses6 = $fq_expenses6 + $fq_amount10;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id10==1) {
			if($item_id10 != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id10 != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id10 == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id10");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$optionCategory[$category_id10]=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id10");
			if($item_id10 == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id10");
			if($item_id10 != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id10 == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id10,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id10,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}
		$newdate = strtotime ( "+1 year" , strtotime ( $reupdate_date2 ) ) ;
		$activated = date ( 'Y-m-d' , $newdate );
		mysql_query("update item_frequency set activated = '$activated' where id=$item_curr_id order by id limit 1");
		echo mysql_error(); 
	}
}

$SpenderResult=mysql_query("SELECT * FROM `spender` where user_id = $user_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option = mysql_fetch_array($SpenderResult)) {
	$optionSpender["$option[id]"] = $option['name'];
}
$TypeResult=mysql_query("SELECT * FROM `sp_payment_type` where (user_id = $user_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option6 = mysql_fetch_array($TypeResult)) {
	$optionType["$option6[id]"] = $option6['Type'];
}

$frequencyResult=mysql_query("SELECT * FROM `sp_frequency` where (user_id = $user_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option8 = mysql_fetch_array($frequencyResult)) {
	$optionfrequency["$option8[id]"] = $option8['frequency'];
}

$CommentResult=mysql_query("SELECT * FROM `sp_comment` where category_id = 7 and item_id = 1 order by item_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option3 = mysql_fetch_array($CommentResult)) {
	$optionComment["$option3[id]"] = $option3['comment'];
}
if($action=='Save') {
	$queryMonthly=mysql_query("SELECT * from sp_monthly where user_id=$user_id order by reset_date desc limit 1 ");
	echo mysql_error();
	while($CurrResult = mysql_fetch_array($queryMonthly)) {
		if($category_id == 1) {	
			$income2 = $e->new_decode("$CurrResult[monthly_income]");
			if($item_id == 77)	$income3 = $income2; else $income3 = $income2 + $amount;
			$income4 = $e->new_encode("$income3");
		}
		else {
			$expenses3 = $e->new_decode("$CurrResult[monthly_expenese]");
			$expenses4 = $expenses3 + $amount;
			$expenses5 = $e->new_encode("$expenses4");
		}
	}
	$month1=date('m');
	$year1=date('Y');
	$MonthlyDetail=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id and item_id=$item_id and month=$month1 and year=$year1 limit 1");
	echo mysql_error();
	if (mysql_num_rows($MonthlyDetail) != 0) {
		while($Row = mysql_fetch_array($MonthlyDetail)) {
			$Monthly_curr_id = $Row['id'];
			$expenses6 = $e->new_decode("$Row[expenses]");
			$expenses7 = $expenses6 + $amount;
			$expenses8 = $e->new_encode("$expenses7");
		}
	}
	else {
		mysql_query("INSERT INTO sp_monthly_detail(user_id,category_id,item_id,expenses,month,year) VALUES($user_id,$category_id,$item_id,'$zero',$month1,$year1)");
		$MonthlyDetail2=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id and item_id=$item_id and month=$month1 and year=$year1 limit 1");
		echo mysql_error();
		while($Row1 = mysql_fetch_array($MonthlyDetail2)) {
			$Monthly_curr_id = $Row1['id'];
		}
		$expenses7 = $amount;
		$expenses8 = $e->new_encode("$expenses7");
		
	}
	$BankResult2=mysql_query("SELECT * FROM `sp_bank` where id=$bank_id");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$paid = 0;
	while($OnHand = mysql_fetch_array($BankResult2)) {
		$paid = $OnHand['pay_now'];
		if($OnHand['balance'] == '') $Cash = 0;
		else $Cash = $e->new_decode("$OnHand[balance]");
		if($category_id == 1) {
			if($item_id!=77) {
				$CashOnHand = $Cash + $amount;
			}
			else {
				$CashOnHand = $Cash - $amount;
			}
		}
		else {
			$CashOnHand = $Cash - $amount;
		}
		$balance1 = $e->new_encode("$CashOnHand");
//		if($frequency_id == 1 && $type_id == 1) mysql_query("update sp_bank set balance = '$balance1' where id=$bank_id");
//		echo mysql_error();  
	}
	if($category_id == 1) $paid=1;
	$queryBank1=mysql_query("SELECT * from sp_bank where id=$to_bank limit 1 ");
	echo mysql_error();
	while($GetBank1 = mysql_fetch_array($queryBank1)) {						
		$balance7 = $e->new_decode("$GetBank1[balance]");
		$balance8 = $balance7 + $amount;
		$balance9 = $e->new_encode("$balance8");						
	}
	$ItemResult=mysql_query("SELECT * FROM `category_item` where category_id = $category_id and (user_id = $user_id or user_id = 0) order by category_id,id");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($option2 = mysql_fetch_array($ItemResult)) {
		$optionItem["$option2[id]"] = $option2['category_item'];
	}					
	$description2 = "$optionCategory[$category_id]=>$optionItem[$item_id]";
	
	if($frequency_id == 1) {
		if($type_id == 1) { 
			$paid=1;
			mysql_query("update sp_bank set balance = '$balance1' where id=$bank_id limit 1");
			echo mysql_error();
		}
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses',NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses_neg',NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses',NOW(),$spender_id,$type_id,$to_bank,$paid)");
		}
		if($category_id == 1) {
			if($type_id==1) {
					if($item_id != 77) {
						mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$expenses','$balance1','$description2')");
					}
					else {  
						mysql_query("update sp_bank set balance = '$balance9' where id=$to_bank limit 1");
						mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$expenses_neg','$balance1','$description2')");
						mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank,'$expenses','$balance9','$description2')");
					}
			}
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$income4' where user_id=$user_id order by reset_date desc limit 1");
			echo mysql_error();
			if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$expenses8' where id=$Monthly_curr_id order by id limit 1");
			echo mysql_error();			
		}
		else {
			if($type_id == 1) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$expenses_neg','$balance1','$description2')");
			}
			mysql_query("update sp_monthly set monthly_expenese = '$expenses5' where user_id=$user_id order by reset_date desc limit 1");
			echo mysql_error();
			mysql_query("update sp_monthly_detail set expenses = '$expenses8' where id=$Monthly_curr_id order by id limit 1");
			echo mysql_error();			
		}
	}
	else if($frequency_id == 9) {
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses',$start_date,$start_date,$spender_id,$type_id,$bank_id,4)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses_neg',$start_date,$start_date,$spender_id,$type_id,$bank_id,4)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses',$start_date,$start_date,$spender_id,$type_id,$to_bank,4)");
		}
		if($category_id == 1) {
			if($type_id==1) {
					if($item_id != 77) {
						mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$expenses','$balance2','$description2')");
					}
					else {  
						mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$expenses_neg','$balance1','$description2')");
						mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank,'$expenses','$balance9','$description2')");
					}
			}
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$income4' where user_id=$user_id order by reset_date desc limit 1");
			echo mysql_error();
			if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$expenses8' where id=$Monthly_curr_id order by id limit 1");
			echo mysql_error();			
		}
		else {
			if($type_id == 1) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$expenses_neg','$balance1','$description2')");
			}
			mysql_query("update sp_monthly set monthly_expenese = '$expenses5' where user_id=$user_id order by reset_date desc limit 1");
			echo mysql_error();
			mysql_query("update sp_monthly_detail set expenses = '$expenses8' where id=$Monthly_curr_id order by id limit 1");
			echo mysql_error();			
		}	
	}
	else {
		if($frequency_id == 2) {
			$newdate = strtotime ( "+1 day" , strtotime ( $start_date ) ) ;
			$activated2 = date('Y-m-d',$newdate);
		}
		else if ($frequency_id == 3) {
			$newdate = strtotime ( "+7 day" , strtotime ( $start_date ) ) ;
			$activated2 = date('Y-m-d',$newdate);
		}
		else if ($frequency_id == 4) {
			$newdate = strtotime ( "+14 day" , strtotime ( $start_date ) ) ;
			$activated2 = date('Y-m-d',$newdate);
		}
		else if ($frequency_id == 5) {
			$newdate = strtotime ( "+1 month" , strtotime ( $start_date ) ) ;
			$activated2 = date('Y-m-d',$newdate);
		}
		else if ($frequency_id == 6) {
			$newdate = strtotime ( "+3 month" , strtotime ( $start_date ) ) ;
			$activated2 = date('Y-m-d',$newdate);
		}
		else if ($frequency_id == 7) {
			$newdate = strtotime ( "+6 month" , strtotime ( $start_date ) ) ;
			$activated2 = date('Y-m-d',$newdate);
		}
		else if ($frequency_id == 8) {
			$newdate = strtotime ( "+1 year" , strtotime ( $start_date ) ) ;
			$activated2 = date('Y-m-d',$newdate);
		}
		$vRes = mysql_query("SELECT * FROM `item_frequency` where user_id=$user_id and spender_id = $spender_id and item_id = $item_id and frequency_id = $frequency_id and activated = '$activated2' limit 1");
		if (mysql_num_rows($vRes) != 0) $ErrorMessage = "Duplicated record existed! insert canceled!";	
		else {
			if($daysdiff == 0) {
				mysql_query("update sp_bank set balance = '$balance1' where id=$bank_id limit 1");
				if($item_id != 77) {
					mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,1)");
					if($item_id != 77)	mysql_query("INSERT INTO item_frequency(user_id,spender_id,category_id,item_id,frequency_id,amount,start_date,activated,type_id,bank_id) VALUES($user_id,$spender_id,$category_id,$item_id,$frequency_id,'$expenses',$start_date,'$activated2',$type_id,$bank_id)");
					if($frequency_id != 1) mysql_query("update sp_monthly_detail set expenses = '$expenses8' where id=$Monthly_curr_id order by id limit 1");
				}
				else {
					mysql_query("update sp_bank set balance = '$balance9' where id=$to_bank limit 1");
					mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,1)");
					mysql_query("INSERT INTO spending(user_id,category_id,item_id,comment_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,$comment_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank,1)");
					mysql_query("INSERT INTO item_frequency(user_id,spender_id,category_id,item_id,frequency_id,amount,start_date,activated,type_id,bank_id,to_bank_id) VALUES($user_id,$spender_id,$category_id,$item_id,$frequency_id,'$expenses',$start_date,'$activated2',$type_id,$bank_id,$to_bank)");
				}
				if($category_id == 1) {	
					if($frequency_id != 1 && $item_id != 77) mysql_query("update sp_monthly set monthly_income = '$income4' where user_id=$user_id order by reset_date desc limit 1");
					echo mysql_error();
					if($type_id==1) {
						if($item_id != 77) mysql_query("update sp_bank set balance = '$balance2' where id=$bank_id limit 1");
						else {  
							mysql_query("update sp_bank set balance = '$balance1' where id=$bank_id limit 1");
							mysql_query("update sp_bank set balance = '$balance9' where id=$to_bank limit 1");
						}
					}
				}
				else {
					if($frequency_id != 1) mysql_query("update sp_monthly set monthly_expenese = '$expenses5' where user_id=$user_id order by reset_date desc limit 1");
					echo mysql_error();
				}
			}
			else {
				if($item_id != 77)	mysql_query("INSERT INTO item_frequency(user_id,spender_id,category_id,item_id,frequency_id,amount,start_date,activated,type_id,bank_id) VALUES($user_id,$spender_id,$category_id,$item_id,$frequency_id,'$expenses',$start_date,$start_date,$type_id,$bank_id)");
				else mysql_query("INSERT INTO item_frequency(user_id,spender_id,category_id,item_id,frequency_id,amount,start_date,activated,type_id,bank_id,to_bank_id) VALUES($user_id,$spender_id,$category_id,$item_id,$frequency_id,'$expenses',$start_date,$start_date,$type_id,$bank_id,$to_bank)");
			}
		}
	}
}
$BankResult=mysql_query("SELECT * FROM `sp_bank` where user_id = $user_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option7 = mysql_fetch_array($BankResult)) {
	$optionBank["$option7[id]"] = $option7['bank'];
}
if($action == 'yearly') {
	$fmdate = $yearly."0101000000";
	$newdate = strtotime ( "+1 year" , strtotime ( $fmdate ) ) ;
	$newdate = strtotime ( "-1 day" , $newdate) ;
	$todate = date ( 'Ymd' , $newdate )."000000";
}
else {
	$fmdate = "$year_month"."01000000";
	$yearly = (int)substr($year_month,0,4);
	$dispmonth = (int)substr($year_month,4,2);
	$newdate = strtotime ( "+1 month" , strtotime ( $fmdate ) ) ;
	$newdate = strtotime ( "-1 day" , $newdate) ;
	$todate = date ( 'Ymd' , $newdate )."000000";
}
$paid_date = date ('Y-m-d');

$DoBalanceResult=mysql_query("SELECT * FROM spending where user_id=$user_id and paid_date <= '$paid_date' and paid=4 order by id");          // query executed 
echo mysql_error();
while($BRow = mysql_fetch_array($DoBalanceResult)) {
	$id11 = $BRow['id'];
	$bank_id11 = $BRow['bank_id'];
	$category_id11 = $BRow['category_id'];
	$item_id11 = $BRow['item_id'];
	$amount11 = $e->new_decode("$BRow[expenses]");
	$BankResult3=mysql_query("SELECT * FROM `sp_bank` where id=$bank_id11");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($OnHand1 = mysql_fetch_array($BankResult3)) {
		if($OnHand1['balance'] == '') $Cash1 = 0;
		else $Cash1 = $e->new_decode("$OnHand1[balance]");
		$CashOnHand1 = $Cash1 - $amount11;
		$balance11 = $e->new_encode("$CashOnHand1");
	}
	mysql_query("update sp_bank set balance = '$balance11' where id=$bank_id11 limit 1");	
	mysql_query("update spending set paid = 1 where id=$id11 limit 1");
}
$queryMonth="SELECT * FROM spending where user_id=$user_id and date between $fmdate and $todate order by date desc, id desc";  // query string stored in a variable
$RangResult=mysql_query($queryMonth);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
foreach($optionCategory as $category_id2=>$category) {
	if($action == 'yearly') $querySpending=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id2 and year=$yearly order by category_id,item_id");
	else $querySpending=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id2 and month=$dispmonth and year=$yearly order by category_id,item_id");
	echo mysql_error();
	$categoryTotal["$category_id2"] = 0;
	while($TotalResult = mysql_fetch_array($querySpending)) {
		$expenses2 = $e->new_decode("$TotalResult[expenses]");
		$item_id4 = $TotalResult['item_id'];
		$categoryTotal["$category_id2"] += $expenses2;
		if(!isset($itemTotal["$category_id2"]["$item_id4"])) $itemTotal["$category_id2"]["$item_id4"] = 0;
		$itemTotal["$category_id2"]["$item_id4"] += $expenses2;
	}  
}
$getitem_frequency=mysql_query("SELECT * FROM `item_frequency` where user_id = $user_id");
echo mysql_error(); 	
while($option9 = mysql_fetch_array($getitem_frequency)) {
	$frequency_id9 = $option9['frequency_id'];
	$spender_id9 = $option9['spender_id'];
	$id9 = $option9['id'];
	$amount9 = $e->new_decode("$option9[amount]");
	$date9 = substr($option9['start_date'],0,10);
	$category_id9 = $option9['category_id'];
	$bank_id9 = $option9['bank_id'];
	$get_category_item=mysql_query("SELECT * FROM `category_item` where (user_id = $user_id or user_id = 0) and id= $option9[item_id] limit 1");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($itemResult9 = mysql_fetch_array($get_category_item)) {
		$category_item9 = $itemResult9['category_item'];
	}		
	$disp9 = "$optionSpender[$spender_id9]($optionCategory[$category_id9]=>$category_item9) \$$amount9 will recorded $optionfrequency[$frequency_id9] starting at $date9=>$optionBank[$bank_id9].";
	$optionPayFrq["$id9"] = $disp9;
}
$monthlyResult="SELECT * FROM sp_monthly where user_id = $user_id order by reset_date";  // query string stored in a variable
$getMonthlyResult=mysql_query($monthlyResult);          // query executed 
echo mysql_error();  
$Income = '';
$Expenese = '';
while($monthly=mysql_fetch_array($getMonthlyResult)){
	$month = substr($monthly['reset_date'],5,2);
	$year = substr($monthly['reset_date'],0,4);
	if($month == 1){
		$month = 12;
		$year = $year - 1; 
	}
	else {
	 $month = $month - 1;
	} 
	$year_month2 = $year.str_pad($month, 2, "0", STR_PAD_LEFT);
	$spender_id3 = $monthly['id'];
	$monthly_income = $e->new_decode("$monthly[monthly_income]");
	$monthly_expenese = $e->new_decode("$monthly[monthly_expenese]");
	if($year_month=="$year_month2") $Income = "<option value='$year_month2' selected>$month_array[$month]=>\$$monthly_income</option>$Income";
	else $Income = "<option value='$year_month2'>$month_array[$month]=>\$$monthly_income</option>$Income";
	if($year_month=="$year_month2") $Expenese = "<option value='$year_month2' selected>$month_array[$month]=>\$$monthly_expenese</option>$Expenese";
	else $Expenese = "<option value='$year_month2'>$month_array[$month]=>\$$monthly_expenese</option>$Expenese";
}
$queryBalance = mysql_query("SELECT * FROM `sp_bank` where id = $bank_id order by id desc limit 1");
while($balanceResult = mysql_fetch_array($queryBalance)) {
	if($balanceResult['balance'] == '') $balance = 0; else $balance = $e->new_decode("$balanceResult[balance]");
}	
?>
<table width="100%" style="font-size:25px;">
	<tr>
		<td colspan="7" align="center"><font color="red"><b id="ErrorMessage"><?php echo "$ErrorMessage"; ?></b></font></td>
	</tr>
	<tr>
		<td align="right" colspan="2"><font id="bank_desc">Will Pay From</font></td>
		<td width="60"><input type="image" src="../images/add.png" name="AddBank" value="Add Bank" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Bank',7);return false;">	</td>
		<td align="left">
		<select name="bank_id" id="bank_id" style="font-size:25px;width:200px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(5);">
		<?php
			foreach($optionBank as $id=>$bank) {
				if($id==$bank_id) echo "<option value='$id' selected>$bank</option>";
				else echo "<option value='$id'>$bank</option>";
			}
		?>
		</select>
		<font id="balance" style="font-size:25px;width:50px;border-color:#5050FF;border-width: 3px;"><?php echo "\$$balance"; ?></font>
		</td>
		<td width="60"></td>
		<td width="60"><font id="to_bank_label" style="display:none;">TO:</font></td>
		<td align="left">
		<select name="to_bank" id="to_bank" style="font-size:20px;width:250px;border-color:#5050FF;border-width: 3px;display:none;">
		<?php
			foreach($optionBank as $id=>$bank) {
				echo "<option value='$id'>$bank</option>";
			}
		?>
		</select>			
		</td>		
	</tr>	
	<tr>
		<td align="right" width="150">Information</td>
		<td width="60"><input type="image" src="../images/delete.jpg" name="DeleteAutoRec" value="Delete Auto Recording" width="55px" onclick="if(document.getElementById('item_frequency_id').value) {RemovePayFrq();return false;}" style="position:relative;top:5px;"></td>
		<td width="60"><input type="image" src="../images/modify.png" name="AddAutoRec" value="Modify Auto Recording" width="50px"  onclick="if(document.getElementById('item_frequency_id').value) {SetVisibleDiv('none');	var field1 = document.getElementById('item_frequency_id');var index1 = field1.selectedIndex; var infor = field1.options[index1].text;SetDialog(infor,8);return false;}">	</td>
		<td align="left" colspan="4">
		<select name="item_frequency_id" id="item_frequency_id" class="wide" style="font-size:20px;border-color:#5050FF;border-width: 3px;">
		<?php
			if(isset($optionPayFrq)) {
				foreach($optionPayFrq as $id=>$disp) {
					echo "<option value='$id'>$disp</option>";
				}
			}
		?>
		</select>
		</td>
	</tr>
</table>
<font style='font-size:25px;'>Income:</font>
<select name='MonthlyIncome' id='MonthlyIncome' style='font-size:25px;border-color:#5050FF;border-style: solid;border-width: 3px;' onChange="document.getElementById('MonthlyExpenese').value = this.value;Action('Disp');">
<?php echo $Income ?>
</select>
<font style='font-size:25px;'>Expenese:</font>
<select name='MonthlyExpenese' id='MonthlyExpenese' style='font-size:25px;border-color:#5050FF;border-style: solid;border-width: 3px;' onChange="document.getElementById('MonthlyIncome').value = this.value;Action('Disp');">
<?php echo $Expenese ?>
</select>
<font style='font-size:25px;'>Year:</font>
<select name='Yearly' id='Yearly' style='font-size:25px;border-color:#5050FF;border-style: solid;border-width: 3px;' onChange="Action('yearly');">
<?php 
for($i=2011;$i<2111;$i++) {
if($yearly == $i) echo "<option value='$i' selected>$i</option>";
else echo "<option value='$i'>$i</option>";
}
?>
</select>
<table width="100%"  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
<tr>
<td>
</td>
</tr>
</table>
<table width="100%"  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<tr>
	<th style="font-size:25px;color:red;border-style: none;border-color:#0000ff;border-width: 3px;text-align:left;">
	<?php echo date('l jS \of F Y') ?>
	</th>	
	<th colspan="2" style="font-size:25px;color:red;border-style: none;border-color:#0000ff;border-width: 3px;text-align:left;" id="infor_title">
	Monthly Expenses information
	</th>	
	</tr>
	<tr>
	<th style="font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Category
	</th>	
	<th style="font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Detail
	</th>
	<th style="font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Total
	</th>	
	</tr>
	<?php	
	foreach($categoryTotal as $category_id4=>$total){
		if($total >0 && $category_id4 != 1) {
		echo"
		<tr>
		<td style='font-size:25px;border-style: solid;border-color:#5050FF;border-width: 3px;text-align:center;'>
		$optionCategory[$category_id4]
		</td>
		<td>
			<table width='100%' border='1'>";
			$Item_list = $itemTotal["$category_id4"];
			foreach($Item_list as $item_id5=>$Subtotal){
				$ItemResult4=mysql_query("SELECT * FROM `category_item` where category_id = $category_id4 and id = $item_id5 and (user_id = $user_id or user_id = 0) limit 1");          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				while($option4 = mysql_fetch_array($ItemResult4)) {
					$category_item2 = $option4['category_item'];
				}	
			echo "
			<tr>	
			<td  style='font-size:25px;border-color:#5050FF;border-width: 3px;color:blue;'>
			$category_item2
			</td>
			<td  style='font-size:25px;border-color:#5050FF;border-width: 3px;color:blue;text-align:right;'>
			$Subtotal
			</td>
			</tr>";
				}
			echo "
			</table>
		</td>
		<td style='font-size:25px;border-style: solid;border-color:#5050FF;border-width: 3px;text-align:center;'>
		$total
		</td>
		</tr>";
		}
	}
if($action != 'yearly')	{
echo <<<_END
<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
	<tr>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Date
	</th>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Category
	</th>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Description
	</th>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Amt
	</th>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Type
	</th>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Bank
	</th>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Who
	</th>
	<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	Com.
	</th>
	</tr>
_END;
	//$e = new endec();  
	while($nt=mysql_fetch_array($RangResult)){
		$type=substr($optionType[$nt['type_id']],0,4);
		$bankname=substr($optionBank[$nt['bank_id']],0,4);
		if($nt['category_id'] != 0) {
		$expenses2 = $e->new_decode("$nt[expenses]");
		$category3 = $optionCategory[$nt['category_id']];
		$ItemResult5=mysql_query("SELECT * FROM `category_item` where category_id = $nt[category_id] and id = $nt[item_id] and (user_id = $user_id or user_id = 0) limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($option5 = mysql_fetch_array($ItemResult5)) {
			$category_item3 = $option5['category_item'];
		}	
		
	//	$category_item3 = $optionItem[$nt['item_id']];
		$queryComment = mysql_query("SELECT * FROM `sp_comment` where id = $nt[comment_id] limit 1");
		echo mysql_error(); 
		$comment = '';
		while($GetComment = mysql_fetch_array($queryComment)) {
		$comment = $GetComment['comment'];
		}	
		$querySpender = mysql_query("SELECT * FROM `spender` where id = $nt[spender_id] limit 1");
		echo mysql_error(); 
		while($GetSpender = mysql_fetch_array($querySpender)) {
		$name = $GetSpender['name'];
		}	
	echo "
	<tr>
		<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>";
		echo @substr($nt[date],-5);
	echo "	
		</td>
		<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
		$category3
		</td>
		<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
		$category_item3
		</td>
		<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
		$expenses2
		</td>
		<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
		$type
		</td>
		<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
		$bankname
		</td>
		<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
		$name
		</td>
		<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
		$comment
		</td>
	</tr>
	";
	}
	}
	echo "</table>";
}	
unset($_REQUEST);
	?>
</body>
</html>
	