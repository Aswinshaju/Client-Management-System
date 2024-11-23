<?php
session_start();
include('includes/dbconnection.php');

// Check if the payment button is clicked
if (isset($_GET['payment_btn']) && isset($_GET['invoiceid'])) {
    // Assuming invoice ID is passed through the URL
    $invoice_id = $_GET['invoiceid'];

    try {
        // Update the payment status to 'paid' for the given invoice ID
        $update_query = "UPDATE tblinvoice SET payment_status = 'paid' WHERE BillingId = :invoice_id";
        $stmt = $dbh->prepare($update_query);
        $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: invoices.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating payment status: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <script type="text/javascript" src="scripts.js"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&family=Montserrat:wght@600&display=swap');

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}


body {
  background-color: #686868;
  align-content: center;
  text-align: center;
}

.credit-card-form {
  margin-top: 10%;
  margin-left: 35%;
  max-width: 400px;
  padding: 1em;
  border-radius: 10px;
  box-shadow: 0px 6px 10px rgba(255, 255, 255, 0.1);
  font-family: 'Montserrat', sans-serif;
  background-color: #dbdbdb;
  text-align: center;
  color: #424242;
  align-content: center;
}

.credit-card-form h2 {
  margin-bottom: 10%;
  font-size: 24px;
}

.credit-card-form .form-group {
  margin-bottom: 15px;

}

.credit-card-form label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
  color: #777;
}

.credit-card-form input[type="text"],
.credit-card-form select {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 1rem;
  font-size: 16px;
    font-family: 'Montserrat', sans-serif;
}

.credit-card-form .form-row {
  display: flex;
}


.credit-card-form button[type="submit"] {
  width: 100%;
  padding: 14px;
  background-color: #585858;
  color: #fff;
  border: none;
  border-radius: 1rem;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
  font-family: 'Montserrat', sans-serif;
}

.credit-card-form button[type="submit"]:hover {
  background-color: #808080;
  color: #424242;
  font-family: 'Montserrat', sans-serif;
  box-shadow: 0px 6px 10px rgba(255, 255, 255, 0.1);
}

.credit-card-form button[type="submit"]:focus {
  outline: none;
  font-family: 'Montserrat', sans-serif;
}

p {
  color: white;
  margin-top: 6%;
  font-family: 'Montserrat', sans-serif;
  text-align: center;
  margin-bottom: 45px;
  font-size: 70%;
  text-shadow: 0 0 5px #cacaca; 
}

.Image1 {
  margin-top: 0;
  width: 220px;
}
.h2 {
  margin: 0px;
}
</style>
<body>
  <div class="credit-card-form">
    <h2>PAYMENT PORTAL</h2>
<img class="Image1" src="https://i.ibb.co/hgJ7z3J/6375aad33dbabc9c424b5713-card-mockup-01.png" alt="6375aad33dbabc9c424b5713-card-mockup-01" border="0"></a>
  
    <form method="GET" action="payment.php">
    <input type="hidden" name="invoiceid" value="<?php echo isset($_GET['invoiceid']) ? $_GET['invoiceid'] : ''; ?>">
    <div class="form-group">
        <label for="card-number">Enter price</label>
        <input type="text" id="card-number" placeholder="Price" required>
      </div>
      <div class="form-group">
        <label for="card-number">Card Number</label>
        <input type="text" id="card-number" placeholder="Card number" required>
      </div>
      <div class="form-group">
        <label for="card-holder">Card Holder</label>
        <input type="text" id="card-holder" placeholder="Card holder's name" required>
      </div>
      <div class="form-row">
        <div class="form-group form-column">
          <label for="expiry-date">Expiry Date</label>
          <input type="text" id="expiry-date" placeholder="MM/YY" required>
        </div>
        <div class="form-group form-column">
          <label for="cvv">CVV</label>
          <input type="text" id="cvv" placeholder="CVV" required>
        </div>
      </div>
      <button type="submit" class="click-button" name="payment_btn">PAY NOW - Rs(TOTAL)</button>
    </form>
  </div>
</body>
</html>