<?php
session_start();
require '../../src/config/config.php';
include '../../components/facilitator_sidebar.php';
$loggedInFacilitatorId = $_SESSION['user_id'];
$loggedInFacilitatorName = $_SESSION['username'];

requireFacilitatorRole();
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
        <?php include '../../components/facilitator_header.php'; ?>
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