<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Task Management System</title>

  <!-- Bootstrap & Icons CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

  <!-- Custom Styles -->
  <style>
    :root {
      --main: #5d87ff;
      --white: #fff;
      --glass: rgba(255, 255, 255, 0.15);
      --bg: linear-gradient(135deg, #f0f4ff, #e0e7ff);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: var(--bg);
      min-height: 100vh;
      overflow: hidden;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      color: #2e384d;
    }

    .background {
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: linear-gradient(90deg, rgba(93,135,255,0.05) 1px, transparent 1px),
                        linear-gradient(rgba(93,135,255,0.05) 1px, transparent 1px);
      background-size: 40px 40px;
      animation: bgScroll 20s linear infinite;
      z-index: 0;
    }

    @keyframes bgScroll {
      from { background-position: 0 0; }
      to { background-position: 100px 100px; }
    }

    .login-card {
      position: relative;
      z-index: 2;
      max-width: 420px;
      width: 100%;
      padding: 3rem 2.5rem;
      border-radius: 20px;
      background: var(--glass);
      backdrop-filter: blur(18px);
      box-shadow: 0 8px 50px rgba(93,135,255,0.2);
      border: 1px solid rgba(255,255,255,0.2);
      transition: transform 0.5s ease;
      animation: enterScale 1.2s ease-out;
    }

    @keyframes enterScale {
      0% { transform: scale(0.92); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    .login-card:hover {
      transform: scale(1.01);
    }

    .login-card h3 {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 1.8rem;
      text-align: center;
    }

    .form-group {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .form-control {
      background: rgba(255,255,255,0.85);
      border: none;
      border-radius: 12px;
      padding-left: 2.5rem;
      height: 50px;
      font-size: 1rem;
    }

    .form-control:focus {
      box-shadow: 0 0 0 0.25rem rgba(93,135,255,0.25);
    }

    .form-icon {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: var(--main);
      font-size: 1.1rem;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
      font-size: 1.1rem;
    }

    .btn-primary {
      background-color: var(--main);
      border: none;
      width: 100%;
      height: 50px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #476cd8;
    }

    .sticker {
      position: absolute;
      top: -70px;
      left: 50%;
      transform: translateX(-50%);
      width: 120px;
      animation: float 4s ease-in-out infinite;
      z-index: 3;
    }

    @keyframes float {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50% { transform: translateX(-50%) translateY(-10px); }
    }

    .footer-note {
      text-align: center;
      font-size: 0.85rem;
      margin-top: 1rem;
      color: #555;
    }

    @media (max-width: 480px) {
      .login-card {
        padding: 2rem 1.5rem;
      }
    }
  </style>
</head>

<body>

  <!-- Animated Grid Background -->
  <div class="background"></div>

  <!-- Sticker Graphic -->
  <img src="https://cdn-icons-png.flaticon.com/512/10927/10927045.png" class="sticker" alt="Sticker" />

  <!-- Login Card -->
  <div class="login-card">
    <h3>Welcome Back 👋</h3>

    <form method="POST" action="app/login.php">

      <!-- PHP error handler -->
      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo htmlspecialchars(stripslashes($_GET['error'])); ?>
        </div>
      <?php endif; ?>

      <!-- PHP success handler -->
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
          <?php echo htmlspecialchars(stripslashes($_GET['success'])); ?>
        </div>
      <?php endif; ?>

      <!-- Username Field -->
      <div class="form-group">
        <i class="bi bi-person-fill form-icon"></i>
        <input type="text" class="form-control" name="user_name" placeholder="Username" required>
      </div>

      <!-- Password Field with Show Toggle -->
      <div class="form-group">
        <i class="bi bi-lock-fill form-icon"></i>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
      </div>

      <!-- Login Button -->
      <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <!-- Footer Text -->
    <p class="footer-note mt-3">Your tasks, organized like never before.</p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Show Password Script -->
  <script>
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    togglePassword.addEventListener("click", () => {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);

      // Toggle icon
      togglePassword.classList.toggle("bi-eye");
      togglePassword.classList.toggle("bi-eye-slash");
    });
  </script>
</body>
</html>
