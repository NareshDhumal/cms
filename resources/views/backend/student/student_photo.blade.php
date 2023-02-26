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
                    <h4 class="content-header-title font-weight-bold">Profile</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.students') }}">Students</a>
                                </li>

                                <li class="breadcrumb-item active">Profile</li>
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
                                    <div class="row justify-content-center d-flex">
                                    <h3 class='text-center'>Update Profile Photo</h3>
                                    @include('backend.includes.errors')

                                            <div class="col-md-4 col-12">
                                            {{ Form::open(['url' => 'admin/students/profile/photo/update', 'method'=>'post', 'enctype'=>'multipart/form-data']) }}
                                            @csrf
                                            {{form::file('profile_photo',['class'=>'form-control', 'placeholder'=>'Select Profile Photo', 'required'=>true])}}
                                            {{form::hidden('student_id',$student->student_id, ['class'=>'form-control'])}}
                                            </div>

                                            <div class="col-md-3 col-12">
                                                {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1' , 'id'=>'frm1']) }}
                                                <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                                                {{form::close()}}
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
        <script>
            $(document).ready(function() {

            });
        </script>
    @endsection
