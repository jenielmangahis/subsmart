<?php if (isset($error)) echo $error; ?>
<?php if (isset($success)) echo $success; ?>

 <?php
 if (isset($upload_data))
 { 
 foreach ($upload_data as $item => $value): 
echo $item;
echo $value; 
         endforeach; 
     }
     ?>