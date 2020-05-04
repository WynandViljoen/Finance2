<html>
<head>

<script type="text/javascript" src="tablefilter_all_min.js"></script>

</head>

<style type="text/css" media="screen">

@import "filtergrid2.css";

body{ 
	margin:15px; padding:15px; border:1px solid #666;
	font-family:Arial, Helvetica, sans-serif; font-size:88%; 
}
h2{ margin-top: 50px; }
caption{ margin:10px 0 0 5px; padding:10px; text-align:left; }
pre{ font-size:13px; margin:5px; padding:5px; background-color:#f4f4f4; border:1px solid #ccc;  }
.mytable{
	width:100%; font-size:12px;
	border:1px solid #ccc;
}

div.tools{ margin:5px; }
div.tools input{ background-color:#f4f4f4; border:2px outset #f4f4f4; margin:2px; }

th{
	background-color:#7595e1; 
	border-bottom:1px solid #D0D0D0; border-right:1px solid #D0D0D0;
	border-left:1px solid #fff; border-top:1px solid #fff;
	padding:5px 5px 5px 5px; color:#333;
}

</style>

<?php
	include("header.html");
	include("dbcurrency.php");
	echo "<br><br><br>";

	echo "<div align=center>";
	echo "<br><b>List of All income transfers <a href=\"expenses.php\">(View Current Month only)</a> <br>";
	echo "</div>";

	$sql = "SELECT * FROM `txincome` ORDER BY `Date` DESC";
	echo "<table id=\"table2\" class=\"mytable\" border=1><th>Description</th><th>Date</th><th>Amount</th><th>Account</th><th>Income</th><th>Delete</th>";
	echo "<tr><td colspan=2>Total:</td><td align=right id=\"table2Tot1\" style=\"background-color:#FFFFCC;\"></td><td colspan=3></td></tr>";
	if ($result=mysqli_query($con,$sql))
	while ($row=mysqli_fetch_row($result))
	{
		$amount = $row['3'];
		$amount = number_format((float)$amount, 2, '.', '');	

		echo "<form method=\"post\" action=\"removeincometx.php\">";
		echo "<input type=\"hidden\" name=\"id\" value=\"" . $row['0'] . "\">";
		echo "<input type=\"hidden\" name=\"description\" value=\"" . $row['1'] . "\">";
		echo "<input type=\"hidden\" name=\"date\" value=\"" . $row['2'] . "\">";
		echo "<input type=\"hidden\" name=\"amount\" value=\"" . $row['3'] . "\">";
		echo "<input type=\"hidden\" name=\"account\" value=\"" . $row['4'] . "\">";		
		echo "<input type=\"hidden\" name=\"income\" value=\"" . $row['5'] . "\">";

		echo "<tr><td>" . $row['1'] . " </td><td> " . $row['2'] . " </td><td align=right> $currencysymbol " . $amount . " </td><td> " . $row['4'] . " </td><td> " . $row['5'] ."</td>";

		echo "<td align=center style=\"width:5%;\">";
		echo "<input type=\"submit\" name=\"delete\" value=\" \" style=\"background:url(delete.jpg) no-repeat;vertical-align:bottom;border: none;\"> </td></tr>";
		echo "</form>";	
	}
	echo "</table>";

?>

<script language="javascript" type="text/javascript">
//<![CDATA[
	var table2_Props = 	{ 
							rows_counter: true,  
		                    btn_reset: true,  
		                    loader: true,  
		                    loader_text: "Filtering data...", 
							col_3: "select", 							
							col_4: "select", 
							col_5: "none", 							
							display_all_text: " [ Show all ] ",
							sort_select: true, 
							alternate_rows: true,
							rows_counter_text: "Total rows: ", 
							col_operation: {  
                                id: ["table2Tot1"],  
                                col: [2],  
                                operation: ["sum"],  
                                write_method: ["innerHTML"],  
                                exclude_row: [2],  
                                decimal_precision: [2]  
                            },   
                    		rows_always_visible: [2]  
						};
var tf2 = 	setFilterGrid( "table2",table2_Props );
//]]>


</script>