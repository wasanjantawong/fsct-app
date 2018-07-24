<?php
    $DB['server'] = '163.44.196.236';
    $DB['user'] = 'fsctonli_it3';
    $DB['pass'] = 'fsctit';
    $DB['dbname'] = 'fsctonli_web';

    $conn = mysqli_connect($DB['server'], $DB['user'], $DB['pass'], $DB['dbname']);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        return '99';
    }else{
      mysqli_query($conn, 'SET NAMES UTF8');
    }

    $accessToken = "Ay1yPpXeiTi/ODaL+th3bGpdycIz3yKuKSbiPLSoXN2tA9UUMmjKd6gZ/Zy7oaxBMJN1s0OM/p4YtOEzSjxz6CVJ5mYEwc2t6EQklRXd74FqjFmHyY9MV0grBF9UkiI6VfZEWq6OhAmumMhgz1FIpAdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่

    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);

    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";

    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"

    $sql = "SELECT * FROM fsct_bot WHERE question like '%$message%' ";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $find = 0;

    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";

    if($result){
      while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $arrayPostData['messages'][0]['text'] = $data['answer'];//คำตอบ
            replyMsg($arrayHeader,$arrayPostData);
            $find++;
      }
      $find = 1;

      $arrayPostData['messages'][0]['text'] = $find;//คำตอบ
      replyMsg($arrayHeader,$arrayPostData);
    }

    if($find == 0){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = 'ไม่พบคำถาม กรุณาเพิ่มคำถามและคำตอบได้ที https://fsct-app.herokuapp.com/';//คำตอบ
        replyMsg($arrayHeader,$arrayPostData);
    }
    /*
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }*/
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
