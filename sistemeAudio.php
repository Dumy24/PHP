<?php
connect();
?>

<style>
    body {
        display: flex;
        flex-direction: column;
    }

    form {
        display: flex;
        flex-direction: column;
        width: 50%;
        margin-top: 100px;

    }

    h1 {
        margin: auto;
        margin-top: 70px;
    }

    .container {
        display: flex;
        flex-direction: row;
    }

    .listClass {
        width: 50%;
        height: 400px;
        background-color: limegreen;
        margin-right: 40px;
        justify-content: center;
        padding-left: 50px;
        border-radius: 20px;
        color: white;

    }
</style>


<h1>Sisteme Audio</h1>
<div class="container">
    <form action="mainPage.php?page=3" method="POST" class="listClass">
        <div class="form-group row">
            <label for="brand" class="col-sm-2 col-form-label">Brand</label>
            <div class="col-sm-6">
                <select name="brand" class="form-control">
                    <option value="audios">Audiosystem</option>
                    <option value="audison">Audison</option>
                    <option value="dynamat">Dynamat</option>
                    <option value="harman">Harman Kardon</option>
                    <option value="hertz">Hertz</option>
                    <option value="match">Match</option>
                    <option value="stp">STP (Standartplast)</option>
                    <option value="steg">Steg</option>
                    <option value="stetsom">Stetsom</option>
                    <option value="teyes">Teyes</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Categorie produs</label>
            <div class="col-sm-6">
                <select name="categorie" class="form-control">
                    <option value="Accesorii">Accesorii</option>
                    <option value="Amplificatoare">Amplificatoare</option>
                    <option value="Difuzoare">Difuzoare</option>
                    <option value="Display">Display</option>
                    <option value="Insonorizant">Insonorizant</option>
                    <option value="Navigatii">Navigatii</option>
                    <option value="Pachet Subwoofer complet">Pachet Subwoofer complet</option>
                    <option value="Pachet difuzoare auto dedicat">Pachet difuzoare auto dedicat</option>
                    <option value="Subwoofere">Subwoofere</option>
                    <option value="Tweetere">Tweetere</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pret" class="col-sm-2 col-form-label">Pret</label>
            <div class="col-sm-6">
                <input type="text" class="form-control " name="pret">
            </div>
        </div>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Stare</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stare" id="gridRadios1" value="nou" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Nou
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stare" id="gridRadios2" value="secondhand">
                        <label class="form-check-label" for="gridRadios2">
                            Second hand
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success" name="pushBtn">Listeaza</button>
            </div>
        </div>
    </form>
    <?php
    $selectAllFromAudio = 'SELECT * FROM sistemeaudio ORDER BY id ASC';
    $res = mysqli_query($link, $selectAllFromAudio);
    echo '<form action="mainPage.php?page=3" method="POST" >';
    echo "<table><tr><th>ID</th><th>Brand</th><th>Categorie</th><th>Pret</th><th>Stare</th><th>Select to delete</th></tr>";
    while ($row = mysqli_fetch_array($res)) {
        echo "<tr>
        <td>" . $row[0] . "</td>
        <td>" . $row[1] . "</td>
        <td>" . $row[2] . "</td>
        <td>" . $row[3] . "</td>
        <td>" . $row[4] . "</td>
        <td><input style='margin-left:50px;width:25px;height:25px' type='checkbox' name='cb[]' value='" . $row[0] . "' </td>
        </tr>";
    }
    echo "</table>";
    ?>
    <div style="display: flex;justify-content:flex-end">
        <input type="submit" name="delaudio" value="Delete" class="btn btn-sm btn-danger">
    </div>
    <?php
    echo "</form>";
    ?>
</div>
<?php


if (isset($_POST['delaudio'])) {
    if (isset($_POST['cb'])) {
        foreach ($_POST['cb'] as $idc) {
            $del = "DELETE FROM sistemeaudio WHERE id = '$idc'";
            mysqli_query($link, $del);
        }
    }
}


function listare($brand, $categorie, $pret, $stare)
{
    if ($brand == "" || $categorie == "" || $pret == "") {
        echo "<h3> <span style='color:red'> Toate campurile sunt obligatorii </span> </h3>";
        exit();
    }

    $ins = "INSERT INTO sistemeaudio (brandaudio,categorieprodus,pretprodus, stareprodus) VALUES ('$brand','$categorie','$pret','$stare')";
    $link = mysqli_connect("localhost", "root", "", "proiect1");
    mysqli_query($link, $ins);
    return true;
}

if (isset($_POST["pushBtn"])) {
    if (listare($_POST['brand'], $_POST['categorie'], $_POST['pret'], $_POST['stare'])); {
    }
    // header("refresh:0");
}
