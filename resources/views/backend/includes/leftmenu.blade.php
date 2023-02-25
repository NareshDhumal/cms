@php

use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use App\Models\backend\AdminUsers;
use App\Models\backend\UserMaster;
use Spatie\Menu\Laravel\Menu;
use Spatie\Permission\Models\Role;

$user_id = Auth()->guard('admin')->user()->id;
//dd(Auth()->guard('admin')->user()->role);
$role_id = Auth()->guard('admin')->user()->role;

$user_role = Role::where('id',$role_id)->first();

$menu_ids=explode(",",$user_role->menu_ids);
$submenu_ids=explode(",",$user_role->submenu_ids);

$backend_menubar = BackendMenubar::WhereIn('menu_id',$menu_ids)->Where(['visibility'=>1])->orderBy('sort_order')->get();
//dd($backend_menubar);
@endphp
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark mymenu">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">CMS</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu mymenu text-black">
                <div class="nav">
                    @php
                    $menu_lists = ['id'=>1,'name'=>'Dashboard'];
                    @endphp
                    <li class=" nav-item" id='dash_link'>
                        <a class="nav-link text-white" href="{{route('admin.dashboard')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    </li>
                    @php
                        foreach($backend_menubar as $menu)
                            {
                            if($menu->has_submenu == 1)
                                {
                                $backend_submenubar = BackendSubMenubar::WhereIn('submenu_id',$submenu_ids)->Where(['menu_id'=>$menu->menu_id])->get();
                                    if($backend_submenubar)
                                        {
                                            @endphp
                                            <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapse{{$menu->menu_id}}" aria-expanded="false" aria-controls="collapseLayouts">
                                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                            {{$menu->menu_name}}
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>
                                                <div class="collapse" id="collapse{{$menu->menu_id}}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                            @php
                                                foreach($backend_submenubar as $submenu)
                                                    {
                                                        $suburl = ($submenu->submenu_controller_name != "#" && $submenu->submenu_controller_name != '')?route($submenu->submenu_controller_name):'#';
                                            @endphp
                                                        <a class="nav-link text-white" href="{{ $suburl }}" data-i18n="{{ $submenu->submenu_name }}">{{ $submenu->submenu_name }}</a>
                                            @php

                                                    }
                                            @endphp
                                                    </div>
                                            @php
                                        }
                                    }else{
                                        //single menu
      $url = ($menu->menu_controller_name != "#" && $menu->menu_controller_name != '')?route($menu->menu_controller_name):'#';
                                        @endphp
                                        <li class=" nav-item" id='dash_link'>
                                            <a class="nav-link text-white" href="{{ $url }}">
                                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                            {{$menu->menu_name}}
                                            </a>
                                        </li>
                                        @php
                                    }
                                }
                    @endphp
                </div>
            </div>
        </nav>
    </div>
