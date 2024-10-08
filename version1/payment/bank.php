<?php
$order = $_SESSION['order_id'];

if (is_post()) {
    $name = req('name');
    $card = req('card');
    $cvv = req('cvv');
    $date = req('date');

    $validations = $_db->prepare('SELECT * FROM `bank` WHERE ccv = ? AND expires = ? AND card = ? AND name= ?');
        $validations->execute([$cvv,$date,$card,$name]);
        $validResult = $validations->fetch();

    if (!$name) {
        $_err['name'] = '  **Name is required  ';
    } else if (strlen($name) > 100) {
        $_err['name'] = '  **Maximum 100 characters allowed  ';
    }

    if (!$card) {
        $_err['card'] = '  **Card number is required';
    } else if (!preg_match('/^\d{16}$/', $card)) {
        $_err['card'] = '  **Card number must be 16 digits  ';
    }

    if (!$cvv) {
        $_err['cvv'] = '  **CVV is required  ';
    } else if (!preg_match('/^\d{3}$/', $cvv)) {
        $_err['cvv'] = '  **CVV must be 3 digits  ';
    }

    if (!$date) {
        $_err['date'] = '  **Expiration date is required  ';
    } else if (!preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $date)) {
        $_err['date'] = '  **Expiration date must be in MM/YY format  ';
    }

    if (!$_err) {
       
     if($validResult===false){      
        $_err['valid_card']="Invalid card details. Please check and try again.";
       
     }else{

        $stm = $_db->prepare('UPDATE `payment_record` SET datetime = NOW() WHERE  order_id = ?');
        $stm->execute([$order]);

        $stm = $_db->prepare('UPDATE `orders` SET status = ? WHERE  id = ?');
        $stm->execute(["Paid",$order]);

        redirect("../message/thanks.php");
     } 

        
    }
}



?>


<h3 style="color:red"><?= err('valid_card')   ?></h3>
<form id="card-form" method="post" class="hidden">
    <div class="form-group">
        <label for="name">Name on Card <span style="color:red;"><?= err('name')  ?></span></label>
        <?= html_text('name', 'placeholder="E.g Kim Ho"')  ?>
    </div>
    <div class="form-group">
        <label for="card">Card Number <span style="color:red;"><?= err('card')  ?></span></label>
        <?= html_text('card', 'placeholder=" 16 digits "')  ?>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="cvv">CVV <span style="color:red;"><?= err('cvv')  ?></span></label>
            <?= html_text('cvv', 'placeholder="E.g 123"')  ?>
        </div>
        <div class="form-group">
            <label for="date">Expiration Date <span style="color:red;"><?= err('date')  ?></span></label>
            <?= html_text('date', 'placeholder="MM/YY"')  ?>
        </div>
    </div>
    <div style="display:flex;gap:20px;">
        <div class="button">
            <button>Pay →</button>
        </div>
        <div class="button">
        <a href="../customer/customer.php" style="display: inline-block; padding: 10px 20px; background-color:black; color: white; text-align: center; text-decoration: none; border-radius: 5px; font-size: 16px;">
  <div>Later</div>
</a>

        </div>
    </div>
</form>