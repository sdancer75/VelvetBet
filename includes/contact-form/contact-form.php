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

?>


<div class="contact_form">


<!-- ***** Config ********************************************************** -->

<?php

$contact_form_msg_clear    = 'Καθαρισμός';
$contact_form_msg_submit   = 'Αποστολή';
$contact_form_msg_submit   = $contact_form_graph ? '' : $contact_form_msg_submit;

$contact_form_msg_sent     = 'Το μήνυμά σας στάλθηκε επιτυχώς. Θα επικοινωνήσουμε μαζί σας το συντομότερο δυνατό.';
$contact_form_msg_not_sent = 'Το μήνυμά σας δεν στάλθηκε διότι προέκυψε κάποιο σφάλμα.';
$contact_form_msg_invalid  = 'Παρακαλώ διορθώστε τα πεδία που έχουν επισημανθεί με κόκκινο χρώμα.';

?>


<!-- ***** PHP ************************************************************* -->

<?php

// ***** contact_form_mail *****

function contact_form_mail($to, $subject, $message, $headers = '', $charset = 'utf-8', $files = array())
{
  if (!count($files))
  {
    $ext_headers  = $headers;
    $ext_headers .= "Content-Type: text/plain; charset=\"$charset\"\r\n";
    $ext_message  = $message;
  }
  else
  {
    $boundary = 'a6cd792e';
    while (true)
    {
      if (strpos($subject, $boundary) !== false ||
          strpos($message, $boundary) !== false) { $boundary .= dechex(rand(0, 15)) . dechex(rand(0, 15)); continue; }
      foreach ($files as $fi_name => $fi_data)
      if (strpos($fi_name, $boundary) !== false ||
          strpos($fi_data, $boundary) !== false) { $boundary .= dechex(rand(0, 15)) . dechex(rand(0, 15)); continue; }
      break;
    }

      $ext_headers  = $headers;
      $ext_headers .= "MIME-Version: 1.0\r\n";
      $ext_headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

      $ext_message  = "This is a multi-part message in MIME format.";
      $ext_message .= "\r\n--$boundary\r\n";

      $ext_message .= "Content-Type: text/plain; charset=\"$charset\"\r\n\r\n";
      $ext_message .= $message;
      $ext_message .= "\r\n--$boundary\r\n";

    foreach ($files as $i => $x)
    {
      $ext_message .= "Content-Type: {$x['type']}; name=\"{$x['name']}\"\r\n";
      $ext_message .= "Content-Disposition: attachment\r\n";
      $ext_message .= "Content-Transfer-Encoding: base64\r\n\r\n";
      $ext_message .= chunk_split(base64_encode($x['data']));
      $ext_message .= "\r\n--$boundary\r\n";
    }
  }

  $error_reportings = error_reporting(E_ERROR | E_PARSE);
  $res = mail($to, $subject, $ext_message, $ext_headers);
  $error_reportings = error_reporting($error_reportings);

  return $res;
}

// ***** contact_form_post *****

function contact_form_post($name)
{
  global $contact_form_encoding;
  if (isset($_POST[$name])) return htmlentities($_POST[$name], ENT_COMPAT, $contact_form_encoding);
  if (isset($_GET [$name])) return htmlentities($_GET [$name], ENT_COMPAT, $contact_form_encoding);
  return '';
}

// ***** Send Mail *****

