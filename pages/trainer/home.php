<?php
// session_start();
require '../../src/config/config.php';
include '../../components/trainer_sidebar.php';

// requireAdminRole();
$courses = readCourses();
$trainerApplications = getTrainerApplications();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainerId = $_POST['trainer_id'];
    $courseId = $_POST['course'];

    if (empty($trainerId) || empty($courseId)) {
        die("Trainer and course selection are required!");
    }

    $checkQuery = "SELECT id FROM trainer_applications 
                WHERE user_id = $trainerId AND course_id = $courseId";
    $result = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Pengajuan untuk program ini sudah ada!');</script>";
    } else {
        $query = "INSERT INTO trainer_applications (user_id, course_id, status) 
                VALUES ($trainerId, $courseId, 'Pending')";
        if (mysqli_query($connect, $query)) {
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
    <link rel="stylesheet" href="../../src/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <div class="container">

        <!-- Header -->
        <?php include '../../components/trainer_header.php'; ?>
        <!-- End Of Header -->

        <main class="main">
            <!-- Sidebar Menu -->
            <?php renderSidebar('fasilitator'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">
                    <!-- Add New User -->
                    <p>Pengajuan Fasilitator</p>
                    <form action="" method="POST">
                        <label for="trainer">Nama Fasilitator:</label>
                        <select id="trainer" name="trainer_id" required>
                            <option value="">-- Select a Trainer --</option>
                            <?php
                            $trainers = query("SELECT id, username FROM users WHERE role = 'trainer'");
                            foreach ($trainers as $trainer) {
                                echo "<option value='{$trainer['id']}'>{$trainer['username']}</option>";
                            }
                            ?>
                        </select>

                        <label for="course">Pilih Kelas:</label>
                        <select id="course" name="course" required>
                            <?php
                            include 'config.php';
                            $courses = readCourses();
                            foreach ($courses as $course) {
                                echo "<option value='{$course['id']}'>{$course['title']}</option>";
                            }
                            ?>
                        </select>

                        <section class="create-client">
                            <button type="submit"><i class="fas fa-plus"></i>Ajukan Fasilitator</button>
                        </section>
                    </form>

                    <!-- User List -->
                    <p>Daftar Pengajuan</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Fasilitator</th>
                                        <th>Kelas</th>
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
                    </div>
                </article>
                <div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>