<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        display: flex;
        flex-direction: column;
    }

    .formular {
        display: flex;
        flex-direction: column;
        margin-bottom: 100px;
    }

    h1 {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 100px;
        margin-top: 100px;
    }

    .mare {
        width: 60%;
        margin: auto;
        background-color: white;
        padding: 40px 0px 40px 20px;
    }


    .secondForm {
        display: flex;
        flex-direction: column;
        width: 60%;
        margin: auto;
        border: 2px solid black;
        margin-bottom: 20px;
        padding: 20px;
    }

    .secondForm th,
    td,
    tr {

        border: 1px solid black;
        margin: auto;
        margin-top: 100px;
        padding: 20px 40px 20px 40px;
        margin-bottom: 30px;
        font-size: 20px;
        color: limegreen;

    }

    .inputClass {
        display: flex;
        justify-content: flex-end;
    }
</style>

<body>
    <h1>Formular de incarcare piese auto </h1>
    <div class="formular">
        <form action="mainPage.php?page=4" method="POST" class="mare">
            <h3>Ce doresti sa adaugi ?</h3>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="utilizareVehicul">Utilizare vehicul</label>
                    <select name="utilVeh" class="form-control">
                        <option value="pieseAuto">Piese auto</option>
                        <option value="pieseCamion">Piese camioane</option>
                        <option value="pieseMoto">Piese motociclete</option>
                        <option value="pieseRemorci">Piese remorci si semiremorci</option>
                        <option value="pieseUtilAgricole">Piese utilaje agricole</option>
                        <option value="pieseutilContructii">Piese utilaje constructii</option>
                        <option value="pieseVehiculeCom">Piese vehicule comerciale</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="brand">Brand</label>
                    <select name="brand" class="form-control">
                        <option value="audi">Audi</option>
                        <option value="bmw">BMW</option>
                        <option value="bosh">BOSH</option>
                        <option value="cat">Caterpillar</option>
                        <option value="daf">DAF</option>
                        <option value="ford">Ford</option>
                        <option value="gmc">GMC</option>
                        <option value="haldex">HALDEX</option>
                        <option value="iveco">Iveco</option>
                        <option value="lexus">Lexus</option>
                        <option value="man">MAN</option>
                        <option value="mazda">Mazda</option>
                        <option value="michelin">Michelin</option>
                        <option value="skoda">Skoda</option>
                        <option value="tvr">TVR</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="tip">Tip</label>
                    <select name="tip" class="form-control">
                        <option value="Anvelope">Anvelope</option>
                        <option value="Climatizare">Climatizare</option>
                        <option value="Consumabile si Accesorii">Consumabile si Accesorii</option>
                        <option value="Cutie de viteze, ambreiaj, transmisie">Cutie de viteze, ambreiaj, transmisie</option>
                        <option value="Directie si suspensie">Directie si suspensie</option>
                        <option value="Echipamente si scule auto">Echipamente si scule auto</option>
                        <option value="Jante si Roti">Jante si Roti</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="producator">Model masina</label>
                    <input type="text" name="model" class="form-control">

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="descriere">Descriere anunt</label>
                    <input type="text" name="descriere" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="anunt">Titlu anunt</label>
                    <input type="text" name="titlu" class="form-control">
                </div>
                <div class="form-group col-md-4" style="margin-left:30px">
                    <label for="submit">Adaugare piesa</label>
                    <input type="submit" name="adaugarePiesa" class="form-control btn btn-danger">
                </div>
            </div>
        </form>
    </div>
    <?php
    function adaugare($utilizareveh, $brand, $tip, $model, $descriere, $titlu)
    {


        $ins = "INSERT INTO piese (utilizareveh, brandd, tip, model, descriere, titlu) VALUES ('$utilizareveh','$brand','$tip','$model','$descriere','$titlu')";
        $link = mysqli_connect("localhost", "root", "", "proiect1");
        mysqli_query($link, $ins);
        return true;
    }
    if (isset($_POST["adaugarePiesa"])) {
        if (adaugare($_POST["utilVeh"], $_POST["brand"], $_POST["tip"], $_POST["model"], $_POST["descriere"], $_POST["titlu"]));
        // header("refresh:0");
    }


    $selectAllFromPiese = 'SELECT * FROM piese ORDER BY id ASC';
    $res = mysqli_query($link, $selectAllFromPiese);
    echo '<form action="mainPage.php?page=4" method="POST" class="secondForm">';
    echo "<table><tr><th>ID</th><th>Brand</th><th>Tip</th><th>Model Masina</th><th>Select to delete</th></tr>";
    while ($row = mysqli_fetch_array($res)) {
        echo "<tr>
        <td>" . $row[0] . "</td>
        <td>" . $row[2] . "</td>
        <td>" . $row[3] . "</td>
        <td>" . $row[4] . "</td>
        <td><input style='width:25px;height:25px' type='checkbox' name='cb[]' value='" . $row[0] . "' </td>
        </tr>";
    }
    echo "</table>";

    ?>
    <div class="inputClass">
        <input type="submit" name="delpiesa" value="Delete" class="btn btn-danger">
    </div>
    <?php echo "</form>";
    if (isset($_POST['delpiesa'])) {
        if (isset($_POST['cb'])) {
            foreach ($_POST['cb'] as $idc) {
                $del = "DELETE FROM piese WHERE id = '$idc'";
                mysqli_query($link, $del);
            }
        }
    }
    ?>
</body>

</html>