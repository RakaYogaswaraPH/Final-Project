<?php
session_start();
require '../../src/config/config.php';
include '../../components/facilitator_sidebar.php';
$loggedInFacilitatorId = $_SESSION['user_id'];
$loggedInFacilitatorName = $_SESSION['username'];

requireFacilitatorRole();
$courses = readCourses();
$facilitatorApplications = getFacilitatorApplications();

$facilitatorId = $_SESSION['user_id'];
$participantsData = getParticipantsByFacilitator($facilitatorId);
$status_translation = [
    "approved" => "Disetujui",
    "rejected" => "Ditolak",
    "pending" => "Menunggu",
];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>

    <div class="container">

        <!-- Header -->
        <?php include '../../components/facilitator_header.php'; ?>
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
                        <label for="fasilitator">Nama Fasilitator:</label>
                        <input type="hidden" name="facilitator_id" value="<?= $loggedInFacilitatorId; ?>">
                        <input type="text" value="<?= $loggedInFacilitatorName; ?>" disabled>

                        <label for="course">Pilih Kelas:</label>
                        <select id="course" name="course" required>
                            <?php
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
                                    <?php foreach ($facilitatorApplications as $application): ?>
                                        <tr>
                                            <td><?= $application['id']; ?></td>
                                            <td><?= $application['facilitator_name']; ?></td>
                                            <td><?= $application['course_title']; ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($application['applied_at'])); ?></td>
                                            <td><?= $application['approved_at'] ? date('d/m/Y H:i', strtotime($application['approved_at'])) : '-'; ?></td>
                                            <td><?= isset($status_translation[$application['status']]) ? $status_translation[$application['status']] : $application['status']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                </article>
                <div>
                </div>
            </section>
    </div>
    </main>
</body>
<script src="../../src/js/toastr.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facilitatorId = $_POST['facilitator_id'];
    $courseId = $_POST['course'];

    if (empty($facilitatorId) || empty($courseId)) {
        echo "<script>toastr.error('Fasilitator dan program harus dipilih!');</script>";
        exit();
    }

    // Check if facilitator already applied for this course
    $checkExistingApplication = "SELECT id FROM facilitator_applications WHERE user_id = ? AND course_id = ?";
    $stmt = $connect->prepare($checkExistingApplication);
    $stmt->bind_param("ii", $facilitatorId, $courseId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>toastr.warning('Anda sudah mengajukan untuk program ini!');</script>";
    }
    // Check if another facilitator already exists for this course
    else if (isFacilitatorExistsForCourse($courseId)) {
        echo "<script>toastr.warning('Maaf, kelas ini sudah memiliki fasilitator atau sedang dalam proses pengajuan!');</script>";
    } else {
        $insertQuery = "INSERT INTO facilitator_applications (user_id, course_id, status) VALUES (?, ?, 'Pending')";
        $stmt = $connect->prepare($insertQuery);
        $stmt->bind_param("ii", $facilitatorId, $courseId);

        if ($stmt->execute()) {
            reseqTable($connect, 'facilitator_applications', 'id');
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('Pengajuan berhasil ditambahkan', 'Berhasil');
                setTimeout(function() {
                    window.location.href = 'home.php';
                }, 2000);
            });
        </script>";
        } else {
            echo "<script>toastr.error('Terjadi kesalahan saat menambahkan pengajuan!');</script>";
        }
    }
}

?>

</html>