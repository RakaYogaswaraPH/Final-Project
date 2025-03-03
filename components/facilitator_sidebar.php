<?php
function renderSidebar($activeMenu)
{
    $menuItems = [
        'fasilitator' => ['href' => 'home.php', 'icon' => 'fas fa-chalkboard-teacher', 'label' => 'Pengajuan Fasilitator'],
        'kelas' => ['href' => 'classroom.php', 'icon' => 'fas fa-chalkboard', 'label' => 'Daftar Kelas'],
        'peserta' => ['href' => 'participant.php', 'icon' => 'fas fa-user-friends', 'label' => 'Daftar Peserta'],
    ];
?>
    <section class="sidebar">
        <h3>Fasilitator</h3>
        <ul class="menu">
            <?php foreach ($menuItems as $key => $item): ?>
                <li>
                    <a href="<?= $item['href'] ?>" class="<?= $activeMenu === $key ? 'active' : '' ?>">
                        <i class="<?= $item['icon'] ?>"></i>
                        <span><?= $item['label'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php
}
?>