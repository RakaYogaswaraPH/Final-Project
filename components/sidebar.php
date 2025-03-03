<?php
function renderSidebar($activeMenu)
{
    $menuItems = [
        'dashboard' => ['href' => 'dashboard.php', 'icon' => 'fas fa-home', 'label' => 'Beranda'],
        'pengguna' => ['href' => 'users_control.php', 'icon' => 'fas fa-users', 'label' => 'Pengguna'],
        'program' => ['href' => 'course_control.php', 'icon' => 'fas fa-sitemap', 'label' => 'Program'],
        'testimoni' => ['href' => 'testimonial_control.php', 'icon' => 'fas fa-comments', 'label' => 'Testimoni'],
        'portofolio' => ['href' => 'portofolio_control.php', 'icon' => 'fas fa-user-graduate', 'label' => ' Portofolio'],
        'fasilitator' => ['href' => 'facilitator_control.php', 'icon' => 'fas fa-chalkboard-teacher', 'label' => 'Fasilitator'],
    ];
?>
    <section class="sidebar">
        <h3>Administrator</h3>
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