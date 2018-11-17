<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                         </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="{{route('home')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @if(Auth::user()->type=='admin')
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Categories</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('category.index')}}">First Category</a></li>
                        <li><a href="{{route('subcategory.index')}}">Secound Category</a></li>
                        <li><a href="{{route('third.category')}}">Third Category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Coupons</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ route('admin.coupons.create') }}">Add Coupons</a></li>
                        <li><a href="{{ route('admin.coupons.list') }}">Coupons List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Setting</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="#">Shipping List / Prices</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('gallery.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Gallery</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">User</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('user.index')}}">Active User</a></li>
                        <li><a href="{{route('user.deactive')}}">De-Active User</a></li>
                        <li><a href="{{ route('register') }}">Register User</a></li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->type=='seller')
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Product</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('product.create')}}">Add Product</a></li>
                        <li><a href="{{route('product.index')}}">Product List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('order.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Orders List</span></a>
                </li>
                <li>
                    <a href="{{route('coupons.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Coupons</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="#">Sales Report</a></li>
                    </ul>
                </li>
            @endif
        </ul>

    </div>
</nav>