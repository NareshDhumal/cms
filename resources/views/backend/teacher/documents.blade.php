@extends('backend.layouts.app')
@section('title', 'Documents')
@php
    use Spatie\Permission\Models\Role;
  //  dd($teacher->toArray());
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Documents</h4>
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

                                <li class="breadcrumb-item active">Documents</li>
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
                                    <h5>{{$teacher->full_name}}</h5>

                                    {{ Form::model($teacher, ['url' => 'admin/teachers/documents/store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-4 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('full_name', 'Enter Document Name *') }}
                                                    {{Form::text('doc_name', null,['class'=>'form-control','placeholder'=>'Enter Document Name ', 'required'=>true ])}}
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12 mt-1 mb-2">
                                                <div class="form-group">
                                                    {{ Form::label('full_name', 'Select Picture *') }}
                                                    {{ Form::file('doc_file', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Document']) }}
                                                    {{ Form::hidden('teacher_id', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select file']) }}
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12 text-center mt-3 mb-2">
                                                {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1', 'id' => 'frm1']) }}
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>

                                <div class="table-responsive">
                                    <table class="table zero-configuration table-bordered" id="tbl-datatable"
                                        style="white-space: nowrap;">
                                        <thead>
                                            <tr role="row" style="height: 0px;">
                                                <th class="text-center sorting_asc"> Sr. No </th>

                                                <th class="text-center sorting_asc" >Doc Name </th>
                                                <th class="text-center sorting_asc">
                                                    Action
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($teacher->documents) && count($teacher->documents) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($teacher->documents as $data)
                                                    <tr>
                                                        <td class="text-center">{{ $srno }}</td>
                                                        <td class="text-center">{{ $data->doc_name }}</td>
                                                        <td class="text-center">{{ $data->doc_name }}</td>


                                                        <td>
                                                            <a href="{{asset('/public/uploads/teachers/documents/'.$data->teacher_id.'/'.$data->doc_file)}}" target='_new'> <span class="btn btn-info"> View</span> </a>

                                                            <a href="{{ url('admin/teachers/documents/delete/' . $data->teacher_document_id) }}"
                                                                class="btn btn-danger"
                                                                onclick="return confirm('Do You Want to Delete Document ?')"><i
                                                                    class="feather icon-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @php $srno++; @endphp
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
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
