
@php $input='name'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Name')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,null,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- @php $input='guard_name'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Permissions')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select($input, , $row->permissions->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div> --}}



<!-- Vertical Wizard -->
<section class="vertical-wizard">
    <div class="bs-stepper vertical vertical-wizard-example">
      <div class="bs-stepper-header">
        <div class="step" data-target="#pane1">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">1</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">@lang('admin.Child info')</span>
              {{-- <span class="bs-stepper-subtitle">Setup Account Details</span> --}}
            </span>
          </button>
        </div>
        <div class="step" data-target="#pane2">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">2</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">@lang('admin.Family medical history')</span>
              {{-- <span class="bs-stepper-subtitle">Add Personal Info</span> --}}
            </span>
          </button>
        </div>
        <div class="step" data-target="#pane3">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">3</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">@lang('admin.Child medical history')</span>
              {{-- <span class="bs-stepper-subtitle">Add Address</span> --}}
            </span>
          </button>
        </div>
        <div class="step" data-target="#pane4">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">4</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">@lang('admin.How you know us')</span>
              {{-- <span class="bs-stepper-subtitle">Add Social Links</span> --}}
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <div id="pane1" class="content">
          <div class="content-header">
            <h5 class="mb-0">@lang('admin.Child info')</h5>
            {{-- <small class="text-muted">Enter Your Account Details.</small> --}}
          </div>
          <div class="row">
           @php $input = 'name'; @endphp
            <div class="form-group col-md-6">
                {!! Form::rawLabel($input,trans('admin.Name')."<em class='red'>*</em>",['class' => 'form-label']) !!}
                    {!! Form::text($input,null,['class'=>'form-control']) !!}
                    @foreach(@$errors->get($input) as $message)
                    <span class = "help-inline text-danger">{{ $message }}</span>
                    @endforeach
            </div>
           @php $input = 'birthdate'; @endphp
            <div class="form-group col-md-6">
                {!! Form::rawLabel($input,ــ('admin.Birth Date')."<em class='red'>*</em>",['class' => 'form-label']) !!}
                    {!! Form::date($input,null,['class'=>'form-control flatpickr-inline flatpickr-input']) !!}
                    @foreach($errors->get($input) as $message)
                    <span class="help-inline text-danger">{{ $message }}</span>
                    @endforeach
            </div>


          </div>
          <div class="row">
            <div class="form-group form-password-toggle col-md-6">
              <label class="form-label" for="vertical-password">Password</label>
              <input
                type="password"
                id="vertical-password"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              />
            </div>
            <div class="form-group form-password-toggle col-md-6">
              <label class="form-label" for="vertical-confirm-password">Confirm Password</label>
              <input
                type="password"
                id="vertical-confirm-password"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              />
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <button class="btn btn-outline-secondary btn-prev" disabled>
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>
        <div id="pane2" class="content">
          <div class="content-header">
            <h5 class="mb-0">Personal Info</h5>
            <small>Enter Your Personal Info.</small>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-first-name">First Name</label>
              <input type="text" id="vertical-first-name" class="form-control" placeholder="John" />
            </div>
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-last-name">Last Name</label>
              <input type="text" id="vertical-last-name" class="form-control" placeholder="Doe" />
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-country">Country</label>
              <select class="select2 w-100" id="vertical-country">
                <option label=" "></option>
                <option>UK</option>
                <option>USA</option>
                <option>Spain</option>
                <option>France</option>
                <option>Italy</option>
                <option>Australia</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-language">Language</label>
              <select class="select2 w-100" id="vertical-language" multiple>
                <option>English</option>
                <option>French</option>
                <option>Spanish</option>
              </select>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <button class="btn btn-primary btn-prev">
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>
        <div id="pane3" class="content">
          <div class="content-header">
            <h5 class="mb-0">Address</h5>
            <small>Enter Your Address.</small>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-address">Address</label>
              <input
                type="text"
                id="vertical-address"
                class="form-control"
                placeholder="98  Borough bridge Road, Birmingham"
              />
            </div>
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-landmark">Landmark</label>
              <input type="text" id="vertical-landmark" class="form-control" placeholder="Borough bridge" />
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="pincode2">Pincode</label>
              <input type="text" id="pincode2" class="form-control" placeholder="658921" />
            </div>
            <div class="form-group col-md-6">
              <label class="form-label" for="city2">City</label>
              <input type="text" id="city2" class="form-control" placeholder="Birmingham" />
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <button class="btn btn-primary btn-prev">
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none">Next</span>
              <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
            </button>
          </div>
        </div>
        <div id="pane4" class="content">
          <div class="content-header">
            <h5 class="mb-0">Social Links</h5>
            <small>Enter Your Social Links.</small>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-twitter">Twitter</label>
              <input type="text" id="vertical-twitter" class="form-control" placeholder="https://twitter.com/abc" />
            </div>
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-facebook">Facebook</label>
              <input type="text" id="vertical-facebook" class="form-control" placeholder="https://facebook.com/abc" />
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-google">Google+</label>
              <input type="text" id="vertical-google" class="form-control" placeholder="https://plus.google.com/abc" />
            </div>
            <div class="form-group col-md-6">
              <label class="form-label" for="vertical-linkedin">Linkedin</label>
              <input type="text" id="vertical-linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <button class="btn btn-primary btn-prev">
              <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-success btn-submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Vertical Wizard -->
