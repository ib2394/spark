<?php
session_start();
include('../../config/config.php');

// Check if the user is logged in
if (!isset($_SESSION['studid'])) {
    echo "<script type='text/javascript'>alert('Student Username is not set in the session');</script>";
    exit();
}

// Get the student username from session
$studid = $_SESSION['studid'];

// Initialize total price
$totalPrice = 0;

// Check if parcels were selected
if (!isset($_POST['parcel']) || !is_array($_POST['parcel'])) {
    echo "No parcels selected.";
    exit();
}

// Decode selected parcels
$selectedParcels = array_map('json_decode', $_POST['parcel']);

// Calculate total price
$totalPrice = array_reduce($selectedParcels, function($sum, $parcel) {
    return $sum + $parcel->price;
}, 0);

// Function to get payid based on payment method
function getPayId($payMethod) {
    $payMethods = [
        'CASH' => 1,
        'QR' => 2
    ];
    return $payMethods[$payMethod] ?? null;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['proofFile'])) {
    // Handle file upload for payment proof
    $proofFile = $_FILES['proofFile'];
    $proofFileName = $_FILES['proofFile']['name'];
    $proofFileTmpName = $_FILES['proofFile']['tmp_name'];
    $proofFileSize = $_FILES['proofFile']['size'];
    $proofFileError = $_FILES['proofFile']['error'];
    $proofFileType = $_FILES['proofFile']['type'];

    // File extension
    $fileExt = explode('.', $proofFileName);
    $fileActualExt = strtolower(end($fileExt));

    // Allowed file types
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    // Check if file type is allowed
    if (in_array($fileActualExt, $allowed)) {
        if ($proofFileError === 0) {
            if ($proofFileSize < 1000000) { // 1MB limit
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../../uploads/' . $fileNameNew;
                move_uploaded_file($proofFileTmpName, $fileDestination);

                // Insert payment method into 'payments' table
                $payMethod = mysqli_real_escape_string($con, $_POST['payMethod']);
                $payId = getPayId($payMethod);

                foreach ($selectedParcels as $parcel) {
                    $trackingNumber = mysqli_real_escape_string($con, $parcel->trackingNumber);

                    // Update proof of payment location and payid in 'parcel' table
                    $updateParcelQuery = "UPDATE parcel SET proofFile = '$fileDestination', payid = '$payId', payStatus = 'PAID' WHERE trackingNumber = '$trackingNumber' AND studid = '$studid'";
                    if (mysqli_query($con, $updateParcelQuery)) {
                        echo "<script type='text/javascript'>alert('Proof of payment saved successfully for tracking number: $trackingNumber');</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('Error: Could not update proof of payment location for tracking number: $trackingNumber.');</script>";
                    }
                }

                // Optionally redirect after successful operations
                // header('Location: success.php');
            } else {
                echo "<script type='text/javascript'>alert('Your file is too big!');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('There was an error uploading your file!');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('You cannot upload files of this type!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Interface</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 2rem;
        }
        .qr-code {
            flex: 0 0 30%;
            max-width: 30%;
            text-align: center;
        }
        .payment-form {
            flex: 1;
            max-width: 60%;
        }
        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #4a4a4a;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #555;
        }
        select, input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        select:focus, input[type="file"]:focus {
            border-color: #921BA3;
        }
        button[type="submit"] {
            background-color: #921BA3;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
            transition: background 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #357abd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="qr-code">
            <h3>Scan QR Code for Payment</h3>
            <img src="../../pictures/qrPay.jpg" alt="QR Code for Payment" style="max-width: 100%;">
        </div>
        <div class="payment-form">
            <h2>Pay Selected Parcels</h2>
            <div class="total-price">
                Total Price: <?php echo htmlspecialchars($totalPrice); ?>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="payMethod">Payment Method:</label>
                    <select name="payMethod" id="payMethod" required>
                        <option value="CASH">CASH</option>
                        <option value="QR">QR</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="proofFile">Proof of Payment:</label>
                    <input type="file" name="proofFile" id="proofFile" required>
                </div>
                <?php foreach ($selectedParcels as $parcel): ?>
                    <input type="hidden" name="parcel[]" value="<?php echo htmlspecialchars(json_encode($parcel)); ?>">
                <?php endforeach; ?>
                <button type="submit">Submit Payment</button>
            </form>
        </div>
    </div>
</body>
</html>
