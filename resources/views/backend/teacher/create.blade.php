@extends('backend.layouts.app')
@section('title', 'Create Teacher')
@php
use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Create Teacher</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.teachers') }}">Teachers</a>
                                </li>

                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.dashboard') }}">
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
                                    {{ Form::open(['url' => 'admin/teachers/store', 'method'=>'post', 'enctype'=>'multipart/form-data']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('full_name', 'Full Name *') }}
                                                    {{ Form::text('full_name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('email', 'Email ID*') }}
                                                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Email']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mobile', 'Mobile No *') }}
                                                    {{ Form::text('mobile', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Mobile No *']) }}
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

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('edu_details', 'Highest Education *') }}
                                                    {{ Form::text('edu_details', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter education details']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('address', 'Address Details *') }}
                                                    {{ Form::textarea('address', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Address details', 'style'=>'resize:none', 'rows'=>3, 'cols'=>'12']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('picure', 'Select picture *') }}
                                                    <input type="file" name="picture" class="form-control" placeholder='select Teacher Picture' required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('picure', 'Resume file *') }}
                                                    <input type="file" name="resume" class="form-control" placeholder='select Teacher Resume' required>
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
