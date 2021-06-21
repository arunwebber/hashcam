<?php
//When you are accessing this file firest time delete file called hash.txt
$htmlfile = __DIR__ .'/cam.html';
//This were the source page has to be added for example(http://example.com/page_hashed.html)
$content = file_get_contents("https://web.ics.purdue.edu/~gchopra/class/public/pages/webdesign/05_simple.html");
file_put_contents("cam.html", $content);
//Getting a sha 256 hash
$dynamicHash = hash_file('sha256', $htmlfile);
//Checking Whether the file is existing or not
$isFile = file_exists(__DIR__ .'/hash.txt');
//Writing the primary hash
if($isFile!=1){
  file_put_contents("hash.txt",$dynamicHash);
}
$hashfile = __DIR__ .'/hash.txt';
$checksum_check = fopen('hash.txt','r');
//Getting Hash Inside the file
$fileHash = fread($checksum_check, filesize($hashfile));
fclose($checksum_check);

if($fileHash==$dynamicHash){
  $to = "example@email.com";
  $subject = "Hashes Matches";
  $txt = $fileHash;
  $headers = "From:example@email.com";
  mail($to,$subject,$txt,$headers);
}else{
  $to = "example@email.com";
  $subject = "Hashes Dont Matches";
  $txt = 'Original Hash:'.$fileHash.'Hash Now:'.$dynamicHash;
  $headers = "From:mail@email.com";
  mail($to,$subject,$txt,$headers);
}
//This simple script create a text with a hash and check the hash aganist the pages
//When ever it runs
?>
