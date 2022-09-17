<?php
require_once ("helper/define.php");

$conn = new mysqli(HOST, USER, PASSWORD);  
mysqli_select_db($conn, 'lenskart');  
  
$setSql = "SELECT * FROM `customers` ORDER BY `id` DESC";  
$setRec = mysqli_query($conn, $setSql);  
  
$columnHeader = '';  
$columnHeader = "Customer Id" . "\t" . "Name" . "\t" . "Father" . "\t" . "Phone NO" . "\t"  . "Email Address" . "\t" . "Adderss" . "\t" . "City" . "\t" . "Pincode" . "\t" . "Location" . "\t" . "Investment Details" . "\t" . "Current Business" . "\t" . "Message" . "\t" . "Apply Date" . "\t" . "Last Updated" . "\t";  
  
$setData = '';  
  
while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=lesnkartCustomer_Info.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  

?>