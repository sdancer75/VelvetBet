<?php



   // Edit upload location here
   $destination_path = getcwd().DIRECTORY_SEPARATOR;

   $result = 0;


   //$target_path = "C:\\xampp\\htdocs\\lackybet\\grafix\\coupon.htm";
   $target_path = "/home/velvet/www/www/grafix/coupon.htm";

   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }

   sleep(1);



?>

<script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result; ?>);</script>