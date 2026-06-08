<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

require_once __DIR__ . '/db.php';

$statement = $pdo->query('SELECT * FROM livestock_records ORDER BY created_at DESC');
$records = $statement->fetchAll();

$totalAnimals = 0;
$totalMilk = 0;
$totalEggs = 0;
$totalKids = 0;
foreach ($records as $record) {
    $totalAnimals += $record['cows'] + $record['goats'] + $record['chickens'];
    $totalMilk += $record['cows'] * $record['milk_rate'];
    $totalEggs += $record['chickens'] * $record['egg_rate'];
    $totalKids += $record['goats'] * $record['kid_rate'];
}

$totalRecords = count($records);
$averageMilk = $totalRecords ? round($totalMilk / $totalRecords) : 0;
$averageEggs = $totalRecords ? round($totalEggs / $totalRecords) : 0;
$averageKids = $totalRecords ? round($totalKids / $totalRecords) : 0;
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | BARCO MILY COMPANY</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="site-header">
    <a class="brand" href="mifugo.php" aria-label="BARCO MILY COMPANY">
      <span>KB</span>
      BARCO MILY COMPANY
    </a>
    <nav aria-label="Menyu kuu">
      <a href="mifugo.php">Mifugo</a>
      <a href="admin.php">Dashboard</a>
      <a href="admin_logout.php">Logout</a>
    </nav>
  </header>

  <main>
    <section class="content-section">
      <div class="section-heading">
        <p class="eyebrow">Admin Dashboard</p>
        <h1>Rekodi za mifugo zote</h1>
        <p>Hapa unaweza kuona kila rekodi iliyohifadhiwa, pamoja na jumla na wastani.</p>
      </div>

      <div class="schedule-grid">
        <article>
          <strong><?php echo htmlspecialchars($totalRecords); ?></strong>
          <span>Rekodi zilizohifadhiwa</span>
        </article>
        <article>
          <strong><?php echo htmlspecialchars($totalAnimals); ?></strong>
          <span>Jumla ya mifugo</span>
        </article>
        <article>
          <strong><?php echo htmlspecialchars($totalMilk); ?> L</strong>
          <span>Maziwa yote / siku</span>
        </article>
        <article>
          <strong><?php echo htmlspecialchars($totalEggs); ?></strong>
          <span>Mayai yote / siku</span>
        </article>
        <article>
          <strong><?php echo htmlspecialchars($totalKids); ?></strong>
          <span>Wanachanga wote / mwezi</span>
        </article>
      </div>

      <section class="content-section">
        <h2>Uchambuzi wa wastani</h2>
        <div class="schedule-grid">
          <article>
            <strong><?php echo htmlspecialchars($averageMilk); ?> L</strong>
            <span>Maziwa wastani / rekodi</span>
          </article>
          <article>
            <strong><?php echo htmlspecialchars($averageEggs); ?></strong>
            <span>Mayai wastani / rekodi</span>
          </article>
          <article>
            <strong><?php echo htmlspecialchars($averageKids); ?></strong>
            <span>Wanachanga wastani / rekodi</span>
          </article>
        </div>
      </section>

      <section class="content-section">
        <h2>Rekodi zote</h2>
        <?php if ($totalRecords === 0): ?>
          <p>Hakuna rekodi bado.</p>
        <?php else: ?>
          <table class="admin-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Tarehe</th>
                <th>Ng'ombe</th>
                <th>Mbuzi</th>
                <th>Kuku</th>
                <th>Maziwa/Ng'ombe</th>
                <th>Mayai/Kuku</th>
                <th>Wanachanga/Mbuzi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($records as $index => $record): ?>
                <tr>
                  <td><?php echo $index + 1; ?></td>
                  <td><?php echo htmlspecialchars($record['created_at']); ?></td>
                  <td><?php echo htmlspecialchars($record['cows']); ?></td>
                  <td><?php echo htmlspecialchars($record['goats']); ?></td>
                  <td><?php echo htmlspecialchars($record['chickens']); ?></td>
                  <td><?php echo htmlspecialchars($record['milk_rate']); ?> L</td>
                  <td><?php echo htmlspecialchars($record['egg_rate']); ?></td>
                  <td><?php echo htmlspecialchars($record['kid_rate']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </section>
    </section>
  </main>
</body>
</html>
