<?php
$host = 'db';
$user = 'root';
$pass = 'test';
$db = 'GALLERY2';

@$link = new mysqli($host, $user, $pass, $db);
$error = $link->connect_error;
$errno = $link->connect_errno;
if ($error != null) {
  echo "[Error $errno]: $error.";
  die();
}