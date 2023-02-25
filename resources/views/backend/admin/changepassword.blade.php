@extends('backend.layouts.app')
@section('title', 'Internal Users')
@php
    use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Create Internal User</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                    <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group ms-lg-auto" role="group">
                            <a class="btn btn-outline-primary" href="{{ route('admin.users') }}">
                                <i class="feather icon-eye"></i> view
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <section id="basic-datatable">
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    @php
                                        $role = Role::get(['id', 'name'])->toArray();
                                    @endphp
                                    @include('backend.includes.errors')
                                    <form class="form" method="POST" action="{{ route('admin.update_password') }}" autocomplete="off">
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                        <div class="row">
                                          <div class="col-md-6 col-12">
                                            <div class="form-group">
                                              <label>Current Password *</label>
                                              <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                            <div class="form-group">
                                              {{ Form::label('new_password', 'New Password *') }}
                                              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                            <div class="form-group">
                                              {{ Form::label('new_password_confirmation', 'Confirm New Password *') }}
                                              <input type="password" class="form-control" name="new_password_confirmation" placeholder="Enter New Password again" required>
                                            </div>
                                          </div>

                                          <div class="col-12 d-flex justify-content-start">
                                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1')) }}
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    </main>
@endsection
@section('scripts')
@endsection
