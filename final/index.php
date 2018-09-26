<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hack Game</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
<?php
session_start();
if (!isset($_SESSION['endOfTimer'])) {
    $endOfTimer = time() + 10;
    $_SESSION['endOfTimer'] = $endOfTimer;
}

if (($_SESSION['endOfTimer'] - time()) < 0) {
    $timeTilEnd = 0;
} else {
    $timeTilEnd = $_SESSION['endOfTimer'] - time();
}

if ($timeTilEnd <= 0) {
    session_destroy();
}

?>

<h2>Plus que <span id="timer"><?php echo $timeTilEnd; ?></span> secondes</h2>


<script>
    var TimeLeft = <?php echo $timeTilEnd; ?>;

    function countdown() {
        if (TimeLeft > 0) {
            TimeLeft -= 1;
            document.getElementById('timer').innerHTML = TimeLeft;
        }
        if (TimeLeft < 1) {
            window.location = "congratulations/"
        }
    }

    CountFunc = setInterval(countdown, 1000);
</script>


<div class="button-wrap">
    <a href="lost-final/">
        <button type="button">RÉCUPÈRE TES DONNÉES<span>Aller tu y es presque !</span></button>
    </a>
</div>
</body>

</html>