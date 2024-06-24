<?php
session_start();
include('../../config/config.php'); // Adjust path as necessary

// Ensure user is logged in
if (!isset($_SESSION['studid'])) {
    echo "User is not logged in.";
    exit();
}

// Retrieve parcels from the database
$query = "SELECT * FROM parcel WHERE studid = '".$_SESSION['studid']."' AND payStatus = 'UNPAID'";
$result = mysqli_query($con, $query);
$parcels = [];
while ($row = mysqli_fetch_assoc($result)) {
    $parcels[] = $row;
}

// Validate and sanitize page number
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    $page = 1;
}

// Define number of results per page
$results_per_page = 10;

// Calculate start index for pagination
$start_from = ($page - 1) * $results_per_page;

// Sanitize and prepare search query
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Fetch total records for the logged-in user
$studid = $_SESSION['studid'];

if (!empty($search_query)) {
    $total_query = "SELECT COUNT(*) AS total FROM parcel WHERE studid = '$studid' AND payStatus = 'UNPAID' AND (trackingNumber LIKE '%$search_query%' OR courname LIKE '%$search_query%' OR size LIKE '%$search_query%' OR status LIKE '%$search_query%' OR price LIKE '%$search_query%')";
} else {
    $total_query = "SELECT COUNT(*) AS total FROM parcel WHERE studid = '$studid' AND payStatus = 'UNPAID'";
}

$total_result = mysqli_query($con, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

// Calculate total pages
$total_pages = ceil($total_records / $results_per_page);

// Fetch data for current page for the logged-in user
if (!empty($search_query)) {
    $query = "SELECT trackingNumber, courname, size, status, payStatus, price FROM parcel WHERE studid = '$studid' AND payStatus = 'UNPAID' AND (trackingNumber LIKE '%$search_query%' OR courname LIKE '%$search_query%' OR size LIKE '%$search_query%' OR status LIKE '%$search_query%' OR price LIKE '%$search_query%') LIMIT $start_from, $results_per_page";
} else {
    $query = "SELECT trackingNumber, courname, size, status, payStatus, price FROM parcel WHERE studid = '$studid' AND payStatus = 'UNPAID' LIMIT $start_from, $results_per_page";
}

$result = mysqli_query($con, $query);

// Fetch the unpaid parcels
$unpaidParcels = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Output results (e.g., in a table)
if (!$unpaidParcels) {
    echo "No unpaid parcels found for this user.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Unpaid Parcels</title>
    <style>
        /* General Reset and Typography */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1300px;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            font-size: 2rem;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: 500;
            font-size: 1rem;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 0.5rem;
        }

        .pagination a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 1rem;
        }

        .pagination a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            color: #333;
            font-size: 1.2rem;
            margin: 2rem 0;
        }

        .search-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .search-input {
            padding: 0.75rem;
            width: 70%;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .search-button {
            padding: 0.75rem 1.5rem;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin-left: 0.5rem;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .search-button:hover {
            background-color: #222;
        }

        .pay-button {
            background-color: #333;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s ease;
            margin: 1rem 0;
        }

        .pay-button:hover {
            background-color: #222;
        }

        .chip {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 0.2rem;
            border-radius: 16px;
            background-color: #e0e0e0;
            cursor: pointer;
            user-select: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .chip.selected {
            background-color: #333;
            color: #fff;
        }

        .chip input {
            display: none;
        }
    </style>
    <script>
        function toggleSelection(chip) {
            chip.classList.toggle('selected');
            const checkbox = chip.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
        }

        function validateSelection() {
            const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            if (selectedCheckboxes.length === 0) {
                alert("Please select at least one parcel to pay.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>List of Unpaid Parcels</h2>
        <div class="search-container">
            <form method="get" action="viewPay.php">
                <input type="text" name="search" class="search-input" placeholder="Search parcels..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>
        <form method="post" action="studentPay.php" onsubmit="return validateSelection();">
            <?php if (!empty($unpaidParcels)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Tracking Number</th>
                            <th>Courier Name</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unpaidParcels as $parcel) : ?>
                            <tr>
                                <td>
                                    <div class="chip" onclick="toggleSelection(this)">
                                        <input type="checkbox" name="parcel[]" value="<?php echo htmlspecialchars(json_encode($parcel)); ?>">
                                        Select
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($parcel['trackingNumber']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['courname']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['size']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['status']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['payStatus']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['price']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="message">No unpaid parcels found.</div>
            <?php endif; ?>
            <button type="submit" class="pay-button">Proceed to Payment</button>
        </form>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<li><strong>$i</strong></li>";
                } else {
                    echo "<li><a href='viewPay.php?page=$i&search=" . urlencode($search_query) . "'>$i</a></li>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
