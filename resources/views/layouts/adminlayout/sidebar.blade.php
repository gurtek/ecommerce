<section class="sidebar">
<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">NAVIGATION AREA</li>


  <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li> -->
  <li>
    <a href="{{ route('dashboard.index') }}">
      <i class="fa fa-home"></i> 
      <span>Dashboard</span>
    </a>
  </li>
  <li class="treeview">
    <a href="#"><i class="fa fa-tags fw"></i> 
      <span>Catalog</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ url('admin/categories') }}"><i class="fa fa-angle-double-right"></i> Categories</a></li>
      <li><a href="{{ url('admin/products') }}"><i class="fa fa-angle-double-right"></i> Products</a></li>
      <li><a href="{{ url('admin/brands') }}"><i class="fa fa-angle-double-right"></i> Brands</a></li>
      <li><a href="{{ url('admin/attributes') }}"><i class="fa fa-angle-double-right"></i> Attributes</a></li>
    </ul>
  </li>
  <li>
    <a href="{{ route('all.orders') }}">
      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      <span>All Orders</span>
    </a>
  </li>
  <li>
    <a href="{{ route('all.customers') }}">
      <i class="fa fa-users" aria-hidden="true"></i>
      <span>Customers</span>
    </a>
  </li>

  <li>
    <a
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
     href="{{ route('logout') }}">
      <i class="fa fa-power-off" aria-hidden="true"></i>
      <span>Logout</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		  @csrf
    </form>
  </li>


</ul>
<!-- /.sidebar-menu -->
</section>