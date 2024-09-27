<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Proiect</title>
</head>

<body style="background-color:beige;">
    <?php include "./pages/menu.php" ?>
    <?php include "./pages/connect.php" ?>
    <?php connect() ?>

    <?php if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page == 0) include("./pages/homePage.php");
        if ($page == 1) include("./pages/tabel1.php");
        if ($page == 2) include("./pages/tabel2.php");
        if ($page == 3) include("./pages/sistemeAudio.php");
        if ($page == 4) include("./pages/pieseauto.php");
        if ($page == 5) include("./pages/autentificare.php");
    } ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>