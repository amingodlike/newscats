<?php
// FB : Manggala Febri Valentino

function cat($token, $task, $jumlah, $wait){
    $x = 0; 
    while($x < $jumlah) {
		
		$body = '{"latitude":7.6327825,"locale":"in_ID","longitude":10.0523,"task_extra_info":"","task_name":"'.$task.'","timezone":"GMT+07:00"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.veeuapp.com/v1.0/incentive/tasks?access_token=$token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json; charset=UTF-8"));
        $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch)."\n";
  }elseif(strpos($result,'"cumulative_point"')){
      echo "Succes \n";
  }elseif(strpos($result,'"complete full"')){
      echo "LIMIT \n";
	}else{
      echo $result."\n";
  }
  curl_close ($ch);
        sleep($wait);
        $x++;
        flush();
    }
}

print "TUYUL COIN VEU APP\n\n";

echo "TOKEN?\nInput : ";
$token = trim(fgets(STDIN));
echo "TASK NAME\nInput : ";
$task = trim(fgets(STDIN));
echo "Jumlah?\nInput : ";
$jumlah = trim(fgets(STDIN));
echo "Jeda? 0-9999999999 (ex:0)\nInput : ";
$wait = trim(fgets(STDIN));
$execute = cat($token, $task, $jumlah, $wait);
print $execute;
print "DONE ALL SEND\n";
?>
