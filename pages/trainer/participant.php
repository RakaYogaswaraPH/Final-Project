<?php
session_start();
require '../../src/config/config.php';
include '../../components/trainer_sidebar.php';
$loggedInTrainerId = $_SESSION['user_id'];
$loggedInTrainerName = $_SESSION['username'];

requireTrainerRole();
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

function getParticipantsByFacilitator($facilitatorId)
{
    global $connect;
    $query = "
        SELECT 
            c.id AS course_id,
            c.title AS course_title,
            u.username AS participant_name
        FROM trainer_applications ta
        JOIN course c ON ta.course_id = c.id
        JOIN course_registrations cr ON c.id = cr.course_id
        JOIN users u ON cr.user_id = u.id
        WHERE ta.user_id = ? 
        AND ta.status = 'Approved'
        ORDER BY c.title, u.username
    ";

    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $facilitatorId);
    $stmt->execute();
    $result = $stmt->get_result();

    $participants = [];
    while ($row = $result->fetch_assoc()) {
        $courseId = $row['course_id'];
        if (!isset($participants[$courseId])) {
            $participants[$courseId] = [
                'course_title' => $row['course_title'],
                'participants' => []
            ];
        }
        $participants[$courseId]['participants'][] = $row['participant_name'];
    }

    return $participants;
}

// Add this to your facilitator.php after getting trainerApplications
$facilitatorId = $_SESSION['user_id'];
$participantsData = getParticipantsByFacilitator($facilitatorId);

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
            <?php renderSidebar('peserta'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">

                    <p>Daftar Peserta Kelas Saya</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Peserta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($participantsData)) {
                                        $no = 1;
                                        foreach ($participantsData as $courseId => $data) {
                                            $rowspan = count($data['participants']) ?: 1;
                                            echo "<tr>";
                                            echo "<td rowspan='{$rowspan}'>{$no}</td>";
                                            echo "<td rowspan='{$rowspan}'>{$data['course_title']}</td>";

                                            if (!empty($data['participants'])) {
                                                echo "<td>{$data['participants'][0]}</td>";
                                                echo "</tr>";

                                                // Display remaining participants
                                                for ($i = 1; $i < count($data['participants']); $i++) {
                                                    echo "<tr><td>{$data['participants'][$i]}</td></tr>";
                                                }
                                            } else {
                                                echo "<td>Belum ada peserta</td>";
                                                echo "</tr>";
                                            }
                                            $no++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='3' style='text-align: center;'>Anda belum memiliki peserta di kelas yang Anda fasilitasi</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            </section>
    </div>
    </main>
</body>

</html>