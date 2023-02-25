@extends('backend.layouts.app')
@section('title', 'Category')

@section('content')
{{-- <div class="content-page-data"> --}}
<div class="container-fluid">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12">
            <h4 class="content-header-title font-weight-bold">Category Master</h4>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Category Master</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group ms-lg-auto" role="group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.category.create') }}">
                        <i class="feather icon-plus"></i> Add
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    <section id="basic-datatable">
        <div class="container-fluid">
            <div class="row">
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
                                                        style=" overflow: hidden; text-color:white">Category</div>
                                                </th>

                                                <th class="text-center sorting_asc">
                                                    Slug
                                                </th>

                                                <th class="text-center sorting_asc">
                                                    Status
                                                </th>

                                                <th class="text-center sorting_asc">
                                                    Action
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($categories) && count($categories) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($categories as $data)
                                                    <tr>
                                                        <td class="text-center">{{ $srno }}</td>
                                                        <td>{{ $data->category_name }}</td>
                                                        <td>{{ $data->category_slug }}</td>
                                                        <td>
                            @if ($data->visibility == 1)
                                    <span class="badge badge-primary">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>

                                                        <td>
                                                            @if ($data->sub_category)
                                                                &nbsp; &nbsp; <a
                                                                    href="{{ url('admin/subcategory/' . $data->category_id) }}"
                                                                    class="btn btn-primary">Subcategory</a>
                                                            @endif

                                                            <a href="{{ url('admin/category/edit/' . $data->category_id) }}"
                                                                class="btn btn-primary"><i class="feather icon-edit-2"></i></a>
                                                            <a href="{{ url('admin/category/delete/' . $data->category_id) }}"
                                                                class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to Delete this Entry ?')"><i
                                                                    class="feather icon-trash"></i></a>

                                                            {{--  <!-- @can('Delete') -->
                            <!-- @endcan -->
                            {!! Form::open([
                            'method'=>'GET',
                            'url' => ['admin/category/delete',$data->category_id],
                            ]) !!}
                            {!! Form::button('<i class="feather icon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                            {!! Form::close() !!}  --}}
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
        </div>
    </section>
{{-- </div> --}}
@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            $('#tbl-datatable').DataTable({
                dom: 'Bfrtip',
                scrollX: true,
                fixedHeader: true,
                buttons: [{
                        text: '<i class="feather icon-printer"></i> Print',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        title: function() {
                            var printTitle = 'Category Master';
                            return printTitle
                        },
                        className: 'btn btn-info pb-0 pt-0 px-1 text-white font-weight-bold',
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '0.7em').css('font-family', 'calibri');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                            $(win.document.body).find('table tr th').css('text-align', 'center');

                            $(win.document.body).find(
                                'table tr th:nth-child(1)'
                            ).css('text-align', 'center').css('width', '10px');
                            $(win.document.body).find(
                                'table tr td:nth-child(1)'
                            ).css('text-align', 'center').css('width', '10px');



                        }
                    },
                    {
                        text: '<i class="feather icon-download-cloud"></i> Excel',
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        title: function() {
                            var printTitle = 'Category Master';
                            return printTitle
                        },
                        className: 'btn btn-success text-white font-weight-bold pb-0 pt-0 px-1',
                    },
                ],
            });
        });
    </script>
@endsection
