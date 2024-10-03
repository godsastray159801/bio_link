<?php
require 'vendor/autoload.php'; // Nếu bạn sử dụng Composer

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Tạo kết nối đến Firebase
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase_credentials.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$firestore = $firebase->getFirestore();
$collection = $firestore->collection('contact_requests');

// Lấy dữ liệu từ form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Lưu dữ liệu vào Firestore
$collection->add([
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'created_at' => new \DateTime() // Thêm thời gian tạo
]);

echo "Yêu cầu đã được gửi thành công!";
?>