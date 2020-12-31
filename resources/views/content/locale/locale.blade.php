@extends('layouts/contentLayoutMaster')

@section('title', 'Locale')

@section('content')
<!-- internationalization -->
<section id="internationalization">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Change Locale</h4>
        </div>
        <div class="card-body">
          <div class="dropdown">
            <a class="btn btn-outline-primary dropdown-toggle" href="javascript:void(0);" role="button" id="dropdown-flag" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="flag-icon flag-icon-{{app()->getLocale() == 'en'? 'us' : 'sa'}} mr-50"></i>
              <span class="selected-language">{{app()->getLocale() == 'en'? 'English' : 'Arabic'}}</span>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="{{url('lang/en')}}" data-language="en">
                <i class="flag-icon flag-icon-us mr-50"></i>
                <span>English</span>
              </a>
              <a class="dropdown-item" href="{{url('lang/ar')}}" data-language="fr">
                <i class="flag-icon flag-icon-sa mr-50"></i>
                <span>Arabic</span>
              </a>


            </div>
          </div>

          <div class="card-localization border rounded mt-3 p-2">
            <h5 class="mb-1">Title</h5>
            <p class="card-text" data-i18n="key">
              {{ __('locale.message') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ internationalization -->
@endsection
