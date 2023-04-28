<?php

class GoogleCalendarApi
{
	public function getAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
		$url = 'https://accounts.google.com/o/oauth2/token';			
		
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve access token');
			
		return $data;
	}

	public function getToken($client_id, $redirect_uri, $client_secret, $refresh_token) {	
		$url = 'https://accounts.google.com/o/oauth2/token';			
		
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&refresh_token='. $refresh_token . '&grant_type=refresh_token';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve token');
			
		return $data;
	}

	public function getUserCalendarTimezone($access_token) {
		$url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_settings);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true); //echo '<pre>';print_r($data);echo '</pre>';
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get timezone');

		return $data['value'];
	}

	public function getCalendarsList($access_token) {
		$url_parameters = array();

		$url_parameters['fields'] = 'items(id,summary,timeZone)';
		$url_parameters['minAccessRole'] = 'owner';

		$url_calendars = 'https://www.googleapis.com/calendar/v3/users/me/calendarList?'. http_build_query($url_parameters);
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_calendars);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true); //echo '<pre>';print_r($data);echo '</pre>';
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get calendars list');

		return $data['items'];
	}

	public function createCalendarEvent($calendar_id, $summary, $all_day, $event_time, $event_timezone, $attendees, $location, $reminders, $description, $access_token) {
		$url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';

		$curlPost = array('summary' => $summary);
		if( !empty($attendees) ){
			$curlPost['attendees'] = $attendees;				
		}

		if( $location != '' ){
			$curlPost['location'] = $location;
		}

		if( $description != '' ){
			$curlPost['description'] = $description;	
		}

		if( !empty($reminders) ){
			$curlPost['reminders'] = $reminders;
		}

		if($all_day == 'FIXED-DATE') {
			$curlPost['start'] = array('date' => $event_time['start_date']);
			$curlPost['end'] = array('date' => $event_time['end_date']);			
		}
		else {
			$curlPost['start'] = array('dateTime' => $event_time['start_time'], 'timeZone' => $event_timezone);
			$curlPost['end'] = array('dateTime' => $event_time['end_time'], 'timeZone' => $event_timezone);
		}

		//$curlPost['colorId'] = 2;

		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_events);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		

		if($http_code != 200){
			$gevent_id = '';
		}else{
			$gevent_id = $data['id'];
		}

		return $gevent_id;
	}

	public function updateCalendarEvent($event_id, $calendar_id, $summary, $all_day, $event_time, $event_timezone, $attendees, $location, $reminders, $description, $access_token) {		
		$url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/' . $event_id;

		$curlPost = array('summary' => $summary);
		if( !empty($attendees) ){
			$curlPost['attendees'] = $attendees;				
		}

		if( $location != '' ){
			$curlPost['location'] = $location;
		}

		if( $description != '' ){
			$curlPost['description'] = $description;	
		}

		if( !empty($reminders) ){
			$curlPost['reminders'] = $reminders;
		}

		if($all_day == 'FIXED-DATE') {
			$curlPost['start'] = array('date' => $event_time['start_date']);
			$curlPost['end'] = array('date' => $event_time['end_date']);			
		}
		else {
			$curlPost['start'] = array('dateTime' => $event_time['start_time'], 'timeZone' => $event_timezone);
			$curlPost['end'] = array('dateTime' => $event_time['end_time'], 'timeZone' => $event_timezone);
		}

		//$curlPost['colorId'] = 2;

		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_events);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);					
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');				
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);	

		if($http_code != 200){
			$gevent_id = '';
		}else{
			$gevent_id = $data['id'];
		}

		return $gevent_id;
	}

	public function createCalendar($api_key, $access_token, $calendar_name) {
		$url_parameters = array();

		$url_parameters['key'] = $api_key;	
		$curlPost = array('summary' => $calendar_name, 'colorId' => 2);
		
		$url_calendars = 'https://www.googleapis.com/calendar/v3/calendars?'. http_build_query($url_parameters);		

		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_calendars);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);	
		if($http_code != 200) 
			throw new Exception('Error : Failed to get calendars list');

		return $data;
	}

	public function updateCalendar($color_id, $api_key, $access_token, $calendar_id) {
		$url_parameters = array();

		$url_parameters['key'] = $api_key;	
		$curlPost = array('colorId' => $color_id);
		
		$url_calendar = 'https://www.googleapis.com/calendar/v3/users/me/calendarList/' . $calendar_id . '?' . http_build_query($url_parameters);		

		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_calendar);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);	
		if($http_code != 200) 
			throw new Exception('Error : Failed to update calendar');

		return $data;
	}

	public function getColors($api_key, $access_token) {
		$url_parameters = array();

		$url_parameters['key'] = $api_key;
		
		$url_color = 'https://www.googleapis.com/calendar/v3/colors?' . http_build_query($url_parameters);	

		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_color);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true); //echo '<pre>';print_r($data);echo '</pre>';
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get colors');

		return $data;
	}
}

?>