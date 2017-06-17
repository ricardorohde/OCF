<?php
  if (!isset($_SESSION['ID'])) {
      session_start();
      $_ID = session_id();
      $_SESSION['ID'] = session_id();
      $_SERVER['DOCUMENT_ROOT'] = '.';
      $_SESSION['DOCROOT'] = $_SERVER['DOCUMENT_ROOT'];
	  }
//  $_SESSION['DOCROOT'] = '/var/www/html/clubedoopala';
date_default_timezone_set('America/Sao_Paulo');
?>