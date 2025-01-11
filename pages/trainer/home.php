<?php
require '../../src/config/config.php';
$courses = readCourses();
$trainerApplications = getTrainerApplications();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainerId = $_POST['trainer_id'];
    $courseId = $_POST['course'];

    // Validasi input
    if (empty($trainerId) || empty($courseId)) {
        die("Trainer and course selection are required!");
    }

    // Cek apakah kombinasi trainer dan course sudah ada
    $checkQuery = "SELECT id FROM trainer_applications 
                  WHERE user_id = $trainerId AND course_id = $courseId";
    $result = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Pengajuan untuk program ini sudah ada!');</script>";
    } else {
        // Insert data pengajuan ke tabel trainer_applications
        $query = "INSERT INTO trainer_applications (user_id, course_id, status) 
                 VALUES ($trainerId, $courseId, 'Pending')";
        if (mysqli_query($connect, $query)) {
            // Resequence ID setelah insert
            reseqTable($connect, 'trainer_applications', 'id');
            echo "<script>alert('Pengajuan berhasil ditambahkan!');</script>";
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Fasilitator</title>
    <link rel="stylesheet" href="../../src/css/trainer.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <h1>Trainer Application System</h1>
    </header>

    <div class="container">
        <h2>Apply as a Facilitator</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="trainer">Select Trainer:</label>
                <select id="trainer" name="trainer_id" required>
                    <option value="">-- Select a Trainer --</option>
                    <?php
                    $trainers = query("SELECT id, username FROM users WHERE role = 'trainer'");
                    foreach ($trainers as $trainer) {
                        echo "<option value='{$trainer['id']}'>{$trainer['username']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="course">Select Course:</label>
                <select id="course" name="course" required>
                    <option value="">-- Select a Course --</option>
                    <?php
                    include 'config.php';
                    $courses = readCourses();
                    foreach ($courses as $course) {
                        echo "<option value='{$course['id']}'>{$course['title']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit">Submit Application</button>
        </form>
    </div>

    <div class="container">
        <h2>Admin: Review Applications</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Trainer</th>
                    <th>Course</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Disetujui</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trainerApplications as $application): ?>
                    <tr>
                        <td><?= $application['id']; ?></td>
                        <td><?= $application['trainer_name']; ?></td>
                        <td><?= $application['course_title']; ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($application['applied_at'])); ?></td>
                                                <td><?= $application['approved_at'] ? date('d/m/Y H:i', strtotime($application['approved_at'])) : '-'; ?></td>
                        <td><?= $application['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>