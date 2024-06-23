<?php
session_start();
include ('../../config/config.php');

// Define the number of results per page
$results_per_page = 10; // You can adjust this value

// Determine the current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $results_per_page;

// Determine if there is a search query
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

if (isset($_SESSION['studid'])) {
    $studid = $_SESSION['studid'];

    // Fetch the number of total rows based on the search query
    if (!empty($search_query)) {
        $total_query = "SELECT COUNT(*) AS total FROM parcel WHERE payStatus = 'UNPAID' AND (trackingNumber LIKE '%$search_query%' OR courname LIKE '%$search_query%' OR size LIKE '%$search_query%' OR status LIKE '%$search_query%')";
    } else {
        $total_query = "SELECT COUNT(*) AS total FROM parcel WHERE payStatus = 'UNPAID'";
    }
    $total_result = mysqli_query($con, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_records = $total_row['total'];

    // Calculate the total number of pages
    $total_pages = ceil($total_records / $results_per_page);

    // Fetch data for the current page based on the search query
    if (!empty($search_query)) {
        $query = "SELECT trackingNumber, courname, size, status, payStatus FROM parcel WHERE payStatus = 'UNPAID' AND (trackingNumber LIKE '%$search_query%' OR courname LIKE '%$search_query%' OR size LIKE '%$search_query%' OR status LIKE '%$search_query%') LIMIT $start_from, $results_per_page";
    } else {
        $query = "SELECT trackingNumber, courname, size, status, payStatus FROM parcel WHERE payStatus = 'UNPAID' LIMIT $start_from, $results_per_page";
    }
    $result = mysqli_query($con, $query);

    // Check if any rows were returned
    $unpaidParcels = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "User is not logged in.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Unpaid Parcels</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #645CBB;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #645CBB;
            color: #fff;
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
            color: #645CBB;
            font-weight: bold;
        }
        .pagination a:hover {
            text-decoration: underline;
        }
        .message {
            text-align: center;
            color: #645CBB;
            font-size: 1.2rem;
        }
        .search-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        .search-input {
            padding: 0.5rem;
            width: 60%;
            font-size: 1rem;
        }
        .search-button {
            padding: 0.5rem 1rem;
            background-color: #645CBB;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        .search-button:hover {

> Atiq👽:
background-color: #5145a3;
        }
        .pay-button {
    background-color: #645CBB;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    cursor: pointer;
    border-radius: 20px;
    font-size: 1rem;
    text-decoration: none; /* Ensure button inside <a> tag doesn't get underlined */
    display: inline-block; /* Make sure button behaves correctly inside the anchor tag */
    transition: background 0.3s ease;
}

.pay-button:hover {
    background-color: #524a99;
}

        .chip {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 0.2rem;
            border-radius: 16px;
            background-color: #e0e0e0;
            cursor: pointer;
            user-select: none;
        }
        .chip.selected {
            background-color: #645CBB;
            color: #fff;
        }
    </style>
    <script>
        function toggleSelection(chip) {
            chip.classList.toggle('selected');
            const checkbox = chip.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
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
        <form method="post" action="processPayment.php">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unpaidParcels as $parcel) : ?>
                            <tr>
                                <td>
                                    <div class="chip" onclick="toggleSelection(this)">
                                        <input type="checkbox" name="parcels[]" value="<?php echo htmlspecialchars($parcel['trackingNumber']); ?>" style="display:none;">
                                        Select
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($parcel['trackingNumber']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['courname']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['size']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['status']); ?></td>
                                <td><?php echo htmlspecialchars($parcel['payStatus']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="../../pages/student/studentPay.php" class="pay-button">
                    <button type="button" class="pay-button">Pay Selected Parcels</button>
                </a>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li>
                            <a href="viewPay.php?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search_query); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            <?php else : ?>
                <p class="message">No unpaid parcels found.</p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>