<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ajaxController extends Controller
{

    /**
     * getTwiterFeeds : function to get the most recent 30 tweets in UnitedNationsJO page 
     * 
     * @return json formatted array of latest tweets 
     *
     * @author Tariq Tawalbeh
    */

	public function getTwitterFeeds($count) {
	     
	    $url = 'https://twitter.com/Eng_TawTareq';

	    
	    $correctURLPattern = '|https?://(www\.)?twitter\.com/(#!/)?@?([^/]*)|';
	    if (!preg_match($correctURLPattern, $url, $matches)) {
	        throw new Exception('Not a valid URL');
	    }
	    //page name or page id
	    $PageId = $matches[1];
	    $PageId = 'UnitedNationsJO';
	    $token = env('TOKEN');
		$token_secret = env('TOKEN_SECRET');
		$consumer_key = env('CONSUMER_KEY');
		$consumer_secret = env('CONSUMER_SECRET');

		$host = 'api.twitter.com';
		$method = 'GET';
		$path = '/1.1/statuses/user_timeline.json'; 
		// api call path

		$query = array(// query parameters
			'screen_name' => $PageId,
			'count' => $count,
			'include_rts' => false
		);

		$oauth = array(
			'oauth_consumer_key' => $consumer_key,
			'oauth_token' => $token,
			'oauth_nonce' => (string) mt_rand(), 
			'oauth_timestamp' => time(),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_version' => '1.0'
		);

		$oauth = array_map("rawurlencode", $oauth); 
		$query = array_map("rawurlencode", $query);

		$arr = array_merge($oauth, $query); // combine the values THEN sort

		asort($arr); // secondary sort (value)
		ksort($arr); // primary sort (key)
		// http_build_query automatically encodes, but our parameters
		// are already encoded, and must be by this point, so we undo
		// the encoding step
		$querystring = urldecode(http_build_query($arr, '', '&'));

		$url = "https://$host$path";

		// gather everything together for the text to hash
		$base_string = $method . "&" . rawurlencode($url) . "&" . rawurlencode($querystring);

		// same with the key
		$key = rawurlencode($consumer_secret) . "&" . rawurlencode($token_secret);

		// generate the hash
		$signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

		// GET query 
		$url .= "?" . http_build_query($query);
		$url = str_replace("&amp;", "&", $url); 

		$oauth['oauth_signature'] = $signature; 
		ksort($oauth); // probably not necessary, but twitter's demo does it
		// also not necessary, but twitter's demo does this too

		function add_quotes($str) {
			return '"' . $str . '"';
		}

		// this is the full value of the Authorization line
		$auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

		$options = array(CURLOPT_HTTPHEADER => array("Authorization: $auth"),
			CURLOPT_HEADER => false,
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false);

		// final step to get the results 
		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$json = curl_exec($feed);
		curl_close($feed);
		sleep(0.75);
		echo $json;die;	    
	}
}
