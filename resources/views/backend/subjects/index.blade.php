@extends('backend.layouts.app')
@section('title', 'Subjects')
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Subjects</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.batches') }}">Batches</a>
                                </li>
                                <li class="breadcrumb-item active">Subjects</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.subjects.create',[$batch->batch_id]) }}">
                            <i class="feather icon-plus"></i> Add
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
                                    <div class="table-responsive">
                                        <table class="table zero-configuration table-bordered" id="tbl-datatable"
                                            style="white-space: nowrap;">
                                            <thead>
                                                <tr role="row" style="height: 0px;">
                                                    <th class="text-center sorting_asc"> Sr. No </th>

                                                    <th class="text-center sorting_asc" aria-controls="amount_table"
                                                        rowspan="1" colspan="1">
                                                        <div class="dataTables_sizing"
                                                            style=" overflow: hidden; text-color:white">Subject Name</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($batch->subjects) && count($batch->subjects) > 0)
                                                    @php $srno = 1; @endphp
                                                    @foreach ($batch->subjects as $data)
                                                        <tr>
                                                            <td class="text-center">{{ $srno }}</td>
                                                            <td>
                                                                @if (isset($data->subject_name))
                                                                    {{ $data->subject_name }}
                                                                @endif
                                                            </td>


                                                            <td>
                                                                <a href="{{ url('admin/subjects/edit/' . $data->subject_id) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="feather icon-edit-2"></i></a>
                                                                <a href="{{ url('admin/subjects/delete/' . $data->subject_id) }}"
                                                                    class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure you want to Delete this Entry ?')"><i
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
                </div>
            </section>
        </main>
    @endsection
    @section('scripts')
    @endsection
