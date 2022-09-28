<?php 
if ( !defined( 'MY_BASE_URL' ) ){
	if($_SERVER['HTTP_HOST'] == '172.23.6.20'){
		define( 'MY_BASE_URL', 'http://172.23.6.20/Polling/' );
	}else{
		define( 'MY_BASE_URL', 'http://localhost:8888/Polling/' );
	}
}

