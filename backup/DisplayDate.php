<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Display today\'s date!</title>
</head>
<body>
     <div style="padding: 6px; background-color: rgb(112, 158, 207); color: rgb(255, 255, 255); font-size: 12px;" align="center">
					<script type="text/javascript">

									var d=new Date();
									var weekday=new Array(7);
									weekday[0]="Sunday";
									weekday[1]="Monday";
									weekday[2]="Tuesday";
									weekday[3]="Wednesday";
									weekday[4]="Thursday";
									weekday[5]="Friday";
									weekday[6]="Saturday";
									document.write("" + weekday[d.getDay()]);
					</script>,

					<script type="text/javascript">
					var month = new Array();
					month[0] = "January";month[1] = "February";month[2] = "March";month[3] = "April";month[4] = "May";
					month[5] = "June";month[6] = "July";month[7] = "August";month[8] = "September";month[9] = "October";month[10] = "November";
					month[11] = "December";
					//Array starting at 0 since javascript dates start at 0 instead of 1
					var mydate= new Date()
					mydate.setDate(mydate.getDate())
					document.write(""+month[mydate.getMonth()]+" "+mydate.getDate()+", "+mydate.getFullYear());

					</script>
	</div>
</body>
</html>