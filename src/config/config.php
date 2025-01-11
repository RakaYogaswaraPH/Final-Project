<?php
$connect = mysqli_connect("localhost", "root", "", "db_production");

function query($query)
{
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// Fungsi untuk meresekuen ID tabel
function reseqTable($connect, $table, $idColumn)
{
    // Reset ID urutan sesuai data yang ada
    $query = "SET @new_id = 0;
            UPDATE $table SET $idColumn = (@new_id := @new_id + 1);
              ALTER TABLE $table AUTO_INCREMENT = 1;"; // Reset auto-increment ke nilai tertinggi + 1
    mysqli_multi_query($connect, $query);

    // Pastikan semua query dieksekusi
    while (mysqli_next_result($connect)) {
        if (!mysqli_more_results($connect)) break;
    }
}

function getTrainerApplications()
{
    global $connect;
    $query = "
        SELECT ta.id, u.username AS trainer_name, c.title AS course_title, ta.status, ta.applied_at, ta.approved_at 
        FROM trainer_applications ta
        JOIN users u ON ta.user_id = u.id
        JOIN course c ON ta.course_id = c.id
        ORDER BY ta.applied_at ASC";
    return query($query);
}


// Fungsi untuk menangani unggahan file
function handleFileUpload($file, $target_dir = "profile/")
{
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $fileName = time() . '_' . basename($file['name']);
    $target_file = $target_dir . $fileName;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file
    $check = getimagesize($file["tmp_name"]);
    if (!$check) {
        return ["status" => false, "message" => "File is not an image."];
    }
    if ($file["size"] > 5000000) {
        return ["status" => false, "message" => "Sorry, your file is too large."];
    }
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        return ["status" => false, "message" => "Only JPG, JPEG, PNG & GIF files are allowed."];
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ["status" => true, "fileName" => $fileName];
    }

    return ["status" => false, "message" => "Failed to upload file."];
}


