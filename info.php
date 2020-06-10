<?php

  function habbo( $name, $hotel ) {
  
    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_URL, "https://www.habbo." . $hotel . "/api/public/users" );
    curl_setopt( $ch, CURLOPT_HEADER, false );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Accept-Encoding: gzip, deflate, sdch' ) );
    curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    
    $get = gzinflate( substr( curl_exec( $ch ), 10, -8 ) );
    preg_match( "/setCookie\((.*)\);/", $get, $get );
    $get = explode( ",", str_replace( array( "'", " " ), "", $get[1] ) );
    
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Cookie:" . $get[0] . "=" . $get[1] ) );
    curl_setopt( $ch, CURLOPT_URL, "http://www.habbo." . $hotel . "/api/public/users?name=" . $name );
    
    $id = json_decode( curl_exec( $ch ) );
    
    if( isset( $id ) && $id->profileVisible == 1 ) {
    
      curl_setopt( $ch, CURLOPT_URL, "http://www.habbo." . $hotel . "/api/public/users/" . $id->uniqueId . "/profile" );
      $info = json_decode( curl_exec( $ch ) );
      
    } else 
      $info = false;
      
    curl_close( $ch );
    
    return $info;
    
  }

  habbo('Bromarks', '.com.br');
  
?>