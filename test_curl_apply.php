<?php
$ch = curl_init('http://127.0.0.1:8000/account/apply-job?post_id=1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
$res = curl_exec($ch);
echo $res;
curl_close($ch);
