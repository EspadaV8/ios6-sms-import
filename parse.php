<?php
$count = 0;
$messages = "";
if  (($handle = fopen('sms.csv', 'r')) !== false) {
    while(($data = fgetcsv($handle)) !== false) {
        $count++;
        $messages .= '<sms protocol="' . $data[0] . '" ' .
            'address="' . $data[1] . '" '.
            'date="' . $data[2] . '000" '.
            'type="' . $data[3] . '" '.
            'subject="null" ' . // $data[4] . '" '.
            'body="' . htmlentities($data[5], ENT_COMPAT) . '" '.
            'toa="null" ' .  // $data[6] . '" '.
            'sc_toa="null" ' . // $data[7] . '" '.
            'service_center="' . $data[8] . '" '.
            'read="' . $data[9] . '" '.
            'status="' . $data[10] . '" '.
            ' />' . PHP_EOL;
    }
}
$output = "<?xml version='1.0' encoding='UTF-8' standalone='yes' ?>" . PHP_EOL;
$output .= '<smses count="' . $count . '">' . PHP_EOL;
$output .= $messages;
$output .= "</smses>" . PHP_EOL;

file_put_contents('sms.xml', $output);
