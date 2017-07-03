<?php
defined('_MYINC') or die(); 

define('SESSION_TIMEOUT',3600); //timeout seconds
define('DB_SERVER','127.0.0.1'); //server address
define('DB_USER','root'); //database user
define('DB_PASS',''); //database password
define('DB_NAME','twitto'); //database name
define('DB_PREFIX','tw_');

define('TWANDO_VERSION','0.6.4');
define('TWITTER_API_LIMIT',15);
define('TWITTER_API_LIST_FW',5000);
define('TWITTER_API_USER_LOOKUP',100);
define('TABLE_ROWS_PER_PAGE',10);
define('TWITTER_TWEET_SEARCH_PP',100);
define('TWITTER_USER_SEARCH_PP',20);
define('TWITTER_GET_FOLLOWERS_ID_PP',5000);
define('TWITTER_GET_FOLLOWERS_LIST_PP',200);