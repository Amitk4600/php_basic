<?php


if (isset($_SESSION['registration_alert'])) {
    echo '<div  style="
    color: #0019ff;
    position: absolute;
      bottom: 43%;
      padding: 5px;
      border-radius: 5px;
      font-size: 18px;
      left: 38%;
      background: transparent;
     ">' . $_SESSION['registration_alert'] . '</div>';
    unset($_SESSION['registration_alert']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        form {
             width: 400px;
            margin: auto;
            position: relative;
            top: 80px;
        }
       
    </style>
</head>

<body>
    <form action="./send_request_process.php" method="post">
        <div class="form-group p-3 mt-1 d-flex flex-column align-items-center justify-content-center ">
            <input type="number" class="form-control" name="amt" id="" placeholder="Enter amount" required>
            <label for="amount">Send Request</label>
            <textarea class="form-control" id="" rows="3" name="textarea" required></textarea>
            <input type="submit" value="send" class="mt-3 py-2 px-4 btn btn-dark"  name="submit">
        </div>
    </form>
</body>

</html>