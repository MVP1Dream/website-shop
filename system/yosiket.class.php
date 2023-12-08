<?php
class yosiket
{
  public function slip_check($qrcode)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => '45.141.26.156/mix1-slip.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('payload' => $qrcode),
      CURLOPT_HTTPHEADER => array(
        'User-Agent: mix1'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}
