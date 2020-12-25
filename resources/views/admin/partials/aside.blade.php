
  <!-- Site header  -->
  <header class="site-header">
    <div class="site-logo"><a href="{{url("admin")}}"><img src="{{url('/')}}/uploads/logos/{{@Session::get('configs')['logo']}}" alt="Mouldifi" title="Mouldifi"></a></div>
    <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
    <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
  </header>
  <!-- /site header -->

  <!-- Main navigation -->
  <ul id="side-nav" class="main-menu navbar-collapse collapse">
    <li class="{{(Request::is('admin/dashboard/queue') || Request::is(App::getLocale().'/admin/dashboard/queue'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/dashboard/queue")}}"><i class="icon-home"></i><span class="title">صف الانتظار</span></a></li>
    {{-- @if(App\Libs\Adminauth::user()->id == 2) --}}
      @if(Auth::guard('admin')->user()->super_admin)
        <li class="{{(Request::is('admin/dashboard') || Request::is(App::getLocale().'/admin/dashboard'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/dashboard")}}"><i class="icon-home"></i><span class="title">تقارير</span></a></li>
        <li class="{{(Request::is('admin/configs/edit') || Request::is(App::getLocale().'/admin/configs/edit*'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/configs/edit")}}"><i class="icon-cog"></i><span class="title">{{trans("admin.Settings")}}</span></a></li>
        <li class="{{(Request::is('admin/configs/cruds') || Request::is(App::getLocale().'/admin/configs/cruds*'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/configs/cruds")}}"><i class="icon-cog"></i><span class="title">اعداد البيانات</span></a></li>
        <li class="{{(Request::is('admin/admins*') || Request::is(App::getLocale().'/admin/admins*'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/admins")}}"><i class="icon-users"></i><span class="title">المستخدمين</span></a></li>
      @endif

      {{-- @if(ACL::can('create-patients'))
        <li class="{{(Request::is('admin/patients/create') || Request::is(App::getLocale().'/admin/patients/create'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/patients/create")}}"><i class=" icon-plus-squared"></i><span class="title">انشاء طفل جديد</span></a></li>
      @endif

      @if(ACL::can('index-patients'))
        <li class="{{(Request::is('admin/patients') || Request::is(App::getLocale().'/admin/patients'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/patients")}}"><i class="icon-archive"></i><span class="title">عرض الاطفال</span></a></li>
      @endif --}}
      @if(Auth::guard('admin')->user()->super_admin)
        <li class="{{(Request::is('admin/roles') || Request::is(App::getLocale().'/admin/roles'))?"active":""}}"><a href="{{url("/admin/roles")}}"><i class="icon-archive"></i><span class="title">@lang('admin.Roles')</span></a></li>
      @endif
    {{-- @endif --}}
    <li class="{{(Request::is('admin/patients/create') || Request::is(App::getLocale().'/admin/patients/create'))?"active":""}}"><a href="{{url(App::getLocale()."/admin/patients/create")}}"><i class="icon-plus"></i><span class="title">انشاء ملف طفل جديد</span></a></li>

  </ul>
  <!-- /main navigation -->
