<?php
   /*
   * logoff.php is used to logoff the web system
   */
   // check to see if connection was successful
      //echo "get";
   session_start(); //start session to check login state
   session_unset();
   session_destroy();//clear the session 
   header("location: index.php");//jmp to index.php
?>