@extends('backend.layouts.app')
@section('title', 'Edit Teacher')
@php
    use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Edit Teacher</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.teachers') }}">Teachers</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.teachers.profile', [$teacher->teacher_id]) }}">Profile</a>
                                </li>

                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                    <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group ms-lg-auto" role="group">
                            <a class="btn btn-outline-primary"
                                href="{{ route('admin.teachers.profile', [$teacher->teacher_id]) }}">
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
                                    <h4>Teacher Status</h4>
                                    @include('backend.includes.errors')
                                    {{ Form::model($teacher, ['url' => 'admin/teachers/status/update', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('full_name', 'Status *') }}
                                                    {{ Form::select('status', ['1' => 'Active', '0' => 'Not Active'], null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Status']) }}
                                                    {{ Form::hidden('teacher_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
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
                                            <h4>Profile Details</h4>

                                            {{ Form::model($teacher, ['url' => 'admin/teachers/profile/update', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12 mt-1 mb-2">
                                                        <div class="form-group">
                                                            {{ Form::label('full_name', 'Full Name *') }}
                                                            {{ Form::text('full_name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                            {{ Form::hidden('teacher_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
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
                                                            {{ Form::text('mobile', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Mobile No']) }}
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
                                                            {{ Form::select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Gender']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12 mt-1 mb-2">
                                                        <div class="form-group">
                                                            {{ Form::label('edu_details', ' Highest Education *') }}
                                                            {{ Form::text('edu_details', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter education details ']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12 mt-1 mb-2">
                                                        <div class="form-group">
                                                            {{ Form::label('address', 'Address Details *') }}
                                                            {{ Form::textarea('address', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Address details ', 'style' => 'resize:none', 'rows' => 3, 'cols' => '12']) }}
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12 col-12 text-center mt-1 mb-2">
                                                        {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1', 'id' => 'frm1']) }}
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

                    {{-- education details --}}
                    <section id="basic-datatable" class='mt-3'>
                        <div class="container-fluid">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body card-dashboard">
                                            <h4>Education Details</h4>

                                            {{ Form::model($teacher, ['url' => 'admin/teachers/update/education', 'method' => 'post']) }}
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="row m-2 mt-5 d-flex ">
                                                        {{ Form::hidden('teacher_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                        @if (isset($teacher->education) && count($teacher->education))
                                                            @foreach ($teacher->education as $education)
                                                                <div class="row m-2 P-2  box_border_black"
                                                                    id="edu_{{ $loop->index }}">
                                                                    <div class="col-md-2 col-12 mt-1 mb-2">
                                                                        <div class="form-group">
                                                                            {{ Form::label('address', 'Course ') }}
                                                                            {{ Form::text('old_education[' . $loop->index . '][course]', $education->course, ['data-name' => 'course', 'class' => 'form-control', 'placeholder' => 'Course']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3 col-12 mt-1 mb-2">
                                                                        <div class="form-group">
                                                                            {{ Form::label('address', 'University/Board/Institute') }}
                                                                            {{ Form::text('old_education[' . $loop->index . '][institute]', $education->institute, ['data-name' => 'institute', 'class' => 'form-control', 'placeholder' => 'University/Board/Institute']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 col-12 mt-1 mb-2">
                                                                        <div class="form-group">
                                                                            {{ Form::label('address', 'Year') }}
                                                                            {{ Form::text('old_education[' . $loop->index . '][year]', $education->year, ['data-name' => 'year', 'class' => 'form-control', 'placeholder' => 'Year']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 col-12 mt-1 mb-2">
                                                                        <div class="form-group">
                                                                            {{ Form::label('address', 'Remark/Grade') }}
                                                                            {{ Form::text('old_education[' . $loop->index . '][remark]', $education->remark, ['data-name' => 'remark', 'class' => 'form-control', 'placeholder' => 'Remark']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 col-12 mt-1 mb-2 mt-3">
                                                                        <div class="pull-right remove-btn">
                                                                            <span
                                                                                class="btn btn-danger remove-btn remove_btn"
                                                                                id="{{ $loop->index }}">
                                                                                Remove
                                                                            </span>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        <div id="repeater">
                                                            <div class="row">
                                                                <div class="col-md-1 col-12 mt-1 mb-2">
                                                                    <span
                                                                        class="btn btn-primary pull-right repeater-add-btn">
                                                                        Add
                                                                    </span>
                                                                </div>
                                                                {{-- {{dd($teacher->toArray())}} --}}
                                                            </div>
                                                            <div class="repeater-heading">
                                                                <div class="items" data-group="education_details">
                                                                    <div class="row m-2 P-2 item-content  box_border_black">
                                                                        <div class="col-md-2 col-12 mt-1 mb-2">
                                                                            <div class="form-group">
                                                                                {{ Form::label('address', 'Course ') }}
                                                                                {{ Form::text('course', null, ['data-name' => 'course', 'class' => 'form-control', 'placeholder' => 'Course']) }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3 col-12 mt-1 mb-2">
                                                                            <div class="form-group">
                                                                                {{ Form::label('address', 'University/Board/Institute') }}
                                                                                {{ Form::text('institute', null, ['data-name' => 'institute', 'class' => 'form-control', 'placeholder' => 'University/Board/Institute']) }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2 col-12 mt-1 mb-2">
                                                                            <div class="form-group">
                                                                                {{ Form::label('address', 'Year') }}
                                                                                {{ Form::text('year', null, ['data-name' => 'year', 'class' => 'form-control', 'placeholder' => 'Year']) }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2 col-12 mt-1 mb-2">
                                                                            <div class="form-group">
                                                                                {{ Form::label('address', 'Remark/Grade') }}
                                                                                {{ Form::text('remark', null, ['data-name' => 'remark', 'class' => 'form-control', 'placeholder' => 'Remark']) }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2 col-12 mt-1 mb-2 mt-3">
                                                                            <div class="pull-right repeater-remove-btn">
                                                                                <span class="btn btn-danger remove-btn">
                                                                                    Remove
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12 text-center mt-1 mb-2">
                                                            {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1', 'id' => 'frm1']) }}
                                                            <button type="reset"
                                                                class="btn btn-dark mr-1 mb-1">Reset</button>
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
                        <section>



                            <section id="basic-datatable" class='mt-3'>
                                <div class="container-fluid">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body card-dashboard">
                                                    <h4>Resume</h4>

                                                    {{ Form::model($teacher, ['url' => 'admin/teachers/update/resume', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                                <div class="form-group">
                                                                    {{ Form::label('full_name', 'Select Resume *') }}
                                                                    {{ Form::file('resume',  ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Resume']) }}
                                                                    {{ Form::hidden('teacher_id', null, ['class' => 'form-control', 'required' => true]) }}
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12 text-center mt-3 mb-2">
                                                                {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1', 'id' => 'frm1']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{Form::close()}}
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
                                                            <h4>Profile Photo</h4>

                                                            {{ Form::model($teacher, ['url' => 'admin/teachers/update/picture', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                                            @csrf
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12 mt-1 mb-2">
                                                                        <div class="form-group">
                                                                            {{ Form::label('full_name', 'Select Picture *') }}
                                                                            {{ Form::file('picture',  ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Picture']) }}
                                                                            {{ Form::hidden('teacher_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 col-12 text-center mt-3 mb-2">
                                                                        {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1', 'id' => 'frm1']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{Form::close()}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <section>


        </main>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $("#repeater").createRepeater({
                    showFirstItemToDefault: true,
                })

                //old data remove btn
                $('.remove_btn').click(function() {
                    let mid = $(this).attr('id');
                    let conf = confirm('do you want to delete this entry');
                    if (conf) {
                        $('#edu_' + mid).remove();
                    }
                });

            });
        </script>
    @endsection
