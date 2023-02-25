@extends('backend.layouts.app')
@section('title', 'Edit Batches')
@php
use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Edit Batches</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.batches') }}">Batches</a>
                                </li>

                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.batches') }}">
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
                                    {{ Form::model($batch,['url' => 'admin/batches/update']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('batch_name', 'Batch Name *') }}
                                                    {{ Form::text('batch_name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Batch Name']) }}
                                                    {{ Form::hidden('batch_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Batch Name']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('full_fees', 'Full Fees *') }}
                                                    {{ Form::text('full_fees', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Full Fees']) }}
                                                    <span> Full Fees without discount</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('fees', 'Discounted Fees *') }}
                                                    {{ Form::text('fees', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Discounted Fees Actual Fees']) }}
                                                    <span> Full Fees with discount</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('teaching_rate', 'Teaching Rate *') }}
                                                    {{ Form::text('teaching_rate', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Teaching rate']) }}
                                                    <span> Rs/Hr. </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('status', 'Status *') }}
                                                    {{ Form::select('status', [0=>'Not Active', 1=>'Active'] ,null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Status']) }}
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
    @endsection
