<?php

// Copyright (C) 2008 Ilya S. Lyubinskiy. All rights reserved.
// Technical support: http://www.php-development.ru/
//
// YOU MAY NOT
// (1) Remove or modify this copyright notice.
// (2) Re-distribute this code or any part of it.
//     Instead, you may link to the homepage of this code:
//     http://www.php-development.ru/php-scripts/contact-form.php
// (3) Use this code as part of another product.
//
// YOU MAY
// (1) Use this code on your website.
//
// NO WARRANTY
// This code is provided "as is" without warranty of any kind.
// You expressly acknowledge and agree that use of this code is at your own risk.


session_name($_GET['sname']); session_start();
$t_num = isset($_SESSION['contact-form-number']) ? $_SESSION['contact-form-number'] : '0000';

if (get_magic_quotes_gpc() && !function_exists('strip_slashes_deep'))
{
  function strip_slashes_deep($value)
  {
    if (is_array($value)) return array_map('strip_slashes_deep', $value);
    return stripslashes($value);
  }

  $_GET    = strip_slashes_deep($_GET);
  $_POST   = strip_slashes_deep($_POST);
  $_COOKIE = strip_slashes_deep($_COOKIE);
}

header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Expires: Fri, 31 Dec 1999 23:59:59 GMT');

header("Content-type: image/png");
$image = imagecreate(60, 17);
$white = imagecolorallocate($image, 0, 0, 0);
$black = imagecolorallocate($image,   255,   255,   255);
imagestring ($image, 4, 13, 1, $t_num, $black);
imagepng    ($image);
imagedestroy($image);

?>