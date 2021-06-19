<?php
//When you are accessing this file firest time delete file called hash.txt
$htmlfile = __DIR__ .'/cam.html';
//This were the source page has to be added for example(http://example.com/page_hashed.html)
$content = file_get_contents("http://example.com/page_hashed.html");
file_put_contents("cam.html", $content);
echo "Dynamic Hash";
//Getting a sha 256 hash
echo $dynamicHash = hash_file('sha256', $htmlfile);
//Checking Whether the file is existing or not
$isFile = file_exists(__DIR__ .'/hash.txt');
//Writing the primary hash
if($isFile!=1){
  echo "No file";
  file_put_contents("hash.txt",$dynamicHash);
}
$hashfile = __DIR__ .'/hash.txt';
$checksum_check = fopen('hash.txt','r');
//Getting Hash Inside the file
$fileHash = fread($checksum_check, filesize($hashfile));
fclose($checksum_check);

if($fileHash==$dynamicHash){
  echo "Hashes Matches";
//Add here which email the mail has to be delivered
  $output = shell_exec('ssmtp you@example.com < msg.txt');
  echo $output;
}else{
  echo "Hashes Dont match";
//Add here which email the mail has to be delivered
  $output = shell_exec('ssmtp you@example.com < msg1.txt');
  echo $output;
}
//This simple script create a text with a hash and check the hash aganist the pages
//When ever it runs
?>
