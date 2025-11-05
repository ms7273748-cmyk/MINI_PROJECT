<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | ClubSphere</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet" />

  <style>
    /* === GLOBAL RESET === */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(180deg, #e8fdf3, #f5fff9);
      color: #1c1c1c;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      overflow: hidden;
      position: relative;
    }

    /* === FLOATING ORBS === */
    .orb {
      position: absolute;
      width: 280px;
      height: 280px;
      border-radius: 50%;
      filter: blur(60px);
      opacity: 0.5;
      animation: float 10s ease-in-out infinite alternate;
      z-index: -1;
    }

    .orb:nth-child(1) {
      top: -80px;
      left: -60px;
      background: radial-gradient(circle, rgba(0,255,163,0.25), transparent);
    }

    .orb:nth-child(2) {
      bottom: -100px;
      right: -100px;
      background: radial-gradient(circle, rgba(0,195,255,0.25), transparent);
      animation-delay: 3s;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-25px); }
    }

    /* === AUTH CONTAINER === */
    .auth-container {
      width: 400px;
      padding: 50px 40px;
      background: rgba(255,255,255,0.65);
      border-radius: 20px;
      box-shadow: 0 12px 35px rgba(0,184,148,0.15);
      backdrop-filter: blur(14px);
      animation: fadeSlide 0.8s ease;
    }

    @keyframes fadeSlide {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === HEADING === */
    .auth-container h2 {
      text-align: center;
      margin-bottom: 25px;
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.8rem;
      background: linear-gradient(90deg, #00b894, #00c3ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* === INPUTS === */
    .auth-container input {
      width: 100%;
      padding: 13px 15px;
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      margin: 10px 0;
      font-size: 0.95rem;
      background: rgba(255,255,255,0.9);
      color: #1c1c1c;
      outline: none;
      transition: all 0.25s ease;
    }

    .auth-container input:focus {
      border-color: #00b894;
      box-shadow: 0 0 12px rgba(0,184,148,0.3);
      background: #ffffff;
    }

    .auth-container input::placeholder {
      color: #777;
    }

    /* === BUTTON === */
    .auth-container button {
      width: 100%;
      padding: 13px;
      margin-top: 10px;
      border: none;
      border-radius: 25px;
      font-weight: 600;
      background: linear-gradient(90deg, #00b894, #00c3ff);
      color: #fff;
      cursor: pointer;
      transition: all 0.25s ease;
    }

    .auth-container button:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(0,184,148,0.4);
    }

    /* === FLASH MESSAGE === */
    .flash-message {
      display: inline-block;
      padding: 10px 16px;
      border-radius: 10px;
      margin: 10px auto;
      font-weight: 600;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
      backdrop-filter: blur(6px);
      border: 1px solid rgba(0,0,0,0.05);
      animation: fadeIn 0.4s ease;
      max-width: 92%;
      word-wrap: break-word;
      text-align: center;
    }

    .flash-success {
      background: rgba(0,184,148,0.1);
      color: #009d7a;
    }

    .flash-error {
      background: rgba(255,0,82,0.12);
      color: #ff4060;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === TOGGLE LINK === */
    .toggle-link {
      text-align: center;
      margin-top: 15px;
      color: #00c3ff;
      cursor: pointer;
      font-size: 0.9rem;
      transition: color 0.3s ease;
    }

    .toggle-link:hover {
      color: #00b894;
    }

    /* === ADMIN LOGIN LINK === */
    .admin-login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 0.85rem;
    }

    .admin-login-link a {
      color: #00b894;
      text-decoration: none;
      transition: 0.3s;
    }

    .admin-login-link a:hover {
      color: #00c3ff;
      text-shadow: 0 0 10px rgba(0,195,255,0.4);
    }

    /* === RESPONSIVE === */
    @media (max-width: 500px) {
      .auth-container {
        width: 90%;
        padding: 40px 25px;
      }
    }
  </style>
</head>

<body>
  <div class="orb"></div>
  <div class="orb"></div>

  <div class="auth-container">
    <div id="flashMessages"></div>

    <!-- LOGIN FORM -->
    <form id="loginForm" method="POST" action="#">
      <h2>Welcome Back 👋</h2>
      <input type="email" name="email" placeholder="Email address" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" name="login">Login</button>
      <div class="toggle-link" onclick="toggleForm()">Don't have an account? Register</div>
    </form>

    <!-- REGISTER FORM -->
    <form id="registerForm" method="POST" action="#" style="display: none;">
      <h2>Join ClubSphere 🌟</h2>
      <input type="text" name="name" placeholder="Full name" required />
      <input type="email" name="email" placeholder="Email address" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="password" name="confirm_password" placeholder="Confirm Password" required />
      <button type="submit" name="register">Register</button>
      <div class="toggle-link" onclick="toggleForm()">Already have an account? Login</div>
    </form>

    <!-- ADMIN LOGIN -->
    <div class="admin-login-link">
      <a href="#" onclick="showAdminLogin()">Admin Login</a>
    </div>
  </div>

  <script>
    function toggleForm() {
      const loginForm = document.getElementById("loginForm");
      const registerForm = document.getElementById("registerForm");
      const isLoginVisible = loginForm.style.display !== "none";
      loginForm.style.display = isLoginVisible ? "none" : "block";
      registerForm.style.display = isLoginVisible ? "block" : "none";
    }

    function showAdminLogin() {
      const emailInput = document.querySelector('input[name="email"]');
      const passwordInput = document.querySelector('input[name="password"]');
      emailInput.value = "admin@clubsphere.com";
      passwordInput.value = "admin123";
      showFlash("Admin credentials pre-filled for demo", "success");
    }

    function showFlash(message, type) {
      const flashContainer = document.getElementById("flashMessages");
      const flash = document.createElement("div");
      flash.className = `flash-message flash-${type}`;
      flash.textContent = message;
      flashContainer.appendChild(flash);
      setTimeout(() => flash.remove(), 4000);
    }

    // Login form logic
    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const email = this.querySelector('input[name="email"]').value;
      const password = this.querySelector('input[name="password"]').value;

      if (email === "admin@clubsphere.com" && password === "admin123") {
        showFlash("Login successful! Redirecting to admin dashboard...", "success");
        setTimeout(() => (window.location.href = "admin-dashboard.html"), 1500);
      } else if (email === "user@clubsphere.com" && password === "user123") {
        showFlash("Login successful! Redirecting to user dashboard...", "success");
        setTimeout(() => (window.location.href = "user-dashboard.html"), 1500);
      } else {
        showFlash("Invalid credentials. Try admin@clubsphere.com / admin123 or user@clubsphere.com / user123", "error");
      }
    });

    // Register form logic
    document.getElementById("registerForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const password = this.querySelector('input[name="password"]').value;
      const confirmPassword = this.querySelector('input[name="confirm_password"]').value;

      if (password !== confirmPassword) {
        showFlash("Passwords do not match!", "error");
        return;
      }

      if (password.length < 6) {
        showFlash("Password must be at least 6 characters long!", "error");
        return;
      }

      showFlash("Registration successful! You can now login.", "success");
      setTimeout(() => toggleForm(), 1500);
    });
  </script>
</body>
</html>
