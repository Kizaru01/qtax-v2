<?php
// set_time_limit(0);
// $filename  = dirname(__FILE__).'/_servepayment.txt';

// // store new message in the file
// $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
// if ($msg != '')
// {
//   file_put_contents($filename,$msg);
//   die();
// }

// // infinite loop until the data file is not modified
// $lastmodif    = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
// $currentmodif = filemtime($filename);
// while ($currentmodif <= $lastmodif) // check if the data file has been modified
// {
//   usleep(10000); // sleep 10ms to unload the CPU
//   clearstatcache();
//   $currentmodif = filemtime($filename);
// }

// // return a json array
// $response = array();
// // $response['msg']       = file_get_contents($filename);
// $response['timestamp'] = $currentmodif;
// echo json_encode($response);
// flush();




set_time_limit(0);

// Define filenames
$filename1 = dirname(__FILE__) . '/_servepayment.txt';
$filename2 = dirname(__FILE__) . '/_servepayment_verify.txt';

// Store new message in the first file
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
if ($msg != '') {
    file_put_contents($filename1, $msg);
    die();
}

// Infinite loop until one of the data files is modified
$lastmodif = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
$currentmodif1 = filemtime($filename1);
$currentmodif2 = filemtime($filename2);
while ($currentmodif1 <= $lastmodif && $currentmodif2 <= $lastmodif) {
    usleep(10000); // sleep 10ms to unload the CPU
    clearstatcache();
    $currentmodif1 = filemtime($filename1);
    $currentmodif2 = filemtime($filename2);
}

// Return a JSON array
$response = array();
$response['timestamp'] = max($currentmodif1, $currentmodif2);
echo json_encode($response);
flush();
?>