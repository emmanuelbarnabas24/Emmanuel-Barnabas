<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header('Location: admin.php');
    exit;
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Tafadhali jaza username na password.';
    } elseif ($username === 'admin' && $password === '123456') {
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Username au password si sahihi. Jaribu tena.';
    }
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | BARCO MILY COMPANY</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <main>
    <section class="login-page" aria-label="Admin login page">
      <div class="login-shell">
        <div class="brand-panel">
          <div class="brand-mark">BM</div>
          <p class="eyebrow">Admin Login</p>
          <h2>Ingia kama msimamizi wa mifugo.</h2>
          <p>Unaweza kutazama rekodi zote za mifugo na ripoti za backend.</p>
        </div>

        <form class="login-card" method="post" action="admin_login.php" novalidate>
          <div class="form-header">
            <h2>Admin Login</h2>
            <p>Tumia jina la mtumiaji na nenosiri.</p>
          </div>

          <?php if ($error !== ''): ?>
            <p class="alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
          <?php endif; ?>

          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            autocomplete="username"
            placeholder="mfano: admin"
            value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>"
            required
          >

          <label for="password">Password</label>
          <div class="password-wrap">
            <input
              type="password"
              id="password"
              name="password"
              autocomplete="current-password"
              placeholder="Weka password"
              required
            >
          </div>

          <button class="primary-button" type="submit">Login</button>
          <a class="text-button link-button" href="mifugo.php">Rudi Mifugo</a>
          <p class="hint">Tumia <strong>admin</strong> / <strong>123456</strong>.</p>
        </form>
      </div>
    </section>
  </main>
</body>
</html>
