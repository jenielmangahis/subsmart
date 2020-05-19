<?php 

//print_r($_FILES); die;

$filename=$_FILES['upload']['tmp_name'];

$striped_content = '';
$content = '';

if(!$filename || !file_exists($filename)) return false;

$zip = zip_open($filename);
if (!$zip || is_numeric($zip)) return false;


while ($zip_entry = zip_read($zip)) {

	if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

	if (zip_entry_name($zip_entry) != "word/document.xml") continue;

	$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

	zip_entry_close($zip_entry);
}
zip_close($zip);  
    
$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
$content = str_replace('</w:r></w:p>', "######", $content);
$striped_content = strip_tags($content);
$striped_content = str_replace("######","<br/><br/>", $striped_content);

echo $striped_content;

 ?>