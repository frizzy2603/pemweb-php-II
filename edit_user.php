<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

$user_id = $_GET['id'];
if (isset($_POST['username'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $job_title = $_POST['job_title'];

    $query = "UPDATE `user` SET `user_fullname`='$fullname',`user_name`='$username', `birth_place`='$birth_place', `birth_date`='$birth_date', `gender`='$gender', `address`='$address', `job_title`='$job_title'  WHERE `user_id`='$user_id'";
    $result = mysqli_query($conn, $query);
    header("Location: user.php");
    exit();
} else {
    $query = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (@$row) {
        $fullname = $row['user_fullname'];
        $username = $row['user_name'];
        $birth_place = $row['birth_place'];
        $birth_date = $row['birth_date'];
        $gender = $row['gender'];
        $address = $row['address'];
        $job_title = $row['job_title'];

    } else {
        header("Location: user.php");
        exit();
    }
}


// function select1($gender)
// {
//     $result = null;
//     if ($gender == Laki) {
//         $result = "selected";
//     }
//     return $result;
// }

// function select2($gender)
// {
//     $result = null;
//     if ($gender == Perempuan) {
//         $result = "selected";
//     }
//     return $result;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 50px;
    }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <form method="post" action="edit_user.php?id=<?= $user_id; ?>">
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" class="form-control" name="fullname" value="<?= $fullname; ?>" placeholder="Fullname"
                    required>
            </div>
            <div class="form-group">
                <label>Nama Pengguna:</label>
                <input type="text" class="form-control" name="username" value="<?= $username; ?>" placeholder="Username"
                    required>
            </div>
            <!-- <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" value="<?= $password; ?>"
                    placeholder="Password" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password:</label>
                <input type="password" class="form-control" name="repassword" value="<?= $password; ?>"
                    placeholder="Konfirmasi Password" required>
            </div> -->
            <div class="form-group">
                <label>Tempat Lahir:</label>
                <input type="text" class="form-control" name="birth_place" value="<?= $birth_place; ?>"
                    placeholder="Tempat lahir">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" class="form-control" name="birth_date" value="<?= $birth_date; ?>"
                    placeholder="Tanggal lahir">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <select class="form-select" id="gender" aria-label="Pilih Jenis Kelamin" require>
                    <option></option>
                    <option value="Laki" <?= $gender ?>>Laki-Laki</option>
                    <option value="Perempuan" <?= $gender ?>>Perempuan</option>
                </select>
            </div>
            <!-- <div class="form-group">
                <label>Golongan Darah:</label>
                <select class="form-select" name="blood_type" aria-label="Pilih Golongan Darah">
                    <option></option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div> -->
            <div class="form-group">
                <label>Alamat:</label>
                <textarea class="form-control" name="address" placeholder="Alamat"><?= $address; ?></textarea>
            </div>
            <!-- <div class="form-group">
                <label>Provinsi:</label>
                <select class="form-select" id="province" name="province" aria-label="Pilih Provinsi" required>
                    <option></option>
                    <?php
                    $query = "SELECT * FROM `reg_provinces`;";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0):
                        $row = mysqli_fetch_all($result);
                        foreach ($row as $r):
                            ?>
                    <option value="<?= $r[0]; ?>">
                        <?= $r[1]; ?>
                    </option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Kabupaten/Kota:</label>
                <select class="form-select" id="regency" name="regency" aria-label="Pilih Kabupaten/Kota" required>
                    <option></option>
                    <?php
                    $query = "SELECT * FROM `reg_regencies`;";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0):
                        $row = mysqli_fetch_all($result);
                        foreach ($row as $r):
                            ?>
                    <option value="<?= $r[0]; ?>">
                        <?= $r[1]; ?>
                    </option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Kecamatan:</label>
                <select class="form-select" id="district" name="district" aria-label="Pilih Kecamatan" required>
                    <option></option>
                    <?php
                    $query = "SELECT * FROM `reg_districts`;";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0):
                        $row = mysqli_fetch_all($result);
                        foreach ($row as $r):
                            ?>
                    <option value="<?= $r[0]; ?>">
                        <?= $r[1]; ?>
                    </option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Kelurahan:</label>
                <select class="form-select" id="village" name="village" aria-label="Pilih Kelurahan" required>
                    <option></option>
                    <?php
                    $query = "SELECT * FROM `reg_villages`;";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0):
                        $row = mysqli_fetch_all($result);
                        foreach ($row as $r):
                            ?>
                    <option value="<?= $r[0]; ?>">
                        <?= $r[1]; ?>
                    </option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Agama:</label>
                <select class="form-select" name="religion" aria-label="Pilih Agama">
                    <option></option>
                    <?php
                    $query = "SELECT * FROM `religion`;";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0):
                        $row = mysqli_fetch_all($result);
                        foreach ($row as $r):
                            ?>
                    <option value="<?= $r[0]; ?>">
                        <?= $r[1]; ?>
                    </option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status Perkawinan:</label>
                <select class="form-select" name="marital" aria-label="Pilih Status Perkawinan">
                    <option></option>
                    <?php
                    $query = "SELECT * FROM `marital`;";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0):
                        $row = mysqli_fetch_all($result);
                        foreach ($row as $r):
                            ?>
                    <option value="<?= $r[0]; ?>">
                        <?= $r[1]; ?>
                    </option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Pekerjaan:</label>
                <input type="text" class="form-control" name="job_title" value="<?= $job_title; ?>"
                    placeholder="Pekerjaan">
            </div>
            <div class="form-group">
                <label>Kewarganegaraan:</label>
                <select class="form-select" name="citizen_type" aria-label="Pilih Kewarganegaraan">
                    <option></option>
                    <option value="WNI">Warga Negara Indonesia</option>
                    <option value="WNA">Warga Negara Asing</option>
                </select>
            </div> -->

            <br>
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="user.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>