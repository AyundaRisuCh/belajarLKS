<?php
require 'vendor/autoload.php';

use Aws\LexRuntimeV2\LexRuntimeV2Client;

$client = new LexRuntimeV2Client([
    'region' => 'us-east-1', // ganti dengan region bot kamu
    'version' => 'latest',
    'credentials' => [
        'key'    => 'AKIAXXXXXXXX',       // hanya jika tidak menggunakan IAM Role
        'secret' => 'YOUR_SECRET_KEY',
    ]
]);

try {
    $result = $client->recognizeText([
        'botAliasId' => 'TSTALIASID', // ganti
        'botId' => 'ABCDEF123',       // ganti
        'localeId' => 'en_US',        // ganti ke id_ID jika pakai bahasa Indonesia
        'sessionId' => 'user123',     // unik per user
        'text' => $_GET['pesan']      // input dari user
    ]);

    echo $result['messages'][0]['content'];

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
