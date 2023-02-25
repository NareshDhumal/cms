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
                                    {{ Form::open(['url' => 'admin/user/store']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('first_name', 'First Name *') }}
                                                    {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('last_name', 'Last Name *') }}
                                                    {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('email', 'Email *') }}
                                                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => true, 'pattern' => '[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}']) }}
                                                    {{-- Hidden PassWord field    --}}
                                                    {{ Form::hidden('account_status', 1, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('password', 'Create Password *') }}
                                                    <input type='password' name='password' class='form-control'
                                                        placeholder='Create Your Password' required='true'>
                                                    {{-- Hidden PassWord field    --}}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('password', 'Confirm Password *') }}
                                                    <input type='password' name='confirm_password' class='form-control'
                                                        placeholder='Confirm your Password' required='true'>
                                                </div>
                                            </div>

                                            {{-- input for role  --}}
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('role', 'Role *') }}
                                                    <select name="role" id="role_id" class='form-control'>
                                                        @foreach ($role as $index => $value)
                                                            <option value="{{ $value['id'] }}"> {{ $value['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{--  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                        {{ Form::label('date of birth', 'Date of birth*') }}
                                        {{ Form::text('dob', null, ['class' => 'form-control', 'placeholder' => 'Enter date of birth', 'id'=>'dob' , 'required' => true]) }}
                                      </div>  --}}
                                        </div>
                                        <div class="col md-12">
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                            <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
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
