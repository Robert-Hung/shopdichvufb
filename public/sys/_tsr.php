<?php
$cookie = "lang_code=eyJpdiI6IkZGditnbHFFemQ2clBGNEJwbjFOU0E9PSIsInZhbHVlIjoiZms2d3NuR214T3hnU0JHZTVBT2srUT09IiwibWFjIjoiNTU2MGE2N2MwZDU5MGYzZjc2NWQ1MDQzZTQzNWY1MjJjYmQ1MjJhYjAwY2MxNDU2YWE1OGQ2YmMzNDQwMDI3OCJ9; client_info=eyJpdiI6Ilwva0V3R2dqSlVEaTRHWk04RDdZdmdBPT0iLCJ2YWx1ZSI6ImNVbE5SUXZvNHQ2aXJHclZvMzRiUmc9PSIsIm1hYyI6IjdiYTUwMDQ5MDAyNjU4ZmZmMWM3M2Q4MzVhMjA0MDM1NDVjOThhMzUxMjYwNDA3NGExYjRiNTY4N2YwMGQ2OGYifQ==; remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6ImZoRWtmZllCb243amtHT1dGTXB5Qnc9PSIsInZhbHVlIjoiNnFtellWenNBQmsyK2JZblBSTGpcL1VvcG9hQzd2bFwvSEJDbzdzeFJ1U1MybFo4aUZGYkQ5d1l6d3MydXRhbURXSEVjN1BJdUZad3oyOE5ldU5SNmVWdjdSeVwvS1BNUUdReGg5U2t6ZGFwYSs5WG5ENHZiRWl4enlFRXdKcXNSWUJ1SDNzZFBheWxmSWppODN4aFY1RmFsXC9nQlBhdVwvSTNLSmlLeVNGalR3c0tHUW11UkFmU1ZNXC9ScHhXVmJjTHNNIiwibWFjIjoiNTcyYzczMWVhNDJlMWQ3MWFkOWRiMTYxOTdmOTJjYmE2MmFjMTA4MjI2ZmNhNGIwNDcxZDNlMGU3N2VmODM0NyJ9; TCK=32509fb3c5e93c0ae734b082c3fa033e; PHPSESSID=79u55o5ijhklo2143sttldo527; XSRF-TOKEN=eyJpdiI6IjhDOTJRMjY5RW5zbmVRa1F0MU1CdWc9PSIsInZhbHVlIjoiUm9nWmg0NjMzU3I1XC9xTU1aQWxQejdwSlwvRHZZdkRcLzJGalYzY0ZVdjdJdG4yb01lMXA1NXVyVER0aFZLQWpiUCIsIm1hYyI6ImNhMGVmMGRjZjg4YWQxMTkzZDA2NzkxZjM5OWU3Yzc2YWFiNGZiZWQxNjY4NWRkMDNiMjBkZmE5YzUyOTNiM2MifQ==; web_session=eyJpdiI6ImZ4eWVFTmExcEZnNFNxdkE4SGlXOUE9PSIsInZhbHVlIjoiVGthSlZiM3NjaE9sNmFKMmN1cUo3OWJhc21vS21vWFExZG1KZjNKQThHbzRZdmRPOTQ5aVp2ZXE2U29WeXgrSyIsIm1hYyI6IjlhNWM4M2NiMmEwYjE5YTkzNmE3MGE5MjQ2ZDViNjhiYjQ1ZmU0MDZkNjYwOTA3MzNhNDgyZmJlMzUxZmFkYjIifQ==";
$url="https://thesieure.com/wallet/transfer";
$head=array(
"Host:thesieure.com",
"referer:https://thesieure.com/",
"cookie: $cookie"//ck tsr
);
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 10; SM-J600G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36");
curl_setopt($ch,CURLOPT_HTTPHEADER, $head);

$mr2 = curl_exec($ch);  
curl_close($ch); 
//dữ liệu
$data=explode("<tbody>", $mr2)[3];
$data=explode("</tbody>", $data)[0];
echo $data;
?>