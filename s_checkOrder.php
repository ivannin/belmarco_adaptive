<?php
/*
Template Name: checkOrder
*/
?>
<?php

//  use DateTime;

  $shopId = "88235";
  $invoiceId = $_REQUEST['invoiceId'];

  function formatDate(\DateTime $date) {
    $performedDatetime = $date->format("Y-m-d") . "T" . $date->format("H:i:s") . ".000" . $date->format("P");
    return $performedDatetime;
  }

  function formatDateForMWS(\DateTime $date) {
    $performedDatetime = $date->format("Y-m-d") . "T" . $date->format("H:i:s") . ".000Z";
    return $performedDatetime;
  }

  $performedDatetime = formatDate(new DateTime());
  $response = '<?xml version="1.0" encoding="UTF-8"?><checkOrderResponse performedDatetime="' . $performedDatetime .
              '" code="0" invoiceId="' . $invoiceId . '" shopId="' . $shopId . '"/>';

  header("HTTP/1.0 200");
  header("Content-Type: application/xml");

  echo $response;

?>