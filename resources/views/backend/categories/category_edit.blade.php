@extends('backend.layouts.app')
@section('title', 'Edit Category')
@section('content')
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12">
                <h4 class="content-header-title font-weight-bold">Edit Category</h4>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.category') }}">Category Master</a>
                            </li>

                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.category') }}">
                            <i class="feather icon-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">

                                @include('backend.includes.errors')
                                {!! Form::model($categories, [
                                    'method' => 'POST',
                                    'url' => ['admin/category/update'],
                                    'class' => 'form'
                                ]) !!}
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('category_name', 'Category Name *') }}
                                                {{ Form::text('category_name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Category Name']) }}
                                                {{ Form::hidden('category_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Category Name']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('category_name', 'Category Slug *') }}
                                                {{ Form::text('category_slug', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Category Slug']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('visibility', 'Visibility *') }}
                                                {{ Form::select('visibility', ['0'=>'Inactive' , '1' => 'Active'] , null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Visibility']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            {{ Form::label('sub_category', 'has Subcategory') }}
                                            <br>
                                            {{ Form::radio('sub_category', '1' , true) }}
                                            {{ Form::label('sub_category', 'Yes') }}

                                             {{ Form::radio('sub_category', '0' , false) }}
                                            {{ Form::label('sub_category', 'No') }}

                                        </div>


                                        <div class="col md-12">
                                            {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                            <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endsection
