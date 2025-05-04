<div class="sidebar-menu">
  <ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }} ">
      <a href="/dashboard" class='sidebar-link'>
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="sidebar-item {{ Request::is('data-magang') ? 'active' : '' }}">
      <a href="/data-magang" class='sidebar-link'>
        <i class="bi bi-grid-fill"></i>
        <span>Data Magang</span>
      </a>
    </li>

    @if (Auth::user()->role == 'admin')
      <li class="sidebar-item {{ Request::is('data-akun-dosen') ? 'active' : '' }}">
        <a href="/data-akun-dosen" class='sidebar-link'>
          <i class="bi bi-grid-fill"></i>
          <span>Akun Dosen</span>
        </a>
      </li>
    @endif

  </ul>
</div>
