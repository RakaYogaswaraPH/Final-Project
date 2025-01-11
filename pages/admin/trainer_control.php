<?php
require "../../src/config/config.php";
include '../../components/sidebar.php';
date_default_timezone_set('Asia/Jakarta');
$trainerApplications = getTrainerApplications();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'delete') {
        // Hapus data
        $deleteQuery = "DELETE FROM trainer_applications WHERE id = $id";
        if (mysqli_query($connect, $deleteQuery)) {
            // Resequence ID setelah penghapusan
            reseqTable($connect, 'trainer_applications', 'id');
            header("Location: trainer_control.php?deleted=true");
        } else {
            header("Location: trainer_control.php?error=true");
        }
        exit;
    }

    // Logika approve/reject yang sudah ada
    if ($action === 'approve' || $action === 'reject') {
        $status = $action === 'approve' ? 'Approved' : 'Rejected';
        if ($action === 'approve') {
            $query = "UPDATE trainer_applications 
                    SET status = '$status', approved_at = NOW() 
                    WHERE id = $id";
        } else {
            $query = "UPDATE trainer_applications 
                    SET status = '$status', approved_at = NULL 
                    WHERE id = $id";
        }
        if (mysqli_query($connect, $query)) {
            header("Location: trainer_control.php?success=true");
        } else {
            header("Location: trainer_control.php?error=true");
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Dashboard</title>
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
        <?php include '../../components/header.php'; ?>
        <!-- End Of Header -->

        <main class="main">
            <!-- Sidebar Menu -->
            <?php renderSidebar('fasilitator'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">
                    <!-- User List -->
                    <p>Daftar Fasilitator</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Program</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Disetujui</th>
                                        <th>Pengaturan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($trainerApplications)) : ?>
                                        <tr class="empty-row">
                                            <td colspan="8">Belum ada fasilitator yang mengajukan kelas</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($trainerApplications as $application): ?>
                                            <tr>
                                                <td><?= $application['id']; ?></td>
                                                <td><?= $application['trainer_name']; ?></td>
                                                <td><?= $application['course_title']; ?></td>
                                                <td><?= $application['status']; ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($application['applied_at'])); ?></td>
                                                <td><?= $application['approved_at'] ? date('d/m/Y H:i', strtotime($application['approved_at'])) : '-'; ?></td>
                                                <td>
                                                    <form action="" method="POST" style="display:inline;">
                                                        <section class="control-client">
                                                            <input type="hidden" name="id" value="<?= $application['id']; ?>">
                                                            <button type="submit" name="action" value="approve">Disetujui</button>
                                                            <button type="submit" name="action" value="reject">Ditolak</button>
                                                            <button type="submit" name="action" value="delete"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                                style="background-color: #ff4444;">Hapus</button>
                                                        </section>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
<script src="../../src/js/admin.js"></script>

</html>