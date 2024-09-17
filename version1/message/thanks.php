
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/payment.css">
<title>Thank You</title>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column; 
        user-select: none;
    } 
  
  p{
    font-size:20px;
  }
  
   .amountpaid table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .amountpaid td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .amountpaid td:first-child {
        font-weight: bold;
        color: #333;
    }

    .amountpaid td span {
        color: red;
    }

    .container_thanks {
    opacity: 0;
    text-align: center;
    animation: rotateScaleFadeIn 1.5s ease forwards;
    background-color: white;
    padding: 50px;
    display: grid;
    place-items: center;
    gap:30px;
    border-radius:10px;
/*    box-shadow: -4px 3px 20px 17px rgba(0,0,0,0.1);*/
/*    border:2px solid rgb(173, 208, 16);*/
}
@keyframes rotateScaleFadeIn {
    0% {
        transform: rotate(-180deg) scale(0.5);
        opacity: 0;
    }
    50% {
        transform: rotate(0deg) scale(1.2);
        opacity: 1;
    }
    100% {
        transform: rotate(0deg) scale(1);
        opacity: 1;
    }
}
#okButton {
    padding: 10px 20px;
        font-size: 1em;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        opacity: 0;
        animation: slideInFromBottom 1s ease forwards;
        margin-top: 50px; 
/*        border:3px solid rgb(173, 208, 16);*/
        transform: translateY(100%);
}
@keyframes slideInFromBottom {
    to {
        opacity: 1;
        transform: translateY(0); 
    }
}

.amountpaid{
  display: grid;
  place-items: center;
  gap: 30px;
  font-size:17px;
}
</style>
</head>
<body>

<div class="container_thanks">
    <img src="../images/checked (1).png" width="100" height="100">
    <h1>Your payment was successful</h1>
    <p style="color:rgb(40, 125, 222);font-size:20px;" >Thank you for your payment. We will be in contact with more details shortly</p>
     <div class="amountpaid">

</div>
</div>
<form action="../customer/receiptGenerate.php" method="post">
<button id="okButton">OK</button>
</form>
<scrip></script>

</body>
</html>

