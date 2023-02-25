@extends('backend.layouts.app')
@section('title', 'Register Student')
@php
use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Register Student</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.teachers') }}">Students</a>
                                </li>

                                <li class="breadcrumb-item active">Registration</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.students') }}">
                            <i class="feather icon-arrow-left"></i> Back
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
                                    {{ Form::open(['url' => 'admin/students/store', 'method'=>'post', 'enctype'=>'multipart/form-data']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('student_name', 'Student Name *') }}
                                                    {{ Form::text('student_name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mobile', 'Mobile No *') }}
                                                    {{ Form::text('mobile_no', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Mobile No *']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('dob', 'Date of Birth *') }}
                                                    {{ Form::text('dob', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Date of birth']) }}
                                                    <input type="hidden" name="status" value='1'>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('dob', 'Gender *') }}
                                                    {{ Form::select('gender',['Male'=>'Male','Female'=>'Female','Other'=>'Other'], null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Gender']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12 text-center mt-1 mb-2">
                                                {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1' , 'id'=>'frm1']) }}
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
            </section>
        </main>
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
    @endsection
