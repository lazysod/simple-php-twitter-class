<?php 
include_once './inc/config.php';

// Declare class
$tw = new twitterFeed;

// get tweets
$tweets = $tw->getTweets(twitter_user);

// output tweets
var_dump($tweets);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Twitter Class</title>
</head>
<body>
	<h1>Twitter Feed</h1>
	<p>
		Go to <a href="https://apps.twitter.com/">https://apps.twitter.com</a> and set up your app, read only permissions is fine. Then edit <b>/inc/config.php</b> accordingly. After complete you can call the script using the php auloload system. eg: <b><br/>$tw = new twitterFeed;<br>$tweets = $tw->getTweets(your_Twitter_user_name_here);</b>
	</p>
	<p>
		You can control the ammount of tweets you pull by supplying a number. If no number is given it will default to the most recient tweet. EG: <b>$tweets = $tw->getTweets(your_Twitter_user_name_here, 2);</b>
	</p>
	<p>
		It will then produce an array with the following.
	</p>
	<ul>
		<li>id <i>(message id)</i></li>
	    <li>source</li>
	    <li>status</li>
	    <li>time</li>
	    <li>avatar</li>
	    <li>screen_name</li>
	    <li>real_name</li>
	</ul>
	<p>
		You can then call other functions of the class to create links if you wish like: 
	</p>
	<ol>
		<li><b>$tw->make_links($tweets['status']);</b> - This will link all hashtags and @username's as well as any URLS the tweet might contain</li>
		<li><b>$tw->make_links($tweets['time']);</b> - This will give a more twitter like time result based on the actual timestamp of the tweet. (eg: 1 hour ago)</li>
	</ol>
	<p>from here you can style and control the output as you like</p>
</body>
</html>