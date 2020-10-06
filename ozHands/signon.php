<?php
/* Template Name: Wholesale Login */
session_start();

if($buyer_last_seen >= 15){
    $query_build = "SELECT email FROM customers WHERE lastname = '$buyer'";
    $run_query = $conn->query($query_build);

    if ($run_query->num_rows > 0){
        while($query_row = $run_query->fetch_assoc()){
            $email = $run_query["email"];
        };
    };

    $to = $email;
    $subject = 'You have new messages from ' .$buyer;
    $content = "<html>
        		<body>
                <p>Hello. You have some new messages from a customer from ozHands on the wholesale message board. Click the link below to reply</p><br>
                <a href='https://wholesale.luckyit.com.au/reply-login/?start_id=" .$table."&wholesaler=" .$wholesaler. "&buyer=" .$buyer."'>Reply Message</a>
                </body>
        </html>";
    $body = $content;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);
};


if($seller_last_seen == 0 || $seller_last_seen >= 15){
    $query_build = "SELECT email FROM whs_users WHERE display_name = '$wholesaler'";
    $run_query = $conn->query($query_build);

    if ($run_query->num_rows > 0){
        while($query_row = $run_query->fetch_assoc()){
            $email = $run_query["user_email"];
        };
    };

    $to = $email;
    $subject = 'You have new messages from ' .$buyer;
    $content = "<html>
        		<body>
                <p>Hello. You have some new messages from a customer from ozHands on the wholesale message board. Click the link below to reply</p><br>
                <a href='https://wholesale.luckyit.com.au/view-message/?start_id=" .$table."&wholesaler=" .$wholesaler. "&buyer=" .$buyer."'>Reply Message</a>
                </body>
        </html>";
    $body = $content;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);
};

"<html>
        		<body>
                <p>Hello. You have some new messages from a customer from ozHands on the wholesale message board. Click the link below to reply</p><br>
                <div align='center'>
                <a href='https://wholesale.luckyit.com.au/reply-login/?start_id=" .$table."&wholesaler=" .$wholesaler. "&buyer=" .$buyer."' style='padding: 12px; color: #fff; background-color: #800000;'>Reply Message</a>
                </div>
                </body>
        </html>";