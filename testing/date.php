<?$date = date("Y-m-d");
echo $date;
echo "<br/>";

// $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
// $last_day_this_month  = date('Y-m-t');
$first_day_this_month = date('F 01,Y'); // hard-coded '01' for first day
$last_day_this_month  = date('F t,Y');

echo $first_day_this_month;
echo "<br/>";

echo $last_day_this_month;

?>