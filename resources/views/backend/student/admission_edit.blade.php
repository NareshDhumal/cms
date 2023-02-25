@extends('backend.layouts.app')
@section('title', 'Admissions')
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
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                    <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group ms-lg-auto" role="group">
                            <div class="col col-sm-2 mx-2">
                            <a class="btn btn-outline-primary" href="{{ route('admin.students.profile',[$student->student_id]) }}">
                                <i class="feather icon-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <section class='mt-2'>
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <h1 class='text-center'>Admissions</h1>
                                    @include('backend.includes.errors')
                                    {{ Form::model($admission,['url' => 'admin/students/admission/update', 'method'=>'post', 'enctype'=>'multipart/form-data']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('student_name', 'Student Name *') }}
                                                    {{ Form::text('student_name', $student->student_name, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                    {{ Form::hidden('student_admission_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                    {{ Form::hidden('student_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Name']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('student_name', 'Academic Year *') }}
                                                    {{ Form::select('year_id', $years, null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Year']) }}
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('student_name', 'Batch *') }}
                                                    {{ Form::select('batch_id', $batchs, null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Batch', 'id'=>'batch_id']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('student_name', 'Fees *') }}
                                                     <span id='total_fees'></span>
                                                    {{ Form::hidden('total_fees', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'fees' , 'id'=>'txt_total_fees']) }}
                                                    {{ Form::text('fees', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'fees', 'id'=>'fees']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12 text-center mt-1 mb-2">
                                                {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1' , 'id'=>'frm1']) }}
                                            </div>
                                        </div>
                                    </div>
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
               $('#batch_id').change(function(){
                let batch_id =  $('#batch_id').val();
                $.ajax({
                    type : 'get',
                    url  : "{{ url('/fetch/fees/') }}/"+batch_id,
                    data : {'batch_id':batch_id},
                    contentType : "application/json",
                    success : function(resp){
                        let dataa = JSON.parse(resp);
                        $('#total_fees').html('Total Fees : '+dataa.full_fees);
                        $('#txt_total_fees').val(dataa.full_fees);
                        $('#fees').val(dataa.fees);
                    }
                    });
               });
        $('#admission_table').DataTable();
            });
        </script>
    @endsection
