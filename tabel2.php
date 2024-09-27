<?php
connect();
if (!isset($_POST["regBtn"])) { ?>

    <h1 style="margin-top: 50px; display:flex; flex-direction:row; justify-content:center">Tabel inserare motociclete</h1>

    <div class="row justify-content-center" style="margin-top: 30px;">
        <form action="mainPage.php?page=2" method="POST">
            <div class="form-group" style="width: 400px;">
                <label for="exampleInputEmail1">Marca</label>
                <input type="text" name="marca" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">An Fabricatie</label>
                <input type="text" name="anfabricatie" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Kilometraj</label>
                <input type="text" name="km" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Cai putere</label>
                <input type="text" name="putere" class="form-control">
            </div>

            <button type="submit" name="regBtn" class="btn btn-success">Register</button>
        </form>
    </div>

<?php
} else {
    if (submitMoto($_POST["anfabricatie"], $_POST["marca"], $_POST["km"], $_POST["putere"])) {
        header("refresh:0");
    }
}
?>
<?php
function submitMoto($anFabricatie, $marca, $km, $putere)
{
    if ($anFabricatie == "" || $marca == "" || $km == "" || $putere == "") {
        echo "<h3> <span style='color:red'> Toate campurile sunt obligatorii!</span> </h3>";
        return false;
        exit();
    }
    $ins = "INSERT INTO motociclete (marca, an_fabricatie, km, putere) VALUES('$marca','$anFabricatie','$km','$putere')";
    $link = mysqli_connect("localhost", "root", "", "proiect1");
    mysqli_query($link, $ins);
    return true;
};
$selectAllFromMoto = 'SELECT * FROM motociclete ORDER BY id ASC';
$res = mysqli_query($link, $selectAllFromMoto);
echo '<form action="mainPage.php?page=2" method="POST" class=" col justify-content-center" style="margin-top:80px;">';
echo '<table class="table table-stripped" style="width:900px;">';
echo '<thead class=bg-success >';
echo '<th class="col " > ID </th>';
echo '<th class="col";  > An fabricatie </th>';
echo '<th class="col " > Marca </th>';
echo '<th class="col " > Check to delete </th>';
echo '</thead>';
while ($row = mysqli_fetch_array($res)) {
    echo '<tr>';
    echo '<td>' . $row[0] . '</td>';
    echo '<td>' . $row[1] . '</td>';
    echo '<td>' . $row[2] . '</td>';
    echo '<td><input type="checkbox" name="cb' . $row[0] . '"></td>';
    echo '</tr>';
}
echo "</table>"; ?>
<div style="display:flex;justify-content:start;margin-bottom:100px">
    <input type="submit" name="delmoto" value="Delete" class="btn btn-sm btn-danger">
</div>
<?php
if (isset($_POST['delmoto'])) {
    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 2) == "cb") {
            $idc = substr($key, 2);
            $del = "DELETE FROM motociclete WHERE id = '$idc'";
            mysqli_query($link, $del);
        }
    }
    header("refresh:0");
}
