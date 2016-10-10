<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin-assets/dist/img/user-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">GENERAL</li>
            <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-file-text-o"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('admin::place.index') }}"><i class="fa fa-anchor"></i> <span>Places</span></a></li>
            <li><a href="{{ route('admin::route.index') }}"><i class="fa fa-rouble"></i> <span>Routes</span></a></li>
            <li><a href="{{ route('admin::disability.index') }}"><i class="fa fa-wheelchair"></i> <span>Disability Types</span></a></li>
            <li><a href="{{ route('admin::pin.index') }}"><i class="fa fa-plane"></i> <span>Pins</span></a></li>
            <li><a href="{{ route('admin::settings') }}"><i class="fa fa-gear"></i> <span>Settings</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>