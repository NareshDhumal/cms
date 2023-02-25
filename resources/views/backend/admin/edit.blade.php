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
                    <h4 class="content-header-title font-weight-bold">Edit Internal User</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
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
                                    @include('backend.includes.errors')
                                    {{ Form::open(['url' => 'admin/user/update']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    {{ Form::label('fullname', 'First Name *') }}
                                                    {{ Form::hidden('admin_user_id', $userdata->admin_user_id, ['class' => 'form-control']) }}
                                                    {{ Form::text('first_name', $userdata->first_name, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    {{ Form::label('fullname', 'Last Name *') }}
                                                    {{ Form::text('last_name', $userdata->last_name, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    {{ Form::label('email', 'Email *') }}
                                                    {{ Form::email('email', $userdata->email, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => true,'pattern'=>"[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}"]) }}

                                                </div>
                                            </div>

                                            {{-- input for role --}}

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    {{ Form::label('role_id', 'Role *') }}
                                                    <select name="role" id="role" class='form-control'>
                                                        @foreach ($role as $value)
                                                            <option value="{{ $value['id'] }}"
                                                                @if ($value['id'] == $userdata->role) selected @endif>
                                                                {{ $value['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    {{ Form::label('date of birth', 'Date of birth*') }}
                                                    {{ Form::text('dob', $userdata->dob, ['class' => 'form-control', 'placeholder' => 'Enter date of birth', 'id' => 'dob', 'required' => true]) }}
                                                </div>
                                            </div> --}}

                                            <div class="col md-12 center">
                                                <br>
                                                <center>
                                                    {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                                    <button type="reset" class="btn btn-secondary mr-1 mb-1">Reset</button>
                                                </center>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="basic-datatable mt-2">
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    @include('backend.includes.errors')
                                    {{ Form::open(['url' => 'admin/user/status']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="col-12">
                                            <div class="col-md-12">
                                                <div class="form-label-group">
                                                    {{ Form::label('fullname', 'Status *') }}
                                                    {{ Form::hidden('admin_user_id', $userdata->admin_user_id, ['class' => 'form-control']) }}
                                                    {!! Form::select('account_status',['0'=>'Inactive', '1'=> 'Active'] , $userdata->account_status, ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-md-6 col-12 pt-2">
                                                    {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                                    {{--  <button type="reset" class="btn btn-secondary mr-1 mb-1">Reset</button>  --}}
                                                </div>
                                                {{ Form::close() }}
                                            </div>
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
