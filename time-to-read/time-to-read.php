<?php
/*
* Plugin Name: Time To Read
* Description: Calculates the amount of time to read and inserts at the top of each post/page
* Version: 1.0
* Author: Ashley Goldstein
* License: GPL2
*/
//appends time to read at the beginning of each content
function aeg_add_html_to_content( $content ) {
    $readTime = aeg_time_to_read( $content );
    //checks for singular minute
    if ($readTime == 1)
    {
        $quantity = "minute.";
    }
    else
    {
        $quantity = "minutes.";
    }
    //makes html segment
    $html_segment = '<p>Time to read ' . $readTime . ' ' . $quantity . '</p>';
    //appends to top
    $content = $html_segment . $content;
    return $content;
}
//filter hook with 99 priority
add_filter( 'the_content', 'aeg_add_html_to_content', 99);

//calculates the time to read
function aeg_time_to_read( $content )
{
    $numWords = sizeof(explode(" ", $content));
    //average words per minute for reading
    $readTime = ceil(($numWords) / 250);
    return $readTime;
}
