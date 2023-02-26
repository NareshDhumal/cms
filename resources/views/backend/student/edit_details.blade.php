@extends('backend.layouts.app')
@section('title', 'Profile')
@php
    use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Update Details</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.students') }}">Students</a>
                                </li>

                                <li class="breadcrumb-item active">Update Student Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 ">
                    <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group ms-lg-auto" role="group">
                            <div class="col col-sm-2 mx-2">
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
                                    {{ Form::model($student,['url' => 'admin/students/store', 'method'=>'post', 'enctype'=>'multipart/form-data']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                        <h4>Basic Details</h4>
                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('student_name', 'Student Name *') }}
                                                    {{ Form::text('student_name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                    {{ Form::hidden('student_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('father_name', 'Father Name') }}
                                                    {{ Form::text('father_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Father Name']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mother_name', ' Mother Name') }}
                                                    {{ Form::text('mother_name', null, ['class' => 'form-control',  'placeholder' => 'Enter  Mother Name']) }}
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
                                                    {{ Form::label('dob', 'Date of Birth *') }}
                                                    {{ Form::text('dob', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Date of birth']) }}
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
                                                    {{ Form::label('student_name', 'Enter Email ID') }}
                                                    {{ Form::email('email', null, ['class' => 'form-control',  'placeholder' => 'Enter Email ID']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mobile', 'Parents Mobile No *') }}
                                                    {{ Form::text('parents_mobile_no', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Parents Mobile No *']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mobile', 'Father Occupation') }}
                                                    {{ Form::text('father_occupation', null, ['class' => 'form-control',  'placeholder' => 'Enter Father Occupation *']) }}
                                                </div>
                                            </div>

                                             <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mobile', 'Mother Occupation') }}
                                                    {{ Form::text('mother_occupation', null, ['class' => 'form-control',  'placeholder' => 'Enter Mother Occupation *']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mobile', 'Income') }}
                                                    {{ Form::text('income', null, ['class' => 'form-control',  'placeholder' => 'Enter Income']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('mobile', 'Address') }}
                                                    {{ Form::textarea('income', null, ['class' => 'form-control',  'placeholder' => 'Enter Full Address','rows'=>'3', 'cols'=>'12' , 'style'=>'resize:none;']) }}
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
