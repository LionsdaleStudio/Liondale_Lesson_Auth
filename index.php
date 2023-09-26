<?php require 'controllers/database.php';

/* Countries query */
try {
    //Ország adatok lekérése egyszeri felhasználásra.
    $sql_query = "SELECT * FROM countries";
    $result = mysqli_query($connection, $sql_query);

    /* Ország adatok kimentése saját tömbbe. Ha többször kell felhasználni 
    $countryData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($countryData, $row);
    } */


    /* State query */
    /* TODO: Country code based on chosen country */
    $sql_query_2 = "SELECT * FROM states WHERE country_code = 'HU'";
    $result_2 = mysqli_query($connection, $sql_query_2);
} catch (\Throwable $th) {
    //throw $th;
}


?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentikációs rendszer alapjai</title>

    <!-- Bootstrap linkek -->
    <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
    <script src="bootstrap\js\bootstrap.bundle.js"></script>

    <!-- Saját css-t csinálsz -->
    <link rel="stylesheet" href="style.css">

    <!-- Jquery link (for input masks and stuff) -->
    <script src="scripts/jquery.js"></script>

    <!-- Input-mask link -->
    <script src="scripts/input-mask.js"></script>
</head>

<body>

    <h1>Navbar</h1>
    <!-- TODO: navbar és loginrendszer elkészítése -->

    <div class="container">
        <div class="row mt-4 mb-2">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">Registration form</h4>
                        <!-- Form kezdés -->
                        <form action="controllers/register.php" method="POST">
                            <!-- Floating label input, placeholder kötelező -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="name@example.com">
                                <label for="email">Email address</label>
                            </div>
                            <!-- Floating label input, placeholder kötelező -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="name@example.com">
                                <label for="username">Username</label>
                            </div>
                            <!-- Password with hide and seen icon -->
                            <div class="pwd mb-3">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Password">
                                <span class="passwordIconHolder">
                                    <i class="passwordIcon" id="passwordIcon" onclick="showPassword()">X</i>
                                </span>
                            </div>
                            <!-- Password confirm with hide and seen icon -->
                            <div class="pwd mb-3">
                                <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm"
                                    placeholder="Password Confirm">
                                <span class="passwordIconHolder">
                                    <i class="passwordIcon" id="passwordIcon" onclick="showPasswordConfirm()">X</i>
                                </span>
                            </div>
                            <!-- Languages / Country -->
                            <select class="form-select mb-3" name="country" id="country">
                                <option value="" disabled selected>Please choose a country...</option>
                                <?php
                                /* Amíg van fel nem dolgozott sorom az sql lekérés eredményében */
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>

                            <!-- MEGYE -->
                            <select class="form-select mb-3" name="state" id="state">
                                <option value="" disabled selected>Please choose a state...</option>

                                <?php
                                /* Amíg van fel nem dolgozott sorom az sql lekérés eredményében */
                                while ($row = mysqli_fetch_assoc($result_2)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['state_name'] . '</option>';
                                }
                                ?>
                            </select>
                            <!-- Floating label input, placeholder kötelező -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="postal" id="postal"
                                    placeholder="name@example.com">
                                <label for="postal">Postal code</label>
                            </div>
                            <!-- Floating label input, placeholder kötelező -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="street" id="street"
                                    placeholder="name@example.com">
                                <label for="street">Street</label>
                            </div>
                            <!-- Telefonszám, input maszkokkal -->
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" placeholder="" data-mask="(99) 999-9999" class="form-control" name="phone">
                                <span class="font-13 text-muted">(999) 999-9999</span>
                            </div>
                            
                            <hr>
                            <button class="btn mt-3" name="submit" type="submit" id="submit">Register</button>
                        </form>
                        <!-- Form vége -->
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <!-- Password show / hide -->
    <script>
        let pwdInput = document.getElementById("password");
        let passwordSeen = false;

        function showPassword() {
            if (passwordSeen == false) {
                pwdInput.setAttribute("type", "text");
                passwordSeen = true;
            }
            else {
                pwdInput.setAttribute("type", "password");
                passwordSeen = false;
            }
        }

        let pwdConfirmInput = document.getElementById("passwordConfirm");
        let passwordConfirmSeen = false;
        function showPasswordConfirm() {
            if (passwordConfirmSeen == false) {
                pwdConfirmInput.setAttribute("type", "text");
                passwordConfirmSeen = true;
            }
            else {
                pwdConfirmInput.setAttribute("type", "password");
                passwordConfirmSeen = false;
            }
        }
    </script>

</body>



</html>




<!-- Jegyzetek -->
<!-- <select name="phonePrefix" id="">   Telefonszámok kiiratása saját tömbből.
                            <?php
                            /*  foreach ($countryData as $key => $value) {
                                 echo '<option value="' . $value['phone'] . '">' . $value['phone'] .  ' - '.$value['name'].'</option>';
                             } */
                            ?>
                            </select> -->