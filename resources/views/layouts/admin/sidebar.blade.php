@if (request()->cookie('theme')=="dark")
<nav class="pcoded-navbar navbar-dark brand-dark">
@else
<nav class="pcoded-navbar navbar-light brand-light">
@endif
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="admin/" class="b-brand">
                    <div class="b-bg">
                        <i class="feather icon-trending-up"></i>
                    </div>
                    <span class="b-title">Brilio.Net</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Main Navigation</label>
                    </li>
                    <li class="nav-item {{ Request::url()== url('/admin') ? 'active' : '' }} "> 
                        <a href="{{config('app.url')}}admin" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item {{ Request::url()== url('/admin/operation') ? 'active' : '' }} "> 
                        <a href="{{config('app.url')}}admin/operation" class="nav-link"><span class="pcoded-micon"><i class="feather icon-monitor"></i></span><span class="pcoded-mtext">Operation</span></a>
                    </li>
                    <li class="nav-item {{ Request::url()== url('/admin/preprocessing') ? 'active' : '' }} "> 
                        <a href="{{config('app.url')}}admin/preprocessing" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Preprocessing</span></a>
                    </li>
                    <li class="nav-item {{ Request::url()== url('/admin/similarity') ? 'active' : '' }} "> 
                        <a href="{{config('app.url')}}admin/similarity" class="nav-link"><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Similarity</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>