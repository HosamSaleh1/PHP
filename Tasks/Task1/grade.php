<?php
// event if the form has been submitted

$percentage = "";
$grade = "";
if ($_POST) {
    $one = $_POST['input1'];
    $two = $_POST['input2'];
    $three = $_POST['input3'];
    $four = $_POST['input4'];
    $five = $_POST['input5'];
    $total = $one + $two + $three + $four + $five;
    $percentage = ($total * 100)/500;
    if ($percentage >= 90) {
        $grade = 'A';
    } elseif ($percentage >= 80 and $percentage <= 90) {
        $grade = 'B';
    } elseif ($percentage >= 70 and $percentage <= 80) {
        $grade = 'C';
    }elseif ($percentage >= 60 and $percentage <= 70) {
        $grade = 'D';
    } elseif ($percentage >= 40 and $percentage <= 60) {
        $grade = 'E';
    } elseif ($percentage < 40) {
        $grade = 'F';
    }
    $percentage .= '%';
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Grade & Percentage</title>
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
                        <h4> Put your Grades </h1>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <h3> Enter Your Grades</h3>
                            <label for="product">Physics Grade</label><br>
                            <input type="text" name="input1" placeholder="Enter Num" autofocus/><br>
                            <label for="product">Chemistry Grade</label><br>
                            <input type="text" name="input2" placeholder="Enter Num" /><br>
                            <label for="product">Biology Grade</label><br>
                            <input type="text" name="input3" placeholder="Enter Num" /><br><br>
                            <label for="product">Mathematics Grade</label><br>
                            <input type="text" name="input4" placeholder="Enter Num" /><br><br>
                            <label for="product">Computer Grade</label><br>
                            <input type="text" name="input5" placeholder="Enter Num" /><br><br>
                            <input type="submit" name="submit" value="Submit" /><br><br>
                        <div class="alert alert-success">
                            <h1 class="alert-heading text-center"> The Percentage </h1>
                            <ul>
                                <li>
                                    Your Percentage is : <?= $percentage ?>
                                </li>
                                <li>
                                    Your Grade is : <?= $grade ?>
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