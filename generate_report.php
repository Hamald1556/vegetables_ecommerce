<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Start session (if not already started)
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve user ID from session
} else {
    // Redirect user to login page or handle authentication failure
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vegetables_ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get report type and format from query parameters
$reportType = $_GET['type'];
$format = $_GET['format'];

if ($reportType === 'orders') {
    $sql = "SELECT cart_id, user_id, description, amount, category FROM cart";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch data
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Generate PDF
        if ($format === 'pdf') {
            // Initialize Dompdf
            $options = new Options();
            $options->set('defaultFont', 'Courier');
            $dompdf = new Dompdf($options);

            // HTML content for PDF
            $html = '<h2>Customer Orders Report</h2>';
            $html .= '<table border="1" width="100%" cellpadding="5">';
            $html .= '<thead><tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Category</th>
                      </tr></thead><tbody>';

            foreach ($rows as $row) {
                $html .= '<tr>
                            <td>' . $row['cart_id'] . '</td>
                            <td>' . $row['user_id'] . '</td>
                            <td>' . $row['description'] . '</td>
                            <td>' . $row['amount'] . '</td>
                            <td>' . $row['category'] . '</td>
                          </tr>';
            }

            $html .= '</tbody></table>';

            // Load HTML content
            $dompdf->loadHtml($html);

            // Set paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the PDF
            $dompdf->render();

            // Output the PDF to browser
            $dompdf->stream('orders_report.pdf', ['Attachment' => false]);
            exit();
        } elseif ($format === 'excel') {
            // Create new Spreadsheet object
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set header row
            $sheet->setCellValue('A1', 'ID')
                  ->setCellValue('B1', 'User ID')
                  ->setCellValue('C1', 'Description')
                  ->setCellValue('D1', 'Amount')
                  ->setCellValue('E1', 'Category');

            // Populate data rows
            $rowNumber = 2; // Start in cell 2
            foreach ($rows as $row) {
                $sheet->setCellValue('A' . $rowNumber, $row['cart_id'])
                      ->setCellValue('B' . $rowNumber, $row['user_id'])
                      ->setCellValue('C' . $rowNumber, $row['description'])
                      ->setCellValue('D' . $rowNumber, $row['amount'])
                      ->setCellValue('E' . $rowNumber, $row['category']);
                $rowNumber++;
            }

            // Write the file
            $writer = new Xlsx($spreadsheet);

            // Output to the browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="orders_report.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit();
        } else {
            die("Invalid format.");
        }
    } else {
        echo "No records found.";
    }
} else {
    echo "Invalid report type.";
}

$conn->close();
?>
