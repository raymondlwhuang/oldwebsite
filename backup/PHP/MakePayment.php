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
$user_id = (int)$_REQUEST['user_id'];
$reminder_id = (int)$_REQUEST['reminder_id'];
$fq_amount = (float)$_REQUEST['amount'];
$fq_amount_neg = $fq_amount * (-1);
$expenses = $e->new_encode("$fq_amount");
$expenses_neg = $e->new_encode("$fq_amount_neg");
$beforeInsert = mysql_query("SELECT * FROM `sp_reminder` where id=$reminder_id limit 1 ");
while($Row=mysql_fetch_array($beforeInsert)){
	$category_id=$Row['category_id'];
	$item_id=$Row['item_id'];
//	$expenses=$Row['amount'];
//	$fq_amount = $e->new_decode("$expenses");
	$spender_id=$Row['spender_id'];
	$type_id=$Row['type_id'];
	if($type_id==1) $paid=1; else $paid=2;
	$bank_id=$Row['bank_id'];
	$to_bank_id=$Row['to_bank_id'];
	$start_date=$Row['start_date'];
	$reupdate_date=$Row['activated'];
	$frequency_id=$Row['frequency_id'];
	$fmyear=substr($start_date,0,4);
	$fmmonth=substr($start_date,5,2);
	$fmday=substr($start_date,8,2);	
	$toyear = date("Y");	
	$tomonth = date("m");
	$today = date("d");
	$end_date=gregoriantojd($tomonth, $today, $toyear);	
	$reupdateyear=substr($reupdate_date,0,4);
	$reupdatemonth=substr($reupdate_date,5,2);
	$reupdateday=substr($reupdate_date,8,2);	
	$reupdate_date1=gregoriantojd($reupdatemonth, $reupdateday, $reupdateyear);
	$daysdiff1 = $end_date - $reupdate_date1 + 1;
	$month3=date('m');
	$year3=date('Y');
	$CategoryResult2=mysql_query("SELECT * FROM `spending_category` where id = $category_id limit 1");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($CategoryRow2 = mysql_fetch_array($CategoryResult2)) {
		$CategoryDesc=$CategoryRow2['category'];
	}	
	$queryMonthly=mysql_query("SELECT * from sp_monthly where user_id=$user_id order by reset_date desc limit 1 ");
	echo mysql_error();
	while($CurrResult = mysql_fetch_array($queryMonthly)) {
		$fq_income2 = 0;
		$fq_expenses3 = 0;
		if($category_id == 1) {	
			$fq_income2 = $e->new_decode("$CurrResult[monthly_income]");
		}
		else {
			$fq_expenses3 = $e->new_decode("$CurrResult[monthly_expenese]");
		}
	}

	$ToBankResult4=mysql_query("SELECT * from sp_bank where id=$to_bank_id limit 1 ");
	$fq_Cash_to = 0;
	echo mysql_error();
	while($GetToBank4 = mysql_fetch_array($ToBankResult4)) {						
		if($GetToBank4['balance'] == '') $fq_Cash_to = 0;
		else $fq_Cash_to = $e->new_decode("$GetToBank4[balance]");
	}

	$MonthlyDetail3=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id and item_id=$item_id and month=$month3 and year=$year3 limit 1");
	echo mysql_error();
	if (mysql_num_rows($MonthlyDetail3) != 0) {
		while($Row = mysql_fetch_array($MonthlyDetail3)) {
			$fq_Monthly_id = $Row['id'];
			$fq_expenses6 = $e->new_decode("$Row[expenses]");
		}
	}
	else {
		mysql_query("INSERT INTO sp_monthly_detail(user_id,category_id,item_id,expenses,month,year) VALUES($user_id,$category_id,$item_id,'$zero',$month3,$year3)");
		$MonthlyDetail4=mysql_query("SELECT * from sp_monthly_detail where user_id=$user_id and category_id=$category_id and item_id=$item_id and month=$month3 and year=$year3 limit 1");
		echo mysql_error();
		while($Row1 = mysql_fetch_array($MonthlyDetail4)) {
			$fq_Monthly_id = $Row1['id'];
		}
		$fq_expenses6 = 0;
	}
	
	$BankResult4=mysql_query("SELECT * FROM `sp_bank` where id=$bank_id");          // query executed 
	$fq_Cash = 0;
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($fq_OnHand = mysql_fetch_array($BankResult4)) {
		if($fq_OnHand['balance'] == '') $fq_Cash = 0;
		else $fq_Cash = $e->new_decode("$fq_OnHand[balance]");
	}
	$fq_CashOnHand = 0;
	$fq_CashOnHand_to = 0;
	$fq_adjustment = 0;
	$fq_adjustment_neg = 0;
	$fq_amount_tot = $fq_income2;
	$fq_expenses_tot = $fq_expenses3;
	/* not do multiple insert like HERDisp.php because this just a reminder and it may not need to insert every time */
	if($frequency_id==2) {
		if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;			
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}

			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}
		}		
		$newdate = strtotime ( "+1 day" , strtotime (date("Ymd")."000000")) ;
		$activated = date('Y-m-d', $newdate);
	}
	elseif($frequency_id==3) {
		for ($i = 1; $i <= $daysdiff1; $i=$i+7) {
			$j++;
		}
		if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}		
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}		
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;		
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}		
		$adday = $j * 7;
		$newdate = strtotime ( "+$adday day" , strtotime (date("Ymd")."000000")) ;
		$activated = date('Y-m-d', $newdate);
	}
	elseif($frequency_id==4) {
		$j = 0;
		for ($i = 1; $i <= $daysdiff1; $i=$i+14) {
			$j++;
		}
		if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}		
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;		
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}		
		$adday = $j * 14;
		$newdate = strtotime ( "+$adday day" , strtotime (date("Ymd")."000000")) ;
		$activated = date('Y-m-d', $newdate);
	}
	elseif($frequency_id==5) {
		if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}	
		$orgdate = strtotime ($start_date);
		$newdate = strtotime ( "+1 month" , strtotime ( $reupdate_date ) ) ;
		$last_activated_date = strtotime (date("Ymd")."000000");
		$activated = date('Y-m-d', $newdate);
		if(date('d',$orgdate) != date('d',$newdate)) $activated = date('Ymd', strtotime('last day of next month', $last_activated_date));
	}
	elseif($frequency_id==9) {
		if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}	
		$orgdate = strtotime ($start_date);
		$newdate = strtotime ( "+2 month" , strtotime ( $reupdate_date ) ) ;
		$newdate2 = strtotime ( "+1 month" , strtotime ( $reupdate_date ) ) ;
		$last_activated_date = strtotime (date("Ymd")."000000");
		$activated = date('Y-m-d', $newdate);
		if(date('d',$orgdate) != date('d',$newdate)) $activated = date('Ymd', strtotime('last day of next month', $newdate2));
	}
	elseif($frequency_id==6) {
		if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}	
		$last_activated_date = strtotime (date("Ymd")."000000");
		$newdate = strtotime ( "+3 month" , $last_activated_date ) ;
		$activated = date('Y-m-d', $newdate);
	}
	elseif($frequency_id==7) {
		if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}	
		$last_activated_date = strtotime (date("Ymd")."000000");
		$newdate = strtotime ( "+6 month" , $last_activated_date ) ;
		$activated = date('Y-m-d', $newdate);
	}
	elseif ($frequency_id == 8) {
	if($category_id==1 && $item_id != 77) {
			$fq_CashOnHand = $fq_Cash + $fq_amount;
			$fq_CashOnHand_to = 0;
		}
		else {
			$fq_CashOnHand = $fq_Cash - $fq_amount;
			$fq_CashOnHand_to = $fq_Cash_to + $fq_amount;
		}	
		$fq_adjustment = $fq_adjustment + $fq_amount;
		$fq_adjustment_neg = $fq_adjustment_neg - $fq_amount;
		if($item_id != 77) {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		}
		else {
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$$expenses_neg',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
			mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$to_bank_id,$paid)");
		}
		$fq_amount_tot = $fq_amount_tot + $fq_amount;
		$fq_expenses_tot = $fq_expenses_tot + $fq_amount;
		$fq_expenses6 = $fq_expenses6 + $fq_amount;
		$fq_income9 = $e->new_encode("$fq_amount_tot");
		$fq_expenses9 = $e->new_encode("$fq_expenses_tot");
		$fq_expenses_detail = $e->new_encode("$fq_expenses6");
		if($category_id==1) {
			if($item_id != 77) mysql_query("update sp_monthly set monthly_income = '$fq_income9' where user_id=$user_id order by reset_date desc limit 1");
		}
		else  mysql_query("update sp_monthly set monthly_expenese = '$fq_expenses9' where user_id=$user_id order by reset_date desc limit 1");
		if($item_id != 77) mysql_query("update sp_monthly_detail set expenses = '$fq_expenses_detail' where id=$fq_Monthly_id order by id limit 1");
		if($type_id == 1) {
			$fq_balance = $e->new_encode("$fq_CashOnHand");
			$fq_balance_to = $e->new_encode("$fq_CashOnHand_to");
			$fq_adjustment_tot = $e->new_encode("$fq_adjustment");
			$fq_adjustment_tot_neg = $e->new_encode("$fq_adjustment_neg");
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($itemRow = mysql_fetch_array($ItemResult1)) {
				$itemDesc = $itemRow['category_item'];
			}			
			$description = "$CategoryDesc=>$itemDesc";
			mysql_query("update sp_bank set balance = '$fq_balance' where id=$bank_id");
			if($item_id == 77) mysql_query("update sp_bank set balance = '$fq_balance_to' where id=$to_bank_id");
			if($item_id != 77) mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot','$fq_balance','$description')");
			if($item_id == 77) {
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$bank_id,'$fq_adjustment_tot_neg','fq_balance','$description')");
				mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,adjust_amount,balance,description) VALUES($user_id,$to_bank_id,'$fq_adjustment_tot','$fq_balance_to','$description')");
			}			
		}	
		mysql_query("INSERT INTO spending(user_id,category_id,item_id,expenses,date,paid_date,spender_id,type_id,bank_id,paid) VALUES($user_id,$category_id,$item_id,'$expenses',NOW(),NOW(),$spender_id,$type_id,$bank_id,$paid)");
		$last_activated_date = strtotime (date("Ymd")."000000");
		$newdate = strtotime ( "+1 year" , $last_activated_date ) ;
		$activated = date('Y-m-d', $newdate);
	}
	mysql_query("update sp_reminder set activated = '$activated' where id=$reminder_id limit 1");
	$queryResult3=mysql_query("SELECT * FROM sp_reminder where user_id=$user_id and  activated <= NOW()");
	if(mysql_num_rows($queryResult3)!=0) {
	echo "<table  width=\"100%\" style=\"border-style: solid;border-color:#0000ff;border-width: 3px;\">
	<tr>
	<th colspan='3' style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:center;'><font color=\"red\"><b>Reminder: It's time to make payment for the following items</b></font></th>
	</tr>";
	}
	while($typeResult3 = mysql_fetch_array($queryResult3)) {
		$reminder_id=$typeResult3['id'];
		echo "<tr>";
		$CategoryResult1=mysql_query("SELECT * FROM `spending_category` where id = $typeResult3[category_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($CategoryRow = mysql_fetch_array($CategoryResult1)) {
			echo "<td style='font-size:20px;border-style: solid;border-width: 3px;text-align:right;'>$CategoryRow[category]=>";
		}
		$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $typeResult3[item_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($ItemRow = mysql_fetch_array($ItemResult1)) {
			echo "$ItemRow[category_item] ";
		}	
		$TypeResult4=mysql_query("SELECT * FROM `sp_payment_type` where id = $typeResult3[type_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($TypeRow = mysql_fetch_array($TypeResult4)) {
			echo "with <font color=\"red\"><b>$TypeRow[Type]</b></font> ";
		}
		$BankResult1=mysql_query("SELECT * FROM `sp_bank` where id = $typeResult3[bank_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($BankRow = mysql_fetch_array($BankResult1)) {
			echo "pay from <font color=\"red\"><b>$BankRow[bank]</b></font>&nbsp;";
		}
		$BankResult2=mysql_query("SELECT * FROM `sp_bank` where id = $typeResult3[to_bank_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($BankRow = mysql_fetch_array($BankResult2)) {
			echo " to <font color=\"red\"><b>$BankRow[bank]</b></font> ";
		}
		$amount=$e->new_decode("$typeResult3[amount]");
		echo "with amount:</td><td width='80'><input type='text'  class='reminder_amount' id='amt$reminder_id' value='$amount' readonly=\"readonly\"  style='width:80px;font-size:25px;border-color:red;border-style: solid;border-width: 3px;text-align:center;color:red;font-weight:bold;'></td>";
		echo "<td style='border-style: solid;border-width: 3px;text-align:center;'>
		<input type='image' src='../images/paynow.png' height='30' name='$reminder_id' id='$reminder_id' onclick=\"make_payment($reminder_id,'amt$reminder_id');\"></td></tr>";
	}
	if(mysql_num_rows($queryResult3)!=0) echo "</table>";
	$todate1 = date('Ymd')."000000";
	$newdate1 = strtotime ( "-1 month" , strtotime ( $todate1 ) ) ;
	$fmdate1 = date ( 'Ymd' , $newdate1 )."000000";
	$queryResult1=mysql_query("SELECT * FROM spending where user_id=$user_id and  date <= $fmdate1 and paid <> 1 group by type_id");
	$Reminder='';
	while($typeResult1 = mysql_fetch_array($queryResult1)) {
		$queryResult2=mysql_query("SELECT * FROM sp_payment_type where (user_id=$user_id or user_id=0) and id= $typeResult1[type_id] limit 1");
		while($typeResult2 = mysql_fetch_array($queryResult2)) {
			$Reminder.="It's time to pay the overdue amount on your $typeResult2[Type] <br/>";
		}
	}
	if($Reminder!='') {
		echo "<font color=\"red\"><b>$Reminder</b></font>";
	}	
	mysql_close($link);
}




?>