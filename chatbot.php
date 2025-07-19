<?php
// Use the Conversation API to send a text message to Amazon Nova.

require 'vendor/autoload.php';

error_reporting(E_ALL);

ini_set('display_errors', 1); // Hide errors from being displayed in the browser
ini_set('log_errors', 1);    // Enable error logging
ini_set('error_log', '/path/to/your/error.log'); // Specify the log file

// Use the Conversation API to send a text message to Amazon Nova.

use Aws\BedrockRuntime\BedrockRuntimeClient;
use Aws\Exception\AwsException;
use RuntimeException;

header('Content-Type: application/json');

class Converse
{
    public function converse(string $userMessage): string
    {
        // Create a Bedrock Runtime client in the AWS Region you want to use.
        $client = new BedrockRuntimeClient([
            'region' => 'us-east-1',
            'version' => 'latest'
        ]);

        // Set the model ID, e.g., Amazon Nova Lite.
        $modelId = 'amazon.nova-micro-v1:0';

        $conversation = [
            [
                "role" => "user",
                "content" => [["text" => $userMessage]]
            ]
        ];

        try {
            $response = $client->converse([
                'modelId' => $modelId,
                'messages' => $conversation,
                'inferenceConfig' => [
                    'maxTokens' => 512,
                    'temperature' => 0.5
                ]
            ]);

            $responseText = $response['output']['message']['content'][0]['text'];
            return $responseText;
        } catch (AwsException $e) {
            http_response_code(500);
            return json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]);
        } catch (\Throwable $e) {
            http_response_code(500);
            return json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]);
        }
    }
}

// Ambil input dari URL (GET atau POST)
$inputMessage = $_GET['message'] ?? $_POST['message'] ?? null;

if (!$inputMessage) {
    http_response_code(400);
    echo json_encode([
        "error" => true,
        "message" => "Parameter 'message' is required"
    ]);
    exit;
}

$demo = new Converse();
$response = $demo->converse($inputMessage);

// Jika sudah JSON, langsung echo
if (is_string($response)) {
    echo $response;
} else {
    echo json_encode(["response" => $response]);
}
