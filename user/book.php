<?php
include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Now - iTravel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4 text-center">Book Your Package</h2>
  <form action="confirm-booking.php" method="post">
  <input type="hidden" name="package_id" id="package_id" value="<?= $_GET['id'] ?>">


    <div class="mb-3">
      <label for="booking_name" class="form-label">Your Name</label>
      <input type="text" class="form-control" id="booking_name" name="booking_name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email ID</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="mobile" class="form-label">Mobile Number</label>
      <input type="text" class="form-control" id="mobile" name="mobile" required pattern="[0-9]{10}">
    </div>

    <div class="mb-3">
      <label for="adults" class="form-label">Number of Adults</label>
      <input type="number" class="form-control" id="adults" name="adults" min="1" value="1" required>
    </div>

    <div class="mb-3">
      <label for="children" class="form-label">Number of Children</label>
      <input type="number" class="form-control" id="children" name="children" min="0" value="0" required>
    </div>

    <div class="text-center mb-4">
      <button type="button" id="fetchAmountBtn" class="btn btn-info">Fetch Payable Amount</button>
    </div>

    <div id="bookingOverview" style="display: none;">
      <div class="card">
        <div class="card-header bg-primary text-white">Booking Overview</div>
        <div class="card-body" id="overviewContent">
          <!-- Fetched data will be inserted here -->
        </div>
      </div>

      <div class="text-center mt-3">
  <button type="button" id="confirmBookingBtn" class="btn btn-primary px-4">
    Confirm Booking
  </button>
</div>

    </div>
  </form>
</div>

<script>
  $(document).ready(function () {
    $('#fetchAmountBtn').click(function () {
      const package_id = $('#package_id').val();
      const adults = $('#adults').val();
      const children = $('#children').val();

      $.ajax({
        url: 'calculate-amount.php',
        type: 'POST',
        data: {
          package_id: package_id,
          adults: adults,
          children: children
        },
        success: function (response) {
          const data = JSON.parse(response);
          $('#overviewContent').html(`
            <p><strong>Adults:</strong> ${adults} × ₹${data.base_price} = ₹${data.adult_total}</p>
            <p><strong>Children:</strong> ${children} × ₹${data.child_price} = ₹${data.child_total}</p>
            <p><strong>Total Before Discount:</strong> ₹${data.total_before_discount}</p>
            <p><strong>Discount (${data.discount}%):</strong> -₹${data.discount_amount}</p>
            <p><strong>Subtotal After Discount:</strong> ₹${data.total_after_discount}</p>
            <p><strong>GST (${data.gst}%) + SGST (${data.sgst}%):</strong> ₹${data.tax_amount}</p>
            <hr>
            <h5><strong>Final Payable Amount:</strong> ₹${data.final_total}</h5>
          `);
          $('#bookingOverview').show();
        }
      });
    });
  });
</script>
<!-- Razorpay JS -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>



</body>
</html>
