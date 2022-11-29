<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

@if (Auth::user()->hasRole('dg'))
  <!-- <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div> -->
@endif
<div class="d-flex align-items-center justify-content-between">
  <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-block d-lg-block" style="margin-right:5px;">COSTECH REPORTING MANAGEMENT SYSTEM</span>
    <img src="assets/img/costech.png" alt="">
  </a>  
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
      <ul class=" align-items-center">
          <!-- <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a> -->
          <!--</li> End Search Icon-->
        
        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">0</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 1 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul>

        </li> -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('assets/img/profile.png') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <?php 
                $role = '';
                $id = Auth::user()->id;
                $dpts = DB::select("SELECT role_user.role_id AS rolee FROM users,role_user WHERE users.id = role_user.user_id AND users.id = $id");
              
                foreach($dpts as $dpt){
                  if($dpt->rolee == 2){
                      $role = 'Director General';
                  }
                  if($dpt->rolee == 3){
                    $role = 'Director';
                  }
                  if($dpt->rolee == 4){
                    $role = 'User';
                  }
                  if($dpt->rolee == 1){
                    $role = 'Admin';
                  }
                  echo "<span>$role</span>";
                }
              ?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/profile">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <i class="bi bi-box-arrow-right"></i>
                  <button type="submit">Sign Out</button>
                </a>
              </form>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
    </header>