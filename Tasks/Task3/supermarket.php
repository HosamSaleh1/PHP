<?php

if (isset($_POST['enter-data'])) {
    $table = drawTable();
}

if (isset($_POST['calc-bill'])) {
    $bill = drawBill();
}

function drawTable()
{
    $table = '<table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>';
    for ($i = 1; $i <= $_POST['number']; $i++) {
        $table .= '<tr>
                                            <td>
                                                <input type="text" name="product_name' . $i . '" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" name="product_price' . $i . '" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" name="product_quantity' . $i . '" class="form-control">
                                            </td>
                                        </tr>';
    }
    $table .=        '</tbody>
                </table>
                <button class="btn btn-primary form-control" name="calc-bill"> Calculate Bill </button>
                ';
    return $table;
}

function drawBill()
{
    $bill = "<table class='table'>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>subTotal</th>
                    </tr>
                </thead>
                <tbody>";
    $total = 0;
    for ($i = 1; $i <= $_POST['number']; $i++) {
        $subTotal = $_POST['product_quantity' . $i] * $_POST['product_price' . $i];
        $total += $subTotal;
        $bill .=    "<tr>
                                        <td>
                                            {$_POST['product_name' .$i]}
                                        </td>
                                        <td>
                                            {$_POST['product_price' .$i]}
                                        </td>
                                        <td>
                                            {$_POST['product_quantity' .$i]}
                                        </td>
                                        <td>
                                            $subTotal EGP
                                        </td>
                                        
                                </tr>";
    }
    $percentage = calculatePercentage($total);
    $percentageValue = $percentage * 100;
    $discount = calcuateDiscount($total, $percentage);
    $totalAfterDiscount = $total - $discount;
    $delivery = calculateDelivery($_POST['city']);
    $finalTotal = $totalAfterDiscount + $delivery;
    $bill .= "<tr>
                            <th > Name</th>
                            <td colspan=4>
                                {$_POST['name']}
                            </td>
                    </tr>
                    <tr>
                            <th > City</th>
                            <td colspan=4>
                                {$_POST['city']}
                            </td>
                    </tr>
                    <tr>
                            <th > Total</th>
                            <td colspan=4>
                               $total EGP
                            </td>
                    </tr>
                    <tr>
                            <th > Discount Percentage</th>
                            <td colspan=4>
                               $percentageValue %
                            </td>
                    </tr>
                    <tr>
                            <th > Discount Value</th>
                            <td colspan=4>
                               $discount EGP
                            </td>
                    </tr>
                    <tr>
                            <th > Total After Discount</th>
                            <td colspan=4>
                                $totalAfterDiscount EGP
                            </td>
                    </tr>
                    <tr>
                            <th > Delivery</th>
                            <td colspan=4>
                                $delivery EGP
                            </td>
                    </tr>
                    <tr>
                            <th > Final Total </th>
                            <td colspan=4>
                                $finalTotal EGP
                            </td>
                    </tr>
                </tbody>
            </table>";
    return $bill;
}

function calculatePercentage($total)
{
    if ($total < 1000) {
        $percentage = 0;
    } elseif ($total >= 1000 and $total < 3000) {
        $percentage = 0.1;
    } elseif ($total >= 3000 and $total < 4500) {
        $percentage = 0.15;
    } else {
        $percentage = 0.2;
    }
    return $percentage;
}

function calcuateDiscount($total, $percentage)
{
    return $total * $percentage;
}

function calculateDelivery($city)
{
    switch ($city) {
        case 'cairo':
            return 0;
        case 'giza':
            return 30;
        case 'alex':
            return 50;
        default:
            return 100;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="h1 text-center text-dark"> SuperMarket </h1>
            </div>
            <div class="col-6 offset-3">
                <form method="post">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" name="name" id="Name" class="form-control" value="<?php if (isset($_POST['name'])) {
                                                                                                    echo $_POST['name'];
                                                                                                } ?>" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="City">City</label>
                        <select name="city" id="City" class="form-control">
                            <option <?php if (isset($_POST['city']) and $_POST['city'] == 'cairo') {
                                        echo "selected";
                                    } ?> value="cairo"> Cairo </option>
                            <option <?php if (isset($_POST['city']) and $_POST['city'] == 'giza') {
                                        echo "selected";
                                    } ?> value="giza"> Giza </option>
                            <option <?= (isset($_POST['city']) and $_POST['city'] == 'alex') ? 'selected' : ''  ?> value="alex"> Alex </option>
                            <option <?= (isset($_POST['city']) and $_POST['city'] == 'others') ? 'selected' : ''  ?> value="others"> Others </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number">Number Of Products</label>
                        <input type="number" name="number" id="number" value="<?php if (isset($_POST['number'])) {
                                                                                    echo $_POST['number'];
                                                                                } ?>" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-dark form-control" name="enter-data"> Enter Data </button>
                    </div>
                    <?php
                    if (isset($table)) {
                        echo $table;
                    }
                    if (isset($bill)) {
                        echo $bill;
                    }
                    ?>
                </form>

            </div>

        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>