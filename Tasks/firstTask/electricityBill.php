<?php
// event if the form has been submitted

$charges = "";
$surcharge = "";
$total = "";

if ($_POST) {
    $one = $_POST['input1'];
    if($one<=50){
        $charges = $one * 0.50;
    }elseif($one>50 and $one <= 150){
        $charges = $one * 0.75;
    }elseif($one>150 and $one <= 250){
        $charges = $one * 1.20;
    }elseif($one>250){
        $charges = $one * 1.50;
    }
    $surcharge = $charges * 0.2;
    $total = $charges + $surcharge;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Even OR Odd Num</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-4 offset-4">
                <div class="card ">
                    <div class="card-header text-center">
                        <h4> Put your Electricity Units </h1>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <label for="product">Electricity Units</label><br>
                            <input type="text" name="input1" placeholder="Enter Num" autofocus/><br>
                            <input type="submit" name="submit" value="Submit" /><br><br>
                        <div class="alert alert-success">
                            <h1 class="alert-heading text-center"> Your Bill </h1>
                            <ul>
                                <li>
                                    Your charges is : <?= $charges ?>
                                </li>
                                <li>
                                A   n additional surcharge of 20% is added to the bill is : <?= $surcharge ?>
                                </li>
                                <li>
                                    The Total is : <?= $total ?>
                                </li>
                            </ul>
                        </div>
                        </form>
                    </div>
                </div>
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