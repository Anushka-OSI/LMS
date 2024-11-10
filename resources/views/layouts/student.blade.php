<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
    }
    .sidebar {
      min-width: 250px;
      max-width: 250px;
      background-color: #343a40;
      color: white;
      height: 100vh;
      position: fixed;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
    }
    .content {
      margin-left: 250px;
      width: 100%;
      padding: 20px;
    }
    @media (max-width: 992px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
      }
      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar p-3">
    <h4 class="text-center">Dashboard</h4>
    <ul class="nav flex-column">
        <!-- Home Link (Dashboard or Main Page) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.dashboard') }}">Home</a>
        </li>

        <!-- View Available Courses Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.courses') }}">View Courses</a>
        </li>

        <!-- View Enrolled Courses Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.enrolledCourses') }}">Enrolled Courses</a>
        </li>

        <!-- Profile Link (Student Profile Page) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.onlineClasses') }}">My Online Classes</a>
        </li>

        <!-- Settings Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.settings') }}">Settings</a>
        </li>

        <!-- Logout Form -->
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link" style="background:none; border:none; color: inherit;">Logout</button>
            </form>
        </li>
    </ul>

  </div>

  <!-- Main Content -->
  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Notifications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Messages</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-4">
        @yield('content')

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
