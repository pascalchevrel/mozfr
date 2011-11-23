<?php

function getTweets($screen_name, $nb_tweets=5) {

    $tweets = file_get_contents('http://www.twitter.com/statuses/user_timeline.json?screen_name='.$screen_name.'&count='.$nb_tweets);

    if( $tweets == false) {
        $retour = '';
    } else {
        $tweets = json_decode($tweets);
        $retour  = '<h3>Nos derniers gazouillis</h3>';
        $retour .= '<ul id="tweets">';
        foreach ($tweets as $status) {
             $retour .=  '<li><a href="https://twitter.com/#!/' . $screen_name . '/status/' . $status->id_str . '">' . $status->text . '</a></li>';
        }
        $retour .= '</ul>';
    }

    //~ return var_dump($tweets);
    return $retour;
}
