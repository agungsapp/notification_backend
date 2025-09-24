<nav class="sidebar sidebar-offcanvas" id="sidebar">
		<ul class="nav">

				<li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('dashboard') }}">
								<i class="icon-grid menu-icon"></i>
								<span class="menu-title">Dashboard</span>
						</a>
				</li>

				<li class="nav-item {{ request()->is('data-pengguna*') ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('data-pengguna') }}">
								<i class="icon-grid menu-icon"></i>
								<span class="menu-title">Data Pengguna</span>
						</a>
				</li>

				<li class="nav-item {{ request()->is('evaluation-question*') ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('evaluation-question') }}">
								<i class="icon-grid menu-icon"></i>
								<span class="menu-title">Evaluation Question</span>
						</a>
				</li>

				<li class="nav-item {{ request()->is('evaluation-form*') ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('evaluation-form') }}">
								<i class="icon-grid menu-icon"></i>
								<span class="menu-title">Evaluation Form</span>
						</a>
				</li>

				<li class="nav-item {{ request()->is('manage-memo*') ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('manage-memo') }}">
								<i class="icon-grid menu-icon"></i>
								<span class="menu-title">Manage Memo</span>
						</a>
				</li>


				<li class="nav-item">
						<form action="{{ route('logout') }}" method="POST">
								@csrf
								<button type="submit" class="dropdown-item nav-link">
										<i class="ti-power-off text-primary"></i> Logout
								</button>
						</form>

				</li>

		</ul>
</nav>
