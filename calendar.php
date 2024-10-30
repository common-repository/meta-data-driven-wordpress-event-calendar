<?php
/*
Template Name: Calendar
*/
?>


<?php get_header(); ?>

<?php include(TEMPLATEPATH . '/sidebarleft.php'); ?>

<?php
	//Get the metadata for each child page
        $today = strtotime(date("Y/m/d"));
        $arrMonthNums = array("01" => "01", "02" => "02", "03" => "03", "04" => "04", "05" => "05", "06" => "06", "07" => "07", "08" => "08", "09" => "09", "10" => "10", "11" => "11", "12" => "12");
        $arrMonthNames = array("01" => "JANUARY", "02" => "FEBRUARY", "03" => "MARCH", "04" => "APRIL", "05" => "MAY", "06" => "JUNE", "07" => "JULY", "08" => "AUGUST", "09" => "SEPTEMBER", "10" => "OCTOBER", "11" => "NOVEMBER", "12" => "DECEMBER");
        query_posts('meta_key=event%20name&orderby=meta_value&meta_key=start%20date&meta_compare=>=&meta_value='.date('Y/m/d', current_time('timestamp')).'&posts_per_page=-1&order=ASC');
?>

  <div id="content">
  <div class="entry"><h1>Upcoming Event Calendar</h1></div>
  <div class="entry"><br/>This calendar was created with a Wordpress plugin and some simple PHP. <strong>DOWNLOAD</strong> the code for it over <a href="http://www.bumpershine.com/2009/02/17/the-upcoming-event-calendar-a-meta-data-driven-wordpress-event-calendar-for-bloggers.html"><strong>here</strong></a>.<br/></div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php  //Get the show date and run a check against current date
        $start_date =  strtotime(get_post_meta($post->ID, 'Start Date', single));
        //echo $start_date;
        if(get_post_meta($post->ID, 'End Date', single) != "") {
             $end_date = strtotime(get_post_meta($post->ID, 'End Date', single));
         } else {
             $end_date = $start_date;
         }
    ?>
     <div class="post" id="post-<?php the_ID(); ?>">
        <div class="entry">
           <div class="post-content">
           <?php
            $show_month = date('m', $start_date);
            if ($arrMonthNums[$show_month] == $show_month) {
	    	echo "<strong>".$arrMonthNames[$show_month]."</strong><br/><br/>";
	    	$arrMonthNums[$show_month] = "printed";
            }
            $event_name = strtolower(get_post_meta($post->ID, 'Event Name', single));
	    $event_name = urlencode($event_name);
	    if($start_date == $today || ($start_date < $today & $end_date >= $today)) {
            ?>
              <u><strong>TODAY</strong></u><br/>
            <?php } ?>
            <a href="<?php the_permalink() ?>"><?php echo get_post_meta($post->ID, 'Event Name', single); ?> (Original Post)</a><br/>
                   <?php if(get_post_meta($post->ID, 'Venue', single) != ''){ ?>
                     <strong>Venue</strong>: <?php echo get_post_meta($post->ID, 'Venue', single); ?>
                     <?php if(get_post_meta($post->ID, 'Multiple Shows', single) == 'MN'){ ?>
                         (Multiple Nights, Same Venue)
                     <? } else if(get_post_meta($post->ID, 'Multiple Shows', single) == 'MV'){ ?>
                         (Multiple Nights, Multiple Venues)
                     <? } ?> <br/>
                   <? } ?>
                   <?php if(get_post_meta($post->ID, 'End Date', single) != ''){ ?>
                      <strong>Start Date</strong>: <?php echo get_post_meta($post->ID, 'Start Date', single); ?><br/>
                      <strong>End Date</strong>: <?php echo get_post_meta($post->ID, 'End Date', single); ?><br/>
                   <?php } else { ?>
                      <strong>Date</strong>: <?php echo get_post_meta($post->ID, 'Start Date', single); ?><br/>
                   <?php } ?>
                   <?php if(get_post_meta($post->ID, 'Notes', single) != ''){
		    	echo "<strong>Notes</strong>: ".get_post_meta($post->ID, 'Notes', single)."<br/>";
                    } ?>
                   <?php
                    $tickets = get_post_meta($post->ID, 'Tickets', single);
                    switch ($tickets) {
                       case "ticketmaster":
                    ?>      <a target="_blank" href="http://ticketsus.at/bumpershine?DURL=http://www.ticketmaster.com/search?&q=<?php echo $event_name; ?>">Buy Tickets</a>
                    <?php   break;
                       case "ticketweb":
                    ?>
                            <a target="_blank" href="http://ticketsus.at/bumpershine?DURL=http://www.ticketweb.com/snl/Search.action?query=<?php echo $event_name; ?>">Buy Tickets</a>
                    <?php   break;
                       case "tickets.com":
                    ?>
                          <a target="_blank" href="http://www.tickets.com/venue_info.cgi?vid=219741">Buy Tickets</a>
                    <?php   break;
						case "ticketfly.com":
                    ?>
                    	<a target="_blank" href="http://www.ticketfly.com">Buy Tickets</a>
                    <?php   break;
                       case "free":
                    ?>
		          FREE
                    <?php
                          break;
                    } ?>
                    <?php if(get_post_meta($post->ID, 'Other Ticket Link', single) != ''){
                        echo "<a target=\"_blank\" href=\"".get_post_meta($post->ID, 'Other Ticket Link', single)."\">Buy Tickets</a>";
                    } ?>
            </div>
         </div><!-- /entry -->
     </div><!-- /post -->
  <?php endwhile; endif; ?>

  </div><!--/content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>