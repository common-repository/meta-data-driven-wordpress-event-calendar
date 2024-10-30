<?php
/*
Template Name: Calendar RSS

*/

	//Get the metadata for each child page
        $today = strtotime(date("Y/m/d"));
        query_posts('meta_key=event%20name&orderby=meta_value&meta_key=start%20date&meta_compare=>=&meta_value='.date('Y/m/d', current_time('timestamp')).'&posts_per_page=-1&order=ASC');
		$arrItems = Array();
	 if (have_posts()) : while (have_posts()) : the_post();
	 	$link = "";
	 	$link_title = "";
	 	$desc = "";
    	$link_title = get_post_meta($post->ID, 'Event Name', single);
    	$event_name = urlencode($link_title);
    	$pub_date = get_the_time();

		if(get_post_meta($post->ID, 'Venue', single) != ''){
			$desc = $desc."<strong>Venue</strong>: ". get_post_meta($post->ID, 'Venue', single)."<br/>";
		}

	    if(get_post_meta($post->ID, 'End Date', single) != ''){
			$desc = $desc."<strong>Start Date</strong>: ". get_post_meta($post->ID, 'Start Date', single)."<br/>";
			$desc = $desc."<strong>End Date</strong>: ".get_post_meta($post->ID, 'End Date', single)."<br/>";
	    } else {
			$desc = $desc."<strong>Date</strong>: ". get_post_meta($post->ID, 'Start Date', single)."<br/>";
	    }

	    if(get_post_meta($post->ID, 'Notes', single) != ''){
			$desc = $desc."<strong>Notes</strong>: ".get_post_meta($post->ID, 'Notes', single)."<br/>";
		}

	    $tickets = get_post_meta($post->ID, 'Tickets', single);
		switch ($tickets) {
		   case "ticketmaster":
		      	$link = "http://ticketsus.at/bumpershine?DURL=http://www.ticketmaster.com/search?&amp;q=".$event_name;
		   		break;
		   case "ticketweb":
				$link = "http://ticketsus.at/bumpershine?DURL=http://www.ticketweb.com/snl/Search.action?query=".$event_name;
				break;
		   case "tickets.com":
				$link = "http://www.tickets.com/venue_info.cgi?vid=219741";
				break;
		   case "ticketfly.com":
		   		$link = "http://www.ticketfly.com";
				break;
		   case "free":
				$link = get_permalink($post->ID);
			  	break;
		}
		if(get_post_meta($post->ID, 'Other Ticket Link', single) != ''){
			$link = get_post_meta($post->ID, 'Other Ticket Link', single);
		}
		if($link == '') {
			$link = get_permalink($post->ID);
		}
		//Debugging Code
		//echo $link."<br>";
		//echo "<br>".$link_title."<br>";
		//echo $desc."<br>";
		$items = array('title' => htmlspecialchars($link_title),
		            'link' => $link,
		            'description' => htmlspecialchars($desc));
		array_push($arrItems, $items);

  	endwhile; endif;


  	$rssName = "Upcoming Events RSS Feed";
	$rssHomePage = "http://www.bumpershine.com";
	$description = "Bumpershine.com Upcoming Event Calendar RSS Feed";

	$sxe = simplexml_load_string("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<rss version=\"2.0\">
	<channel>
	    <title>$rssName</title>
	    <link>$rssHomePage</link>
	    <description>$description</description>
	    <language>en-us</language>
	</channel>
	</rss>");

	foreach($arrItems as $item){

	    $child = $sxe->channel->addChild('item');
	    $child->addChild('title', $item['title']);
	    $child->addChild('pubDate',  $pub_date);
	    $child->addChild('link', $item['link']);
	    $child->addChild('description', $item['description']);

	}

	//echo $sxe->asXML();
	//print_r($arrItems);
	print header("Content-type: text/xml; charset=utf-8") . $sxe->asXML();

?>