//* Users Config *\\
function getUsers()
{
    global $connect;
    $result = mysqli_query($connect, "SELECT * FROM users");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function getAllUsers()
{
    global $connect;
    $result = mysqli_query($connect, "SELECT COUNT(*) as total FROM users");
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}


function registers($data)
{
    global $connect;
    $username = htmlspecialchars($data["username"]);
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $repassword = mysqli_real_escape_string($connect, $data["re-password"]);

    $result = mysqli_query($connect, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Email yang dimasukkan sudah terdaftar!');</script>";
        return false;
    }

    if ($password !== $repassword) {
        echo "<script>alert('Password tidak cocok, silakan masukkan informasi akun yang sesuai.');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'admin')";
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}


function addUsers($data)
{
    global $connect;
    $username = htmlspecialchars($data["username"]);
    $email = strtolower(stripslashes($data["email"]));
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $role = $data["role"];

    // Cek apakah email sudah ada
    $result = mysqli_query($connect, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        return "EMAIL_EXISTS"; // Indikasi email sudah ada
    }

    // Cari ID yang kosong
    $result = mysqli_query($connect, "SELECT id FROM users ORDER BY id");
    $used_ids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $used_ids[] = $row['id'];
    }

    $new_id = 1;
    foreach ($used_ids as $id) {
        if ($id != $new_id) {
            break;
        }
        $new_id++;
    }

    // Masukkan data pengguna baru dengan ID yang ditemukan
    mysqli_query($connect, "INSERT INTO users (id, username, email, password, role) VALUES ($new_id, '$username', '$email', '$password', '$role')");
    return mysqli_affected_rows($connect);
}


function editUsers($id, $username, $email, $role)
{
    global $connect;
    $allowedRoles = ['admin', 'user', 'trainer'];
    if (!in_array($role, $allowedRoles)) {
        throw new Exception("Role tidak valid: " . htmlspecialchars($role));
    }

    // Siapkan query dengan 4 parameter
    $stmt = $connect->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    if ($stmt === false) {
        throw new Exception("Gagal menyiapkan pernyataan SQL: " . $connect->error);
    }

    // Bind parameter (4 parameter sesuai query)
    $stmt->bind_param("sssi", $username, $email, $role, $id);

    // Eksekusi query
    if (!$stmt->execute()) {
        throw new Exception("Gagal menjalankan query: " . $stmt->error);
    }

    return $stmt->affected_rows > 0;
}


function deleteUsers($id)
{
    global $connect;
    mysqli_begin_transaction($connect);
    try {
        // Hapus pengguna
        mysqli_query($connect, "DELETE FROM users WHERE id = $id");

        // Ambil semua pengguna yang ID-nya lebih besar dari ID yang dihapus
        $result = mysqli_query($connect, "SELECT id FROM users WHERE id > $id ORDER BY id");

        // Update ID untuk setiap pengguna yang tersisa
        while ($row = mysqli_fetch_assoc($result)) {
            $old_id = $row['id'];
            $new_id = $old_id - 1;

            // Update ID pengguna
            mysqli_query($connect, "UPDATE users SET id = $new_id WHERE id = $old_id");
        }

        // Reset auto-increment ke nilai maksimum + 1
        $result = mysqli_query($connect, "SELECT MAX(id) as max_id FROM users");
        $row = mysqli_fetch_assoc($result);
        $next_id = ($row['max_id'] ?? 0) + 1;
        mysqli_query($connect, "ALTER TABLE users AUTO_INCREMENT = $next_id");

        // Commit transaksi jika semua operasi berhasil
        mysqli_commit($connect);
        return true;
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        mysqli_rollback($connect);
        return false;
    }
}



//* Course Config *\\
function readCourses()
{
    global $connect;
    $query = "SELECT * FROM course";
    return query($query);
}


function getAllCourse()
{
    global $connect;
    $result = mysqli_query($connect, "SELECT COUNT(*) as total FROM course");
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}


function createCourse($data)
{
    global $connect;
    $title = htmlspecialchars($data['title']);
    $description = htmlspecialchars($data['description']);
    $image = htmlspecialchars($data['image']);
    $price = (int)$data['price'];
    $generalObjectives = htmlspecialchars($data['General_Objectives']);
    $specificObjectives = htmlspecialchars($data['Specific_Objectives']);
    $targetGroup = htmlspecialchars($data['Target_Group']);
    $competencyAspects = htmlspecialchars($data['Competency_Aspects']);

    $query = "INSERT INTO course (title, description, image, price, General_Objectives, Specific_Objectives, Target_Group, Competency_Aspects) VALUES ('$title', '$description', '$image', $price, '$generalObjectives', '$specificObjectives', '$targetGroup', '$competencyAspects')";

    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}


function readCourseById($id)
{
    global $connect;
    $id = (int)$id;
    $query = "SELECT * FROM course WHERE id = $id";
    $result = query($query);
    return $result[0] ?? null;
}


function updateCourse($data)
{
    global $connect;
    $id = (int)$data['id'];
    $title = htmlspecialchars($data['title']);
    $description = htmlspecialchars($data['description']);
    $price = (int)$data['price'];
    $generalObjectives = htmlspecialchars($data['General_Objectives']);
    $specificObjectives = htmlspecialchars($data['Specific_Objectives']);
    $targetGroup = htmlspecialchars($data['Target_Group']);
    $competencyAspects = htmlspecialchars($data['Competency_Aspects']);

    // Periksa apakah gambar baru diunggah
    $imageQueryPart = '';
    if (!empty($data['image'])) {
        $image = htmlspecialchars($data['image']);
        $imageQueryPart = ", image = '$image'";
    }

    // Buat query SQL
    $query = "UPDATE course SET 
                title = '$title', 
                description = '$description', 
                price = $price, 
                General_Objectives = '$generalObjectives', 
                Specific_Objectives = '$specificObjectives', 
                Target_Group = '$targetGroup', 
                Competency_Aspects = '$competencyAspects'
                $imageQueryPart 
                WHERE id = $id";

    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}


function uploadImage($file)
{
    // Pastikan menggunakan path absolut
    $targetDir = "banner/";

    // Buat direktori jika belum ada
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Buat nama file yang unik untuk menghindari konflik
    $fileName = time() . '-' . basename($file['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array(strtolower($fileType), $allowedTypes)) {
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            // Kembalikan path relatif untuk disimpan di database
            return $fileName;
        }
    }
    return false;
}


function deleteCourse($id)
{
    global $connect;
    mysqli_begin_transaction($connect);

    try {
        // 1. Ambil informasi gambar sebelum menghapus course
        $query = "SELECT image FROM course WHERE id = $id";
        $result = mysqli_query($connect, $query);
        $course = mysqli_fetch_assoc($result);

        if ($course) {
            // 2. Hapus file gambar dari folder uploads
            $imagePath = "banner/" . $course['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // 3. Hapus course dari database
        mysqli_query($connect, "DELETE FROM course WHERE id = $id");

        // 4. Ambil semua course yang ID-nya lebih besar dari ID yang dihapus
        $result = mysqli_query($connect, "SELECT id FROM course WHERE id > $id ORDER BY id");

        // 5. Update ID untuk setiap course yang tersisa
        while ($row = mysqli_fetch_assoc($result)) {
            $old_id = $row['id'];
            $new_id = $old_id - 1;

            // Update ID course
            mysqli_query($connect, "UPDATE course SET id = $new_id WHERE id = $old_id");
        }

        // 6. Reset auto-increment ke nilai maksimum + 1
        $result = mysqli_query($connect, "SELECT MAX(id) as max_id FROM course");
        $row = mysqli_fetch_assoc($result);
        $next_id = ($row['max_id'] ?? 0) + 1;
        mysqli_query($connect, "ALTER TABLE course AUTO_INCREMENT = $next_id");

        // 7. Commit transaksi jika semua operasi berhasil
        mysqli_commit($connect);
        return true;
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        mysqli_rollback($connect);
        return false;
    }
}



//* Testimonial Config *\\
function getTestimonials()
{
    global $connect;
    $result = mysqli_query($connect, "SELECT * FROM testimonial");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function getAllTestimonials()
{
    global $connect;
    $result = mysqli_query($connect, "SELECT COUNT(*) as total FROM testimonial");
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}


function createTestimonial($connect, $data, $file)
{
    $upload = handleFileUpload($file);
    if (!$upload['status']) {
        echo $upload['message'];
        return;
    }

    $name = mysqli_real_escape_string($connect, $data['name']);
    $course_name = mysqli_real_escape_string($connect, $data['course_name']);
    $review = mysqli_real_escape_string($connect, $data['review']);
    $program_name = mysqli_real_escape_string($connect, $data['program_name']);
    $linkedin = mysqli_real_escape_string($connect, $data['linkedin']);
    $fileName = $upload['fileName'];

    $query = "INSERT INTO testimonial (image, name, course_name, review, program_name, linkedin) 
            VALUES ('$fileName', '$name', '$course_name', '$review', '$program_name', '$linkedin')";
    if (mysqli_query($connect, $query)) {
        return true; // Berhasil
    }

    return false; // Gagal
}


// Fungsi untuk memperbarui testimonial
function updateTestimonial($connect, $data, $file)
{
    $id = mysqli_real_escape_string($connect, $data['id']);
    $name = mysqli_real_escape_string($connect, $data['name']);
    $course_name = mysqli_real_escape_string($connect, $data['course_name']);
    $review = mysqli_real_escape_string($connect, $data['review']);
    $program_name = mysqli_real_escape_string($connect, $data['program_name']);
    $linkedin = mysqli_real_escape_string($connect, $data['linkedin']);

    if (!empty($file['name'])) {
        $upload = handleFileUpload($file, "profile/");
        if ($upload['status']) {
            $old_image = mysqli_fetch_assoc(mysqli_query($connect, "SELECT image FROM testimonial WHERE id=$id"))['image'];
            if ($old_image && file_exists("profile/" . $old_image)) {
                unlink("profile/" . $old_image);
            }
            $query = "UPDATE testimonial SET 
                    image='{$upload['fileName']}', 
                    name='$name', 
                    course_name='$course_name', 
                    review='$review', 
                    program_name='$program_name', 
                    linkedin='$linkedin' 
                    WHERE id=$id";
        }
    } else {
        $query = "UPDATE testimonial SET 
                name='$name', 
                course_name='$course_name', 
                review='$review', 
                program_name='$program_name', 
                linkedin='$linkedin' 
                WHERE id=$id";
    }

    return mysqli_query($connect, $query) ? true : false;
}


// Fungsi untuk menghapus testimonial
function deleteTestimonial($connect, $id)
{
    $id = mysqli_real_escape_string($connect, $id);
    $image = mysqli_fetch_assoc(mysqli_query($connect, "SELECT image FROM testimonial WHERE id=$id"))['image'];

    // Hapus file gambar jika ada
    if ($image && file_exists("profile/" . $image)) {
        unlink("profile/" . $image);
    }

    // Hapus data dari tabel
    $query = "DELETE FROM testimonial WHERE id=$id";
    $deleteResult = mysqli_query($connect, $query);

    // Resekuen ID jika penghapusan berhasil
    if ($deleteResult) {
        reseqTable($connect, 'testimonial', 'id');
        return true;
    }

    return false;
}



//* Users Config *\\
function getAllPortofolio()
{
    global $connect;
    $result = mysqli_query($connect, "SELECT COUNT(*) as total FROM portofolio");
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}


// Fungsi untuk mendapatkan semua data portofolio
function getPortofolios()
{
    global $connect;
    $result = mysqli_query($connect, "SELECT * FROM portofolio ORDER BY id ASC");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi untuk membuat portofolio baru
function createPortofolio($connect, $data, $file)
{
    $upload = handleFileUpload($file, "portofolio/");
    if (!$upload['status']) {
        echo $upload['message'];
        return false;
    }

    $image = $upload['fileName'];
    $project_name = mysqli_real_escape_string($connect, $data['project_name']);
    $project_link = mysqli_real_escape_string($connect, $data['project_link']);
    $username = mysqli_real_escape_string($connect, $data['username']);
    $program_name = mysqli_real_escape_string($connect, $data['program_name']);

    $query = "INSERT INTO portofolio (image, project_name, project_link, username, program_name) 
            VALUES ('$image', '$project_name', '$project_link', '$username', '$program_name')";

    if (mysqli_query($connect, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($connect);
        return false;
    }
}


// Fungsi untuk memperbarui data portofolio
function updatePortofolio($connect, $data, $file)
{
    $id = mysqli_real_escape_string($connect, $data['id']);
    $project_name = mysqli_real_escape_string($connect, $data['project_name']);
    $project_link = mysqli_real_escape_string($connect, $data['project_link']);
    $username = mysqli_real_escape_string($connect, $data['username']);
    $program_name = mysqli_real_escape_string($connect, $data['program_name']);

    if (!empty($file['name'])) {
        $upload = handleFileUpload($file, "portofolio/");
        if ($upload['status']) {
            // Hapus file lama
            $old_image = mysqli_fetch_assoc(mysqli_query($connect, "SELECT image FROM portofolio WHERE id=$id"))['image'];
            if ($old_image && file_exists("portofolio/" . $old_image)) {
                unlink("portofolio/" . $old_image);
            }
            $image = $upload['fileName'];
            $query = "UPDATE portofolio SET 
                    image='$image', 
                    project_name='$project_name', 
                    project_link='$project_link', 
                    username='$username', 
                    program_name='$program_name' 
                    WHERE id=$id";
        } else {
            echo $upload['message'];
            return false;
        }
    } else {
        $query = "UPDATE portofolio SET 
                project_name='$project_name', 
                project_link='$project_link', 
                username='$username', 
                program_name='$program_name' 
                WHERE id=$id";
    }

    if (mysqli_query($connect, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($connect);
        return false;
    }
}

// Fungsi untuk menghapus portofolio
function deletePortofolio($connect, $id)
{
    $id = mysqli_real_escape_string($connect, $id);
    $image = mysqli_fetch_assoc(mysqli_query($connect, "SELECT image FROM portofolio WHERE id=$id"))['image'];

    // Hapus file gambar jika ada
    if ($image && file_exists("portofolio/" . $image)) {
        unlink("portofolio/" . $image);
    }

    // Hapus data dari tabel
    $query = "DELETE FROM portofolio WHERE id=$id";
    $deleteResult = mysqli_query($connect, $query);

    // Resekuen ID jika penghapusan berhasil
    if ($deleteResult) {
        reseqTable($connect, 'portofolio', 'id');
        return true;
    } else {
        echo "Error: " . mysqli_error($connect);
        return false;
    }
}
