<?php
if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];
    echo "<h2>Payment Successful!</h2>";
    echo "<p>Payment ID: $payment_id</p>";
    // Save booking details to DB here if needed
} else {
    echo "Payment failed or canceled.";
}
?>
