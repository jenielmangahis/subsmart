<?php 

//Calendar Title use 'summary' in array index
//Id index will be used in getting certain calendar events

require_once 'Google/vendor/autoload.php';

$access_token = 'ya29.a0AfH6SMB_xVyhnZYP-NTEeNUO7SWrqUci8I9hG2KaRofgYZxJA9V7C0inBlUK1Ksjhibelz5t5lZc5ulPQYsG6wZn5lAA4WhT8Fb48bn9atejNM774Mk4e2Olj4IzACxHwdu_aITEjjG5zXAvKqp62USIJC3U6TMsu9M';
$google_client_id = '646859198620-ll9trm7obk2olgaoigae4s2hshpf3sle.apps.googleusercontent.com';
$refresh_token    = '1//0e0kWXAN8FeaoCgYIARAAGA4SNwF-L9IrN87dmaFL0U11DUpTQk_mP_7fGd_mZo8b4kTnA6_CTeBcUCICdRSO-4m0oRQOw6BX9dI';
$google_secrect   = '-plXDxYZRwx6c1ttmNXE5L2p';

//Set Client
$client = new Google_Client();
$client->setClientId($google_client_id);
$client->setClientSecret($google_secrect);
$client->setAccessToken($access_token);
$client->refreshToken($refresh_token);
$client->setScopes(array(
    'email',
    'profile',
    'https://www.googleapis.com/auth/calendar',
));
$client->setApprovalPrompt('force');
$client->setAccessType('offline');

//Request
$access_token = $client->getAccessToken();
$calendar     = new Google_Service_Calendar($client);
$data = $calendar->calendarList->listCalendarList();

//Calendar Data
echo "<pre>";
print_r($data);
exit;

?>