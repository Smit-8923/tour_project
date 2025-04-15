<?php
require('vendor/autoload.php'); // Path to Razorpay SDK

use Razorpay\Api\Api;

header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

// Razorpay credentials (TEST MODE)
$key = 'YOUR_KEY_ID';
$secret = 'YOUR_SECRET';

$api = new Api($key, $secret);

$order = $api->order->create([
    'receipt' => 'rcptid_' . rand(1000, 9999),
    'amount' => $input['amount'] * 100, // Amount in paise
    'currency' => 'INR'
]);

echo json_encode([
    'order_id' => $order['id'],
    'amount' => $order['amount'],
    'key' => $key
]);
?>
