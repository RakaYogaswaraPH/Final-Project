<?php
session_start();
require '../../src/config/config.php';
include '../../components/facilitator_sidebar.php';

requireFacilitatorRole();
$courseId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$course = readCourseById($courseId);
$courses = readCourses();
$facilitatorApplications = ApprovedFacilitator();
$currentUserId = $_SESSION['user_id'];
$facilitatorApplications = getFacilitatorClasses($currentUserId);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facilitatorId = $_POST['facilitator_id'];
    $courseId = $_POST['course'];

    if (empty($facilitatorId) || empty($courseId)) {
        die("Facilitator and course selection are required!");
    }

    $checkQuery = "SELECT id FROM facilitator_applications 
                WHERE user_id = $facilitatorId AND course_id = $courseId";
    $result = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Pengajuan untuk program ini sudah ada!');</script>";
    } else {
        $query = "INSERT INTO facilitator_applications (user_id, course_id, status) 
                VALUES ($facilitatorId, $courseId, 'Pending')";
        if (mysqli_query($connect, $query)) {
            reseqTable($connect, 'facilitator_applications', 'id');
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
        <?php include '../../components/facilitator_header.php'; ?>
        <!-- End Of Header -->

        <main class="main">
            <!-- Sidebar Menu -->
            <?php renderSidebar('kelas'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">
                    <!-- User List -->
                    <p>Daftar Kelas</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Fasilitator</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($facilitatorApplications)): ?>
                                        <?php $counter = 1; // Initialize counter 
                                        ?>
                                        <?php foreach ($facilitatorApplications as $application): ?>
                                            <tr>
                                                <td><?= $counter++; // Display and increment counter 
                                                    ?></td>
                                                <td><?= htmlspecialchars($application['facilitator_name']); ?></td>
                                                <td><a href="preview.php?id=<?= $application['course_id']; ?>"><?= htmlspecialchars($application['course_title']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" style='text-align: center' ;>Belum ada kelas yang diterima.</td>
                                        </tr>
                                    <?php endif; ?>
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