@extends('backend.layouts.app')
@section('title', 'Teachers')
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Fees Collection</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Fee Collection</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{route('admin.fees.collection.create')}}">
                            <i class="feather icon-plus"></i> Accept Fees
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

                                                    <th class="text-center sorting_asc" >Name </th>
                                                    <th>Email ID</th>
                                                    <th>Mobile No</th>
                                                    <th>Picture</th>
                                                    <th>Status</th>
                                                    <th class="text-center sorting_asc">
                                                        Action
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($teachers) && count($teachers) > 0)
                                                    @php $srno = 1; @endphp
                                                    @foreach ($teachers as $data)
                                                        <tr>
                                                            <td class="text-center">{{ $srno }}</td>
                                                            <td>
                                                                @if (isset($data->full_name))
                                                                    {{ $data->full_name }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $data->mobile }}3</td>
                                                            <td>{{ $data->email }}</td>
                                                            <td>
                                                                <img src="{{asset('public/uploads/teachers/picture/'.$data->teacher_id.'/'.$data->picture)}}" style='height:60px; width:60px'>
                                                            <td>
                                                                @if (isset($data->status) && $data->status == 1)
                                                                    <span class='text-success'>Active</span>
                                                                @else
                                                                    <span class='text-secondary'>Not Active</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <a href="{{url('/')}}/admin/teachers/profile/{{$data->teacher_id}}"> <span class="btn btn-info"> Profile</span> </a>
                                                                {{-- <a href="{{ url('admin/batches/edit/' . $data->batch_id) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="feather icon-edit-2"></i></a> --}}
                                                                <a href="{{ url('admin/teachers/delete/' . $data->teacher_id) }}"
                                                                    class="btn btn-danger"
                                                                    onclick="return confirm('Are you you want to delete this teacher ? this entry mark as NOT ACTIVE')"><i
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
        $(document).ready(function() {

        });
        </script>
    @endsection
