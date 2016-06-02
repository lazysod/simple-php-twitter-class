<?php 

class twitterFeed {

	public function help()
	{
		$msg = '<h2>Twitter Feed</h2>
		<p>Go to https://apps.twitter.com and set up your app, read only permissions is fine. Then edit /inc/config.php accordingly. After complete you can call the script using the php auloload system. eg: 
		<ol>
			<li>$tw = new twitterFeed;</li>
			<li>$tweets = $tw->getTweets(your_Twitter_user_name_here);</li>
		</ol>
		</p>
		<p>
		You can control the ammount of tweets you pull by supplying a number. If no number is given it will default to the most recient tweet. EG: $tweets = $tw->getTweets(your_Twitter_user_name_here, 2);</p>
		<p>
		It will then produce an array with the following.
		<ul>
			<li>id (message id)</li>
			<li>source</li>
			<li>status</li>
			<li>time</li>
			<li>avatar</li>
			<li>screen_name</li>
			<li>eal_name</li>
		</ul>
		<p>
			You can then call other functions of the class to create links if you wish like:</br>

		$tw->make_links($tweets[\'status\']); - This will link all hashtags and @username\'s as well as any URLS the tweet might contain
		$tw->make_links($tweets[\'time\']); - This will give a more twitter like time result based on the actual timestamp of the tweet. (eg: 1 hour ago)
		from here you can style and control the output as you like</p>';	

		return $msg;	
	}

	public function getTweets($twitteruser, $optional = false) { 
    // Set number of tweets
		if($twitteruser==''){
			die('NOTE: Please edit config.php');
		}else{
		    if($optional==true){
		    	$notweets = $optional;
		    }else{
		    	$notweets = 1;
		    }
		    $connection = new TwitterOAuth(consumer_key, consumer_secret, access_token, accesstoken_secret);
		    $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets); 

		    foreach($tweets as $tweet){ 
		    	$tweet_list[] = array(
		    		'id' => $tweet->id_str,
		    		'source' => $tweet->source,
		    		'status' => $tweet->text,
		    		'time' => $tweet->created_at,
		    		'avatar' => $tweet->user->profile_image_url,
		    		'screen_name' => $tweet->user->screen_name,
		    		'real_name' => $tweet->user->name,
		    	); 
		    }
		    return $tweet_list;			
		}


	}
	
	public function make_links($status)
	{
		$status = preg_replace('%(http://([a-z0-9_.+&!#~/,\-]+))%i','<a href="http://$2">$1</a>',$status);
	  	$status = preg_replace('/@([a-z0-9_]+)/i','<a href="http://twitter.com/$1">@$1</a>',$status);
	  	$status = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1<a href="http://twitter.com/hashtag/\2">#\2</a>', $status);

	  	return $status;
	}
	
	public function twitter_time($a) 
	{
	    //get current timestampt
	    $b = strtotime("now"); 
	    //get timestamp when tweet created
	    $c = strtotime($a);
	    //get difference
	    $d = $b - $c;
	    //calculate different time values
	    $minute = 60;
	    $hour = $minute * 60;
	    $day = $hour * 24;
	    $week = $day * 7;
	        
	    if(is_numeric($d) && $d > 0) {
	        //if less then 3 seconds
	        if($d < 3) return "right now";
	        //if less then minute
	        if($d < $minute) return floor($d) . " seconds ago";
	        //if less then 2 minutes
	        if($d < $minute * 2) return "about 1 minute ago";
	        //if less then hour
	        if($d < $hour) return floor($d / $minute) . " minutes ago";
	        //if less then 2 hours
	        if($d < $hour * 2) return "about 1 hour ago";
	        //if less then day
	        if($d < $day) return floor($d / $hour) . " hours ago";
	        //if more then day, but less then 2 days
	        if($d > $day && $d < $day * 2) return "yesterday";
	        //if less then year
	        if($d < $day * 365) return floor($d / $day) . " days ago";
	        //else return more than a year
	        return "over a year ago";
	    }
	}
	
}

?>