<?php
$host = '127.0.0.1';
$db   = 'patients_db';   // change this ONLY if your database name is different
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// CONNECT TO DATABASE
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    header("Location: index.php?success=0");
    exit;
}

// ONLY ALLOW POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// GET FORM DATA
$name           = trim($_POST['name'] ?? '');
$age            = trim($_POST['age'] ?? '');
$gender         = trim($_POST['gender'] ?? '');
$phone          = trim($_POST['phone'] ?? '');
$symptoms       = trim($_POST['symptoms'] ?? '');
$payment        = trim($_POST['payment'] ?? '0');
$payment_method = trim($_POST['payment_method'] ?? '');

// VALIDATION
$errors = [];

if ($name === '') $errors[] = "Name required";
if ($age === '' || !is_numeric($age)) $errors[] = "Invalid age";
if ($gender === '') $errors[] = "Gender required";
if ($phone === '') $errors[] = "Phone required";
if ($symptoms === '') $errors[] = "Symptoms required";
if ($payment === '' || !is_numeric($payment)) $errors[] = "Invalid payment";
if ($payment_method === '') $errors[] = "Payment method required";

// IF ERROR → BACK TO FORM
if (!empty($errors)) {
    header("Location: index.php?success=0");
    exit;
}

// INSERT DATA
$sql = "INSERT INTO patients 
(name, age, gender, phone, symptoms, payment, payment_method, created_at)
VALUES 
(:name, :age, :gender, :phone, :symptoms, :payment, :payment_method, NOW())";

try {
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':name' => $name,
        ':age' => (int)$age,
        ':gender' => $gender,
        ':phone' => $phone,
        ':symptoms' => $symptoms,
        ':payment' => (float)$payment,
        ':payment_method' => $payment_method,
    ]);

    header("Location: index.php?success=1");
    exit;

} catch (PDOException $e) {
    header("Location: index.php?success=0");
    exit;
}
?>
