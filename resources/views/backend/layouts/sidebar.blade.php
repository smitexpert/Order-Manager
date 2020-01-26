<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
    <li class="{{ (Route::currentRouteName() == 'dashboard') ? 'active' : '' }}{{ (Route::currentRouteName() == 'home') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li class="{{ (Route::currentRouteName() == 'add') ? 'active' : '' }}"><a href="{{ route('add') }}"><em class="fa fa-calendar-plus-o">&nbsp;</em> Add Order</a></li>
        <li class="{{ (Route::currentRouteName() == 'all') ? 'active' : '' }}"><a href="{{ route('all') }}"><em class="fa fa-search">&nbsp;</em> Find Order</a></li>
        <li class="{{ (Route::currentRouteName() == 'pending') ? 'active' : '' }}"><a href="{{ route('pending') }}"><em class="fa fa-hourglass-half">&nbsp;</em> Pending Order</a></li>
        <li class="{{ (Route::currentRouteName() == 'shipped') ? 'active' : '' }}"><a href="{{ route('shipped') }}"><em class="fa fa-paper-plane">&nbsp;</em> Shipped Order</a></li>
        <li class="{{ (Route::currentRouteName() == 'printed') ? 'active' : '' }}"><a href="{{ route('printed') }}"><em class="fa fa-print">&nbsp;</em> Printed Order</a></li>
        <li class="{{ (Route::currentRouteName() == 'courier') ? 'active' : '' }}"><a href="{{ route('courier') }}"><em class="fa fa-bicycle">&nbsp;</em> Courier Services</a></li>
        <li class="{{ (Route::currentRouteName() == 'shop') ? 'active' : '' }}"><a href="{{ route('shop') }}"><em class="fa fa-shopping-cart">&nbsp;</em> Shop Manager</a></li>
        <li class="{{ (Route::currentRouteName() == 'image') ? 'active' : '' }}"><a href="{{ route('image') }}"><em class="fa fa-picture-o">&nbsp;</em> Image Frame</a></li>
    </ul>
</div><!--/.sidebar-->