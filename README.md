# README #

## Twitter Feed ##

Go to https://apps.twitter.com and set up your app, read only permissions is fine. Then edit /inc/config.php accordingly. After complete you can call the script using the php auloload system. eg: 

$tw = new twitterFeed;
$tweets = $tw->getTweets(your_Twitter_user_name_here);

You can control the ammount of tweets you pull by supplying a number. If no number is given it will default to the most recient tweet.

EG: $tweets = $tw->getTweets(your_Twitter_user_name_here, 2);

It will then produce an array with the following.

* id (message id)
* source
* status
* time
* avatar
* screen_name
* real_name

You can then call other functions of the class to create links if you wish like:

* $tw->make_links($tweets['status']); - This will link all hashtags and @username's as well as any URLS the tweet might contain
* $tw->make_links($tweets['time']); - This will give a more twitter like time result based on the actual timestamp of the tweet. (eg: 1 hour ago)
from here you can style and control the output as you likeThis README would normally document whatever steps are necessary to get your application up and running.

## Help ##
If at any time you want to display this help documentation call the help function **$tw->help();**