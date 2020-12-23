<div class="col-sm-6 col-xs-7">

<!-- User info -->
<ul class="user-info pull-left">
  <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="{{url('uploads/admin_images')}}/{{@Auth::guard('admin')->user()->profile_img}}">{{@Auth::guard('admin')->user()->name}} <span class="caret"></span></a>

  <!-- User action menu -->
  <ul class="dropdown-menu">

    <li><a href="{{url('admin/admins/edit-account')}}"><i class="icon-user"></i>{{trans("admin.My Account")}}</a></li>
    <li class="divider"></li>
    <li><a href="{{url('admin/admins/change-password')}}"><i class="icon-cog"></i>{{trans("admin.Change Password")}}</a></li>
    <li><a href="{{url('admin/auth/logout')}}"><i class="icon-logout"></i>{{trans("admin.Logout")}}</a></li>
  </ul>
  <!-- /user action menu -->

  </li>
</ul>
<!-- /user info -->

</div>

<div class="col-sm-6 col-xs-5">
<div class="pull-right">
  <!-- User alerts -->

  <!-- /user alerts -->

</div>
</div>
