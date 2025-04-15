<?php
include('config.php');

$package_id = $_POST['package_id'] ?? null;
$adults = $_POST['adults'] ?? 0;
$children = $_POST['children'] ?? 0;

if (!$package_id) {
  echo json_encode(["error" => "Package ID missing"]);
  exit;
}

$query = "SELECT base_price, child_price, discount FROM packages WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $package_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
  echo json_encode(["error" => "Package not found"]);
  exit;
}

$stmt->bind_result($base_price, $child_price, $discount);
$stmt->fetch();
$stmt->close();

$adult_total = $adults * $base_price;
$child_total = $children * $child_price;
$total_before_discount = $adult_total + $child_total;
$discount_amount = ($total_before_discount * $discount) / 100;
$total_after_discount = $total_before_discount - $discount_amount;

$gst = 5;
$sgst = 5;
$total_tax_percent = $gst + $sgst;
$tax_amount = ($total_after_discount * $total_tax_percent) / 100;

$final_total = $total_after_discount + $tax_amount;

echo json_encode([
  "base_price" => $base_price,
  "child_price" => $child_price,
  "discount" => $discount,
  "adult_total" => $adult_total,
  "child_total" => $child_total,
  "total_before_discount" => $total_before_discount,
  "discount_amount" => round($discount_amount, 2),
  "total_after_discount" => round($total_after_discount, 2),
  "tax_amount" => round($tax_amount, 2),
  "final_total" => round($final_total, 2),
  "gst" => $gst,
  "sgst" => $sgst
]);
