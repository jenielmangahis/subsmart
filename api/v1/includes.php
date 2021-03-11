<?php
error_reporting(E_ERROR | E_PARSE);
include_once("includes/connection.inc.php");
include_once("includes/database.class.php");

define("SERVER", "localhost");
define("DB_NAME", "admintom_nsmart_companies");
define("DB_USER", "admintom_admin");
define("DB_PASSWORD", "SmarTrac1$!");

define("FIREBASE_API_KEY", "AAAA0yE6SAE:APA91bFQOOZnqWcMbdBY9ZfJfc0TWanlN1l6f95QfjpfMhVLWNfHVd63nlfxP69I_snCkaqaY9yuezx65GLyevUmkflRADYdYAZKPY8e8SS5Q_dyPDqQaxxlstamhhUG1BiFr4bC4ABo");

$connection = mysqli_connect(SERVER, DB_USER, DB_PASSWORD, DB_NAME);



// get insert query
function getInsertQuery($params, $tblname) {
	// retrieve the keys of the array (column titles)
	$fields = array_keys($params);

	// build the query
	$sql = "INSERT INTO ".$tblname."(`".implode('`,`', $fields)."`) VALUES('".implode("','", $params)."')";

	// return the query string
	return $sql;
}


// get dates between two dates
function getDatesFromRange($start, $end, $format = 'Y-m-d') {

    // Declare an empty array
    $array = array();

    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    // Use loop to store date into array
    foreach($period as $date) {
        $array[] = $date->format($format);
    }

    // Return the array elements
    return $array;
}


// convert minutes to $number or hours and minutes eg. 8h 30m
function formatDecimalTime($decimal) {

    // convert decimal to number minutes
    $numberOfMinutes = $decimal * 60;

    // convert minutes to $number or hours and minutes eg. 8h 30m
    $abbrevTime = "0m";
    // check
    if (floor((int)$decimal) > 0) {
        $abbrevTime = floor((int)$decimal) ."h ";
		$abbrevTime .= (floor((int)$numberOfMinutes % 60) > 0) ? floor((int)$numberOfMinutes % 60) . "m" : "";
    } else {
		$abbrevTime = floor((int)$numberOfMinutes % 60) . "m";
	}

    return $abbrevTime;
}


// cut a String to a specified length with php
function substrWords($text, $maxchar, $end = '...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            }
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    }
    else {
        $output = $text;
    }
    return $output;
}


// get difference of two dates
function getTimeDifference($date1, $date2) {
	$date1 = strtotime($date1);
	$date2 = strtotime($date2);

	// Formulate the Difference between two dates
	$diff = abs($date2 - $date1);


	// To get the year divide the resultant date into
	// total seconds in a year (365*60*60*24)
	$years = floor($diff / (365*60*60*24));


	// To get the month, subtract it with years and
	// divide the resultant date into
	// total seconds in a month (30*60*60*24)
	$months = floor(($diff - $years * 365*60*60*24)
	                               / (30*60*60*24));


	// To get the day, subtract it with years and
	// months and divide the resultant date into
	// total seconds in a days (60*60*24)
	$days = floor(($diff - $years * 365*60*60*24 -
	             $months*30*60*60*24)/ (60*60*24));


	// To get the hour, subtract it with years,
	// months & seconds and divide the resultant
	// date into total seconds in a hours (60*60)
	$hours = floor(($diff - $years * 365*60*60*24
	       - $months*30*60*60*24 - $days*60*60*24)
	                                   / (60*60));


	// To get the minutes, subtract it with years,
	// months, seconds and hours and divide the
	// resultant date into total seconds i.e. 60
	$minutes = floor(($diff - $years * 365*60*60*24
	         - $months*30*60*60*24 - $days*60*60*24
	                          - $hours*60*60)/ 60);


	// To get the minutes, subtract it with years,
	// months, seconds, hours and minutes
	$seconds = floor(($diff - $years * 365*60*60*24
	         - $months*30*60*60*24 - $days*60*60*24
	                - $hours*60*60 - $minutes*60));

	// Return
	return [$years, $months, $days, $hours, $minutes, $seconds];
}


// send push to android
function send_android_push($registrationIds, $body, $title) {

	$notification = array('body' 	=> $body,
						  'title'	=> $title,
					 	  'sound' 	=> 'default');

	$fields = array('registration_ids'	=> $registrationIds,
					'data'				=> $notification);


	$headers = array('Authorization: key=' . FIREBASE_API_KEY,
				     'Content-Type: application/json');


	//send curl
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ));
	$response = curl_exec($ch);
	curl_close($ch);
}


function send_ios_push($registrationIds, $title, $body) {

	$notification = array('title' 	=> $title ,
						  'body' 	=> $body,
						  'sound' 	=> 'default',
						  'badge' 	=> '1');

	// registration_ids for multipale tokens array
	$payload = array('registration_ids' => $registrationIds,
					 'notification' 	=> $notification,
					 'priority'			=> 'high');
	$json = json_encode($payload);


	$headers = array('Authorization: key=' . FIREBASE_API_KEY,
	 				 'Content-Type: application/json');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	curl_close($ch);
}

?>
