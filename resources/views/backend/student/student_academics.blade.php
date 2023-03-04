@extends('backend.layouts.app')
@section('title', 'Student Academics')
@php
    use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Student Academics</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.students') }}">Students</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.teachers.profile', [$student->student_id]) }}">Profile</a>
                                </li>

                                <li class="breadcrumb-item active">Academics</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                    <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group ms-lg-auto" role="group">
                            <a class="btn btn-outline-primary"
                                href="{{ route('admin.students.profile', [$student->student_id]) }}">
                                <i class="feather icon-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <section id="basic-datatable" class='mt-3'>
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <h4>Academics Details</h4>
                                    @include('backend.includes.errors')
                                    {{ Form::model($student, ['url' => 'admin/students/academics/store', 'method' => 'post']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('exam name', 'Exam Name *') }}
                                                    {{ Form::hidden('student_id', null, [ 'class' => 'form-control', 'placeholder' => '']) }}
                                                    {{ Form::text('exam', null, [ 'class' => 'form-control', 'placeholder' => 'Exam name' , 'required'=>true]) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('school_board', 'Boad Name *') }}
                                                    {{ Form::text('school_board', null, [ 'class' => 'form-control', 'placeholder' => 'University/Board/Institute', 'required'=>true]) }}
                                                </div>
                                            </div>

                                             <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('score', 'Score *') }}
                                                    {{ Form::text('score', null, [ 'class' => 'form-control', 'placeholder' => 'Score', 'required'=>true]) }}
                                                </div>
                                            </div>

                                             <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('year', 'Year *') }}
                                                    {{ Form::text('year', null, [ 'class' => 'form-control', 'placeholder' => 'Year', 'required'=>true, 'pattern'=>'[0-9]{4}']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 text-center mt-3 mb-2">
                                                {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1', 'id' => 'frm1']) }}
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section>

                    <section id="basic-datatable" class='mt-3'>
                        <div class="container-fluid">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body card-dashboard">
                                            <h4>Details</h4>
                                            <table class="table zero-configuration table-bordered" id="tbl-datatable"
                                            style="white-space: nowrap;">
                                            <thead>
                                            <tr>
                                            <th>Sr. No.</th>
                                            <th>Exam Name</th>
                                            <th>Board / Institute / University</th>
                                            <th>Score</th>
                                            <th>Year</th>
                                            <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($student->academics) && count($student->academics) > 0)
                                                    @foreach ($student->academics as $academics)
                                                    <tr>
                                                        <td class='text-center'>{{$loop->index+1}}</td>
                                                        <td>{{ $academics->exam}}</td>
                                                        <td>{{ $academics->school_board}}</td>
                                                        <td>{{ $academics->score}}</td>
                                                        <td>{{ $academics->year}}</td>
                                                        <td>
                                                            <a href="{{ route('admin.students.academics.delete',[$academics->student_acadmic_id]) }}" onclick="return confirm('Do you Want to delete This Entry?')">
                                                                <span class="btn btn-danger">Delete</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
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
