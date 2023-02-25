@extends('backend.layouts.app')
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Academic Years</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Academic Years</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.year.create') }}">
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
                                        <table class="table zero-configuration table-bordered" id="tbl-datatable" style="white-space: nowrap;">
                                            <thead>
                                                <tr role="row" style="height: 0px;">
                                                    <th class="text-center sorting_asc"> Sr. No </th>

                                                    <th class="text-center sorting_asc" aria-controls="amount_table"
                                                        rowspan="1" colspan="1">
                                                        <div class="dataTables_sizing"
                                                            style=" overflow: hidden; text-color:white">Academic Year</div>
                                                    </th>

                                                    <th class="text-center sorting_asc">
                                                        Action
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($years) && count($years) > 0)
                                                    @php $srno = 1; @endphp
                                                    @foreach ($years as $data)
                                                        <tr>
                                                            <td class="text-center">{{ $srno }}</td>
                                                            <td>
                                                                @if (isset($data->academic_year))
                                                                {{ $data->academic_year }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <a href="{{ url('admin/year/edit/' . $data->academic_year_id) }}"
                                                                    class="btn btn-primary"><i class="feather icon-edit-2"></i></a>
                                                                <a href="{{ url('admin/year/delete/' . $data->academic_year_id) }}"
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
