<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +190909090</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@eshop.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href=""><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								
							</div>
							
							<div class="btn-group">
								
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">																
								<li><a href="{{ url('cart') }}">
								<i class="fa fa-shopping-cart"></i> Cart({{ getTotalQuantity()  }})</a></li>
								@guest
									<li>
									<a href="{{ route('login') }}">
									<i class="fa fa-lock"></i> 
								Login</a></li>
								<li>
									<a href="{{ route('register') }}">
								Register</a></li>
								@else 

								<li>
								<a href="{{ route('my.orders') }}">
								<i class="fa fa-lock"></i> 
							Orders</a></li>

							<li>
								<a href="{{ route('logout') }}" 
								onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<i class="fa fa-lock"></i>Logout</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>

							</li>

							<li>
								<a href="#" style="color: orange !important;">
								<i class="fa fa-user"></i> 
							{{ 'Welcome, '. auth()->user()->name . ' '}}</a>
							</li>


								@endguest
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" 
							data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ route('index') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ route('front.products') }}">Products</a></li>
										<li><a href="{{ route('cart.index') }}">Cart</a></li>
                                    </ul>
                                </li> 
								<li><a href="{{ route('contact.index') }}">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						{{ Form::open(['url' => route('front.products.search'), 'method' => 'Get']) }}
						<div class="search_box pull-right">
							<input type="text" name = "value" placeholder="Search"/>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header>