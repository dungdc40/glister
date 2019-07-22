
<div class="collapse navbar-collapse" id="app-navbar-collapse">
	<!-- Left Side Of Navbar -->
	@if(Auth::user())
	<ul class="nav navbar-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				Khách hàng <span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="{{ route('customers.create')}}">Thêm khách hàng mới</a></li>
				<li><a href="{{ route('customers.index')}}">Xem toàn bộ khách hàng</a></li>
			</ul>
		</li>
	</ul>
	<ul class="nav navbar-nav">
		<li>
		<div class='col-xs-12' style="margin-top: 8px;">
	<form class="form-inline" action="{{ route('customers.index') }}" method="GET" enctype="multipart/form-data" role="search">
	<input type="text" class="form-control" name="search" placeholder="Tìm khách hàng theo SĐT...">
	<button type="submit" class="btn btn-success mb-2">Tìm</button>
</form>
<div>
		</li>
</ul>
	@endif

	

	<!-- Right Side Of Navbar -->
	<ul class="nav navbar-nav navbar-right">
		<!-- Authentication Links -->
	@if (Auth::guest())
		<li><a href="{{ route('login') }}">Đăng nhập</a></li>
		@else
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				{{ Auth::user()->name }} <span class="caret"></span>
			</a>

			<ul class="dropdown-menu" role="menu">
				<li>
					<a href="{{ route('logout') }}"
					   onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
						Đăng xuất
					</a>
					<a href="{{ route('changePassword.get') }}">
						Đổi mật khẩu
					</a>
				
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
			</ul>
		</li>
		@endif
		
	</ul>
</div>
