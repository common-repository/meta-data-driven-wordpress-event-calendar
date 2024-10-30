<?php
/*
Template Name: Sidebar Events
*/

//Get the metadata for each child page
$today = strtotime(date("Y/m/d"));
$arrMonthNums = array("01" => "01", "02" => "02", "03" => "03", "04" => "04", "05" => "05", "06" => "06", "07" => "07", "08" => "08", "09" => "09", "10" => "10", "11" => "11", "12" => "12");
$arrMonthNames = array("01" => "JANUARY", "02" => "FEBRUARY", "03" => "MARCH", "04" => "APRIL", "05" => "MAY", "06" => "JUNE", "07" => "JULY", "08" => "AUGUST", "09" => "SEPTEMBER", "10" => "OCTOBER", "11" => "NOVEMBER", "12" => "DECEMBER");
$recentPosts = new WP_Query();
$recentPosts->query('meta_key=event%20name&orderby=meta_value&meta_key=start%20date&posts_per_page=-1&order=ASC');
$event_count = 10;
$i = 1;
?>

<li><a href="http://www.bumpershine.com/upcoming-show-calendar">ALL UPCOMING EVENTS</a></li>
<?php
while ($recentPosts->have_posts()) : $recentPosts->the_post();
	$post_id = $recentPosts->post->ID;
	$event_name = strtolower(get_post_meta($post_id, 'Event Name', single));
	$event_name = urlencode($event_name);
	$start_date =  strtotime(get_post_meta($post_id, 'Start Date', single));
	if(get_post_meta($post_id, 'Start Date', single)) {
           $end_date = strtotime(get_post_meta($post_id, 'End Date', single));
        } else {
           $end_date = $start_date;
        }
	if(($today <= $start_date & $i <= $event_count)) {
	?>
	<li><a href="<?php the_permalink() ?>"><?php echo get_post_meta($post_id, 'Event Name', single); ?></a><br>
	<?php if(get_post_meta($post_id, 'Venue', single) != ''){ ?>
		<strong>Venue</strong>: <?php echo get_post_meta($post_id, 'Venue', single); ?><br>
	<? } ?>
	<strong>Date</strong>: <?php echo get_post_meta($post_id, 'Start Date', single); ?>
	<?php if(get_post_meta($post_id, 'End Date', single) != ''){
		echo " - ".get_post_meta($post_id, 'End Date', single);
	 } ?><br>
	<?php if(get_post_meta($post_id, 'Notes', single) != ''){ ?>
		<strong>Notes</strong>: <?php echo get_post_meta($post_id, 'Notes', single); ?><br>
	<? } ?>
	<?php
	$tickets = get_post_meta($post_id, 'Tickets', single);
	switch ($tickets) {
	   case "ticketmaster":
	?>      <a target="_blank" href="http://ticketsus.at/bumpershine?DURL=http://www.ticketmaster.com/search?&q=<?php echo $event_name; ?>">Buy Tickets</a><br>
	<?php   break;
	   case "ticketweb":
	?>
			<a target="_blank" href="http://ticketsus.at/bumpershine?DURL=http://www.ticketweb.com/snl/Search.action?query=<?php echo $event_name; ?>">Buy Tickets</a><br>
	<?php   break;
	   case "tickets.com":
	?>
		  <a target="_blank" href="http://www.tickets.com/venue_info.cgi?vid=219741">Buy Tickets</a><br>
	<?php   break;
		   case "ticketfly.com":
		?>
		  <a target="_blank" href="http://www.ticketfly.com">Buy Tickets</a><br>
	<?php   break;
	   case "free":
	?>
  FREE<br>
	<?php
		  break;
	} ?>
	<?php if(get_post_meta($post_id, 'Other Ticket Link', single) != ''){
		echo "<a target=\"_blank\" href=\"".get_post_meta($post_id, 'Other Ticket Link', single)."\">Buy Tickets</a><br>";
	} ?>
	</li>

<?php 	$i = $i + 1;
	} //end if
endwhile;  ?>
<li><a href="http://www.bumpershine.com/upcoming-show-calendar">More Events...</a></li>
