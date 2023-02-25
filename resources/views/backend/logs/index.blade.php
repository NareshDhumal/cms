@extends('backend.layouts.app')
@section('title', 'user activity')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h4 class="content-header-title font-weight-bold"></h4>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">User Activity</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.school.create') }}">
                        <i class="feather icon-plus"></i> Add
                    </a>
                </div>
            </div>
        </div>
    </div>


    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="">
                        {{--  <div class="card-header">  --}}
                        {{--  <h4 class="card-title">School Master</h4>  --}}
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">

                                <table class="table zero-configuration w-100" id="tbl-datatable"
                                   >
                                    <thead>
                                        <tr>
                                            <th class='text-center'>Sr. No</th>
                                            <th class='text-center'>User Name</th>
                                            <th class='text-center'>Description</th>
                                            <th class='text-center'>Time</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (isset($users) && count($users) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($users as $useractivity)
                                                <tr>
                                                    <td class="text-center">{{ $srno }}</td>

                                                    <td>{{ $useractivity->user_name }}</td>

                                                    <td class="text-left">
                                                        @if (isset($useractivity->description))
                                                            {{ $useractivity->description }}
                                                        @else
                                                            --
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($useractivity->created_at))
                                                            {{ $useractivity->created_at }}
                                                        @else
                                                            --
                                                        @endif
                                                    </td>
                                                    {{-- <td class='p-0'>
                                                        <a href="{{ url('/logs/user/logdetails' . $useractivity->session_id) }}"
                                                            class="btn btn-primary">Activity</a>
                                                    </td> --}}
                                                    {{--
                                                    <td class='p-0'>
                                                        <a href="{{ url('' . $useractivity->user_id) }}"
                                                            class="btn btn-primary"><i class="feather icon-edit-2"></i></a>
                                                        <a href="{{ url('' . $useractivity->user_id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to Delete this Entry ?')"><i
                                                                class="feather icon-trash"></i></a>
                                                    </td> --}}

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

@endsection
@section('scripts')
    {{-- ** <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>  --}}

    {{-- ** <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  --}}
    {{-- ** <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  --}}
    {{--  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>  --}}
    {{-- ** <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>  --}}

    <script>
        $(document).ready(function() {
            //     $('#tbl-datatable').DataTable({
            //         dom: 'Bfrtip',
            //         scrollX: true,
            //         fixedHeader: true,
            //         buttons: [
            //         'print','excel',
            //     ],
            //
            //     filename:'report'
            //     });



            $('#tbl-datatable').DataTable({
                dom: 'Bfrtip',
                scrollX: true,
                fixedHeader: true,
                buttons: [{
                        text: '<i class="feather icon-printer"></i> Print',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },

                        title: function() {
                            var printTitle = 'User Activity';
                            return printTitle
                        },
                        className: 'btn btn-info text-white font-weight-bold pb-0 pt-0 px-1',
                    },

                    {
                        text: '<i class="feather icon-download-cloud"></i> Excel',
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },

                        title: function() {
                            var printTitle = 'User Activity';
                            return printTitle
                        },
                        className: 'btn btn-success text-white font-weight-bold pb-0 pt-0 px-1',
                    },

                ],


            });
        });
    </script>
@endsection