if (count($_POST))
{
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

  $patern_aux1 = "(\\w+(-\\w+)*)";
  $patern_aux2 = "($patern_aux1\\.)*$patern_aux1@($patern_aux1\\.)+$patern_aux1";

  $ename = '';
  $email = '';
  $esubj = $contact_form_default_subject;
  $ehead = $contact_form_message_prefix;
  $ebody = '';
  $valid = true;
  foreach ($contact_form_fields as $i => $x)
  {
    $_POST[$i] = isset($_POST[$i]) ? $_POST[$i] : '';

    if ($x['type'] === 'upload')
    {
      if (isset($_POST["$i-clear"]) && $_POST["$i-clear"])
          unset($_SESSION['contact-form-upload'][$i]);
      if (isset($_FILES[$i])             &&
                $_FILES[$i][    'type']  &&
                $_FILES[$i][    'name']  &&
                $_FILES[$i]['tmp_name']  &&
    file_exists($_FILES[$i]['tmp_name']) &&
       filesize($_FILES[$i]['tmp_name']) <= $x['maxsize'])
                $_SESSION['contact-form-upload'][$i] =
                    array('type' =>                   $_FILES[$i][    'type'],
                          'name' =>                   $_FILES[$i][    'name'],
                          'data' => file_get_contents($_FILES[$i]['tmp_name']));
    }

    if ($x['type'] === 'checkbox'   && trim($_POST[$i]) ||
        $x['type'] === 'department' && trim($_POST[$i]) ||
        $x['type'] === 'input'      && trim($_POST[$i]) ||
        $x['type'] === 'name'       && trim($_POST[$i]) ||
        $x['type'] === 'select'     && trim($_POST[$i]) ||
        $x['type'] === 'subject'    && trim($_POST[$i]) ||
        $x['type'] === 'textarea'   && trim($_POST[$i]) ||
        $x['type'] === 'email'      && preg_match("/^$patern_aux2$/sDX", $_POST[$i]) ||
        $x['type'] === 'turing'     && isset($_SESSION['contact-form-number']) && $_POST[$i] === $_SESSION['contact-form-number'] ||
        $x['type'] === 'upload'     && isset($_SESSION['contact-form-upload'][$i]))
    {
      if ( $x['type'] === 'textarea')
           $ebody .=             "\r\n" . $_POST[$i] . "\r\n";

      if ( $x['type'] !== 'textarea')
      if (!$x['name'] && isset($x['prompt']))
           $ehead .= $x['prompt'] . ' ' . $_POST[$i] . "\r\n";
      else $ehead .= $x['name'  ] . ' ' . $_POST[$i] . "\r\n";
    }
    elseif ($x['require'] || $_POST[$i] !== '')
    {
      $valid = false;
      if (!$x['name'] && isset($x['prompt']))
           $contact_form_fields[$i]['prompt'] = "<em>{$x['prompt']}</em>";
      else $contact_form_fields[$i]['name'  ] = "<em>{$x['name'  ]}</em>";
    }

    switch ($x['type'])
    {
      case 'department': foreach ($x['items'] as $j => $y) if ($y === $_POST[$i]) $contact_form_email = $j; break;
      case 'email':      $email = $_POST[$i]; break;
      case 'name':       $ename = $_POST[$i]; break;
      case 'subject':    $esubj = $_POST[$i]; break;
    }
  }

  if ($valid)
  {
    $mail_sent = contact_form_mail($contact_form_email, $esubj, $ehead . $ebody,
                                   "From: $ename <$email>\r\n", $contact_form_encoding,
                                    isset($_SESSION['contact-form-upload']) ? $_SESSION['contact-form-upload'] : array());

    if ($mail_sent)
         echo '<div class="error"><em>'               . $contact_form_msg_sent     . '</em></div>';
    else echo '<div class="error"><em class="error">' . $contact_form_msg_not_sent . '</em></div>';
    if ($mail_sent) $_POST    = array();
    if ($mail_sent) $_SESSION = array();
  }
  else   echo '<div class="error"><em>'               . $contact_form_msg_invalid  . '</em></div>';
}

$_SESSION['contact-form-number'] = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

?>


<!-- ***** HTML ************************************************************ -->

<form method="post" action="<?=$_SERVER['REQUEST_URI'];?>" enctype="multipart/form-data">
<table>
<?php

$slash = $contact_form_xhtml ? '/' : '';
foreach ($contact_form_fields as $i => $x)
{
  ?>
  <tr>
  <td class="Padding3pxlogin"><?=$x['name'];?></td>
  <td>
  <?php
  switch ($x['type'])
  {
    case 'name':
    case 'email':
    case 'input':
    case 'subject':
      ?>
      <div class="input"><input name="<?=$i;?>" type="text" value="<?=contact_form_post($i);?>" <?=$slash;?>></div>
      <?php
      break;
    case 'turing':
      ?>
      <div class="input"><input name="<?=$i;?>" type="text" value="<?=contact_form_post($i);?>" <?=$slash;?>></div>
      <img width="60" height="17" src="<?=$x['url'];?>?sname=<?=session_name();?>&amp;rand=<?=rand();?>" alt="" <?=$slash;?>>
      <br style="clear: both;" <?=$slash;?>>
      <?=$x['prompt'];?>
      <?php
      break;
    case 'upload':
      ?>
      <input name="<?=$i;?>" type="file" value="<?=contact_form_post($i);?>" <?=$slash;?>>
      <?php
      if (isset($_SESSION['contact-form-upload'][$i]))
      {
        ?>
        <input name="<?=$i;?>-clear" type="checkbox" value="Yes" <?=$slash;?>>
        <?=$contact_form_msg_clear;?> <?=$_SESSION['contact-form-upload'][$i]['name'];?>
        <?php
      }
      break;
    case 'checkbox':
      ?>
      <input name="<?=$i;?>" type="checkbox" value="Yes" <?=contact_form_post($i) ? 'checked="checked"' : '';?> <?=$slash;?>>
      <small><?=$x['prompt'];?></small>
      <?php
      break;
    case 'textarea':
      ?>
      <div class="input"><textarea name="<?=$i;?>" cols="45" rows="6"><?=contact_form_post($i);?></textarea></div>
      <?php
      break;
    case 'select':
    case 'department':
      ?>
      <select name="<?=$i;?>">
      <option value=""><?=$x['default'];?></option>
      <?php foreach ($x['items'] as $j => $y) { ?><option value="<?=$y;?>" <?=contact_form_post($i) === $y ? 'selected="selected"' : '';?>><?=$y;?></option><?php } ?>
      </select>
      <?php
      break;
  }
  ?>
  </td>
  </tr>
  <?php
}

?>

<tr><td></td><td><input id="submit_contact" class=ButtonOrange type="submit" value="<?=$contact_form_msg_submit;?>" onmouseover="this.style.cursor='pointer'" <?=$slash;?>></td></tr>

</table>
</form>


</div>