<?php
connect();
if (!isset($_POST["regBtn"])) { ?>

    <h1 style="margin-top: 50px; display:flex; flex-direction:row; justify-content:center">Tabel inserare automobile</h1>

    <div class="row justify-content-center" style="margin-top:30px;">
        <form action="mainPage.php?page=1" method="POST">
            <div class="form-group" style="width: 400px;">
                <label for="cars">Marca</label>
                <select name="marca" class="form-control">
                    <option value="Audi">Audi</option>
                    <option value="Aston Martin">Aston Martin</option>
                    <option value="BMW">BMW</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="Dodge">Dodge</option>
                    <option value="Ford">Ford</option>
                    <option value="Hyundai">Hyundai</option>
                    <option value="Kia">Kia</option>
                    <option value="Porsche">Porsche</option>
                    <option value="Volvo">Volvo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" class="form-control">
            </div>

            <div class="form-group">
                <label for="an">An Fabricatie</label>
                <input type="text" name="anfabricatie" class="form-control">
            </div>
            <div class="form-group">
                <label for="kilo">Kilometraj</label>
                <input type="text" name="km" class="form-control">
            </div>
            <div class="form-group">
                <label for="hp">Cai putere</label>
                <input type="text" name="putere" class="form-control">
            </div>

            <button type="submit" name="regBtn" class="btn btn-success">Register</button>
        </form>
    </div>

<?php
} else {
    if (submitCar($_POST["anfabricatie"], $_POST["marca"], $_POST["model"], $_POST["km"], $_POST["putere"]))
        header("refresh:0");
}
?>
<?php
function submitCar($anFabricatie, $marca, $model, $km, $putere)
{
    if ($anFabricatie == "" || $marca == "" || $model == "" || $km == "" || $putere == "") {
        echo "<h3> <span style='color:red'> Toate campurile sunt obligatorii!</span> </h3>";
        return false;
    }
    $ins = "INSERT INTO cars (marca, model, an_fabricatie, km, putere) VALUES('$marca','$model','$anFabricatie','$km','$putere')";
    $link = mysqli_connect("localhost", "root", "", "proiect1");
    mysqli_query($link, $ins);
    return true;
};

$selectAllFromCars = 'SELECT * FROM cars ORDER BY id ASC';
$res = mysqli_query($link, $selectAllFromCars);
echo '<form action="mainPage.php?page=1" method="POST" class=" col justify-content-center" style="margin-top:80px;">';
echo '<table class="table table-stripped" style="width:900px;">';
echo '<thead class=bg-success >';
echo '<th class="col " > ID </th>';
echo '<th class="col"  > An fabricatie </th>';
echo '<th class="col " > Marca </th>';
echo '<th class="col " > Model </th>';
echo '<th class="col " > Check to delete </th>';
echo '</thead>';
while ($row = mysqli_fetch_array($res)) {
    echo '<tr>';
    echo '<td>' . $row[0] . '</td>';
    echo '<td>' . $row[1] . '</td>';
    echo '<td>' . $row[2] . '</td>';
    echo '<td>' . $row[3] . '</td>';
    echo '<td><input type="checkbox" name="cb' . $row[0] . '"></td>';
    echo '</tr>';
}
echo "</table>"; ?>
<div style="display:flex;justify-content:start;margin-bottom:100px;">
    <input type="submit" name="delcar" value="Delete" class="btn btn-sm btn-danger">
</div>
<?php
if (isset($_POST['delcar'])) {
    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 2) == "cb") {
            $idc = substr($key, 2);
            $del = "DELETE FROM cars WHERE id = '$idc'";
            mysqli_query($link, $del);
        }
    }
    header("refresh:0");
}
