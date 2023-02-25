@extends('backend.layouts.app')
@section('title', 'Batches')
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Batches</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Batches</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.batches.create') }}">
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
                                                            style=" overflow: hidden; text-color:white">Batch Name</div>
                                                    </th>
                                                    <th>Fees</th>
                                                    <th>Discounted Fees</th>
                                                    <th>Teaching Rate</th>
                                                    <th>Status</th>
                                                    <th class="text-center sorting_asc">
                                                        Action
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($batches) && count($batches) > 0)
                                                    @php $srno = 1; @endphp
                                                    @foreach ($batches as $data)
                                                        <tr>
                                                            <td class="text-center">{{ $srno }}</td>
                                                            <td>
                                                                @if (isset($data->batch_name))
                                                                    {{ $data->batch_name }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $data->full_fees }}</td>
                                                            <td>{{ $data->fees }}</td>
                                                            <td>{{ $data->teaching_rate }}</td>
                                                            <td>
                                                                @if (isset($data->status) && $data->status == 1)
                                                                    <span class='text-success'>Active</span>
                                                                @else
                                                                    <span class='text-secondary'>Not Active</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <a href="{{url('/')}}/admin/subjects/{{ $data->batch_id }}">

                                                                <span class="btn btn-info"> <i class="feather icon-book"></i> Subjects</span>
                                                                </a>
                                                                <a href="{{ url('admin/batches/edit/' . $data->batch_id) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="feather icon-edit-2"></i></a>
                                                                <a href="{{ url('admin/batches/delete/' . $data->batch_id) }}"
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
    <script>
        $(document).ready(function(){
            alert('load');
            $('#tbl-datatable').DataTable();
        });
        </script>
    @endsection
