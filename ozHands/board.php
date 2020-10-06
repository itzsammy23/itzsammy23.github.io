<?php

/* Template Name: Message Board */

global $wp_query;
$start_id = $wp_query->query_vars['start_id'];
$wholesaler = $wp_query->query_vars['wholesaler'];
$buyer = $wp_query->query_vars['buyer'];

echo $start_id . " " . $wholesaler . " " . $buyer;
