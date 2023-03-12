@extends('backend.layouts.app')
@section('title', 'Accept Fees')
@php
use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Accept Fees</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.fees.collection') }}">Fees Collection</a>
                                </li>

                                <li class="breadcrumb-item active">Accept Fees</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.fees.collection') }}">
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
                                    {{ Form::open(['url' => 'admin/student/fees/store' , 'id'=>'fees_form']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('Student Name', 'Student Name *') }}
                                                    {{ Form::select('student_id', $students , null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Student', 'id'=>'student_id']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('Roll No', 'Roll No *') }}
                                                    {{ Form::select('roll_no', [''=>'Select Roll No'] , null, ['class' => 'form-control', 'required' => true, 'id'=>'roll_no']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    <span id="total_fees_label"> Total Fees :</span><br>
                                                    <span id="paid_fees_label"> Paid Fees : </span><br>
                                                    <span id="remain_fees_label">Remain Fees : </span>

                                                    {{ Form::hidden('totalfees', null, ['class' => 'form-control', 'required' => true, 'Placeholder'=>'Total Fees', 'id'=>'totalfees']) }}
                                                    {{ Form::hidden('paidfees', null, ['class' => 'form-control', 'required' => true, 'Placeholder'=>'Total Fees', 'id'=>'paidfees']) }}
                                                    {{ Form::hidden('remainfees', null, ['class' => 'form-control', 'required' => true, 'Placeholder'=>'Total Fees', 'id'=>'remainfees']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('payment Method', 'Payment Type *') }}
                                                    {{ Form::select('payment_method', $payment_method , null, ['class' => 'form-control', 'required' => true, 'id'=>'payment_method', 'placeholder'=>'Select Payment Method']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2 reference_no_box">
                                                <div class="form-group">
                                                    {{ Form::label('total fees', 'Cheque/Reference No *') }}
                                                    {{ Form::text('reference_no', null, ['class' => 'form-control', 'required' => true, 'Placeholder'=>'Cheque/Reference No','id'=>'reference_no']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('total fees', 'Payment Date *') }}
                                                    {{ Form::text('payment_date', null, ['class' => 'form-control', 'required' => true, 'Placeholder'=>'Payment Date','id'=>'payment_date']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2 reference_no_box">
                                                <div class="form-group">
                                                    {{ Form::label('total fees', 'Amount *') }}
                                                    {{ Form::text('amount', null, ['class' => 'form-control', 'required' => true, 'Placeholder'=>'Cheque/Reference No','id'=>'amount']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('payment Method', 'Payment Status *') }}
                                                    {{ Form::select('status', $payment_status , 'successful', ['class' => 'form-control', 'required' => true,  'placeholder'=>'Select Payment Status', 'id'=>'amount']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('total fees', 'Description *') }}
                                                    {{ Form::text('description', null, ['class' => 'form-control',  'Placeholder'=>'Description']) }}
                                                </div>
                                            </div>


                                            <div class="col-md-12 col-12 text-center mt-1 mb-2">
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
            </section>
        </main>
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function(){
            //On page Load Event
            load_roll_no();
            load_fees();
            show_ref_no();


            $('#student_id').change(function(){
                load_roll_no();
            });

            $('#roll_no').change(function(){
                load_fees();
            });

            //prevent form submit
            $("#fees_form").submit(function(e){
                e.preventDefault();
            });

            $('#payment_method').change(function(){
                show_ref_no();
            });
        });

        function load_roll_no()
        {
            let student_id = $('#student_id').val();
                if(student_id != ''){
                    $.ajax({
                    type : 'get',
                    url  : "{{ url('/fetch/student/admissions/') }}/"+student_id,
                    data : {},
                    //contentType : "application/json",
                    success : function(resp){
                        $('#roll_no').html(resp);
                    }
                });
            }
        }

        //function  load Fees
        function load_fees(){
            let roll = $('#roll_no').val();
            if(roll !=''){
                $.ajax({
                    type : 'get',
                    url  : "{{ url('/fetch/student/admissions/fees/') }}/"+roll,
                    data : {},
                    contentType : "application/json",
                    success : function(resp){
                    const obj = JSON.parse(resp);
                    //set values in label
                    $('#total_fees_label').html('Total Fees : '+obj.fees);
                    $('#paid_fees_label').html('Paid Fees : '+obj.paid_fees);
                    $('#remain_fees_label').html('Remain Fees : '+obj.remain_fees);

                    //set value in textbox
                    $('#totalfees').val(obj.fees);
                    $('#paidfees').val(obj.paid_fees);
                    $('#remainfees').val(obj.remain_fees);
                    }
                });
            }//end if
        }

        //hide and show check/ref no
        function show_ref_no(){
            let pay_method = $('#payment_method').val();
            if(pay_method == 'cash'){
                $('.reference_no_box').hide();
                $('#reference_no').attr('required',false);
            }else{
                $('.reference_no_box').show();
                $('#reference_no').attr('required',true);
            }

        }
    </script>
    @endsection
