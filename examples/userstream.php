<?php

/**
 * Very basic User Streams example. In production you would store the
 * received tweets in a queue or database for later processing.
 *
 * Although this example uses your user token/secret, you can use
 * the user token/secret of any user who has authorised your application.
 *
 * Instructions:
 * 1) If you don't have one already, create a Twitter application on
 *      http://dev.twitter.com/apps
 * 2) From the application details page copy the consumer key and consumer
 *      secret into the place in this code marked with (YOUR_CONSUMER_KEY
 *      and YOUR_CONSUMER_SECRET)
 * 4) Visit the 'My Access Token' screen linked to from your application
 *      details page
 * 5) Copy the user token and user secret into the place in this code marked
 *      with (A_USER_TOKEN and A_USER_SECRET)
 * 6) In a terminal or server type:
 *      php /path/to/here/userstream.php
 * 7) To stop the Streaming API either press CTRL-C or, in the folder the
 *      script is running from type:
 *      touch STOP
 * @author themattharris
 */

function my_streaming_callback($data, $length, $metrics) {
  echo $data .PHP_EOL;
  return file_exists(dirname(__FILE__) . '/STOP');
}

require '../tmhOAuth.php';
require '../tmhUtilities.php';
$tmhOAuth = new tmhOAuth(array(
  'consumer_key'    => 'YOUR_CONSUMER_KEY',
  'consumer_secret' => 'YOUR_CONSUMER_SECRET',
  'user_token'      => 'A_USER_TOKEN',
  'user_secret'     => 'A_USER_SECRET',
));

$method = "https://userstream.twitter.com/2/user.json";
$params = array(
  // parameters go here
);
$tmhOAuth->streaming_request('POST', $method, $params, 'my_streaming_callback', false);

// output any response we get back AFTER the Stream has stopped -- or errors
tmhUtilities::pr($tmhOAuth);
?>