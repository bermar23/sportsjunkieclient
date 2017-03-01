<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ url('/user/profile') }}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
            <li><a href="{{ url('/calendar') }}"><i class="fa fa-calendar"></i> <span>Celendar</span></a></li>
            <li><a href="{{ url('/account') }}"><i class="fa fa-dollar"></i> <span>My Account</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-map-marker"></i> <span>My Outlets</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/outlet/new') }}"><i class="fa fa-file-o"></i> New</a></li>
                    <li><a href="{{ url('/outlet') }}"><i class="fa fa-navicon"></i> All</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-tv"></i> <span>My Showing</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/showing/new') }}"><i class="fa fa-file-o"></i> New</a></li>
                    <li><a href="{{ url('/showing') }}"><i class="fa fa-navicon"></i> All</a></li>
                </ul>
            </li>
            <!--<li class="treeview">
                <a href="#"><i class="fa fa-plane"></i> <span>My Travel</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/travel/new') }}"><i class="fa fa-file-o"></i> New</a></li>
                    <li><a href="{{ url('/travel') }}"><i class="fa fa-navicon"></i> All</a></li>
                </ul>
            </li>-->
            <li class="treeview">
                <a href="#"><i class="fa fa-money"></i> <span>My Merchandise</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/merchandise/new') }}"><i class="fa fa-file-o"></i> New</a></li>
                    <li><a href="{{ url('/merchandise') }}"><i class="fa fa-navicon"></i> All</a></li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
