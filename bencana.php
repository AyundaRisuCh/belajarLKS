<?php
$db = new mysqli('localhost','user','pass','sigap_db');
if($_SERVER['REQUEST_METHOD']=='POST'){
    $jenis_bencana=$db->real_escape_string($_POST['jenis_bencana']);
    $lokasi=$db->real_escape_string($_POST['lokasi']);
    if(!empty($jenis_bencana)&&!empty($lokasi)){
        $db->query("INSERT INTO data_bencana(jenis_bencana,lokasi) VALUES('$jenis_bencana','$lokasi')")?
        print"Data tersimpan!":print"Error: ".$db->error;
    }else{print"Jenis dan lokasi wajib diisi!";}
}else{print"Hanya menerima POST!";}
?>
