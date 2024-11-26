<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  <link rel="stylesheet" href="">
</head>

<style type="">
  /* Basic Styling */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-sizing: border-box;
  }

  header, footer {
    background-color: #303331;
    width: 100%;
    padding: 1em;
    text-align: center;
    color: white;
  }

  #payment-options {
    width: 90%;
    max-width: 600px;
    margin: 2em auto;
    padding: 1.5em;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    text-align: center;
  }

  #payment-options h2 {
    margin-bottom: 1em;
    color: #333;
  }

  #payment-options button {
    display: block;
    width: 100%;
    max-width: 300px;
    margin: 0.5em auto;
    padding: 0.75em;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
  }

  #payment-options button:hover {
    background-color: #45a049;
  }

  footer {
    background-color: #4CAF50;
    color: white;
    width: 100%;
    text-align: center;
    padding: 1em 0;
  }

  /* Responsive Styling */
  @media (max-width: 768px) {
    #payment-options {
      width: 95%;
    }
  }
</style>

<body>
  <header>
    <h1>Payment</h1>
  </header>

  <section id="payment-options">
    <h2>Select Payment Method</h2>
    <button onclick="processPayment('Credit Card')">Credit Card</button>
    <button onclick="processPayment('Debit Card')">Debit Card</button>
    <button onclick="processPayment('UPI')">UPI</button>
  </section>

 <!--  <footer>
    <p>© 2024 Course Hub</p>
  </footer> -->

  <script>
    // Dummy function for processing payment
    function processPayment(method) {
      alert(`Processing payment via ${method}.`);
      // You could redirect to a confirmation page or simulate payment processing here
      window.location.href = "pay_verify.php";  // Replace with your confirmation page URL
    }
  </script>
</body>
</html>
