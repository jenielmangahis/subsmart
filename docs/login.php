<?php 

//Calendar Title use 'summary' in array index
//Id index will be used in getting certain calendar events

require_once 'Google/vendor/autoload.php';

$access_token = 'ya29.a0AfH6SMCZtne4w9uGkf62FKi1z2GrDcFcZCOvyJXB9VO5xkMvy0jvGtBFRG9vziEKDXpRNVvLGb9eCJSrP9AElBOIpTUEOE4d4eOYRE275bIMYaiUoRk90V3JrJS-IVD-HsSM2KlU7i5RT9653lttspS656Y-dAJ8O7Q'; //'ya29.a0AfH6SMCIyqk7FRpJtRGnEa-jHpNsIieWnh4n5KuI4Lfyf4RcxaFv8YFir4MrVd-E7yopV4RcKMlgwvDmrUWXXjiThZpnTeWBALqbZtHiFvlMMfxP3QwJCNZXriORicSjbakqKBZMRYkS2CSTq4a0q77ieMPxfTXi5ic';
$google_client_id = '646859198620-ll9trm7obk2olgaoigae4s2hshpf3sle.apps.googleusercontent.com';
$refresh_token    = '1//0eLXmgo8RaGXyCgYIARAAGA4SNwF-L9Ir8cHl0PK7jJwEa8sYUviQ7UAKxtu9BVe4jG0wiokEcfLcJVGjoscmASKLkDO0Z77uAkM';  //'1//0edCJ8GB0c2dfCgYIARAAGA4SNwF-L9Ir9sB5zvkjBKjQR_jH4VNysV42pIFWN1gSUUpP3_XjcsTmFWGx3RIUlkGGxiuc2coR-R0';
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




// Get the API client and construct the service object.
  $service = new Google_Service_Calendar($client);

  // Print the next 10 events on the user's calendar.
  $calendarId = 'primary';
  $optParams = array(
    'maxResults' => 10,
    'orderBy' => 'startTime',
    'singleEvents' => true,
    'timeMin' => date('c'),
  );
  $results = $service->events->listEvents($calendarId, $optParams);
  $events = $results->getItems();

  if (empty($events)) {
      print "No upcoming events found.\n";
  } else {
      print "Upcoming events:\n";
      foreach ($events as $event) {
          $start = $event->start->dateTime;
          if (empty($start)) {
              $start = $event->start->date;
          }
          printf("%s (%s)\n", $event->getSummary(), $start);
      }
  }



exit;

?>