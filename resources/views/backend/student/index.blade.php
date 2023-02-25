@extends('backend.layouts.app')
@section('title', 'Students')
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Students</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Students</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.students.create') }}">
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

                                                    <th>Picture</th>
                                                    <th class="text-center sorting_asc" >Name </th>
                                                    <th>Mobile No</th>
                                                    <th>Status</th>
                                                    <th class="text-center sorting_asc">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($students) && count($students) > 0)
                                                    @php $srno = 1; @endphp
                                                    @foreach ($students as $data)
                                                        <tr>
                                                            <td class="text-center">{{ $srno }}</td>

                                                            <td>
                                                                @if ($data->picture)
                                                                <img src="{{asset('public/uploads/students/picture/'.$data->student_id.'/'.$data->picture)}}" style='height:60px; width:60px'>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if (isset($data->student_name))
                                                                    {{ $data->student_name }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $data->mobile_no }}
                                                                @if (isset($data->parents_mobile_no))
                                                                {{ $data->parents_mobile_no}}
                                                                @endif
                                                        </td>


                                                            <td class='text-center'>
                                                                @if (isset($data->status) && $data->status == 1)
                                                                    <span class='text-warning badge bg-secondary '>Active</span>
                                                                @else
                                                                    <span class='text-warning badge bg-secondary '>Not Active</span>
                                                                @endif
                                                            </td>
                                                            {{-- work ended at here  --}}
                                                            {{-- 11/02/2022 --}}
                                                                {{-- need to work from here  --}}
                                                            <td>
                                                                <a href="{{url('/')}}/admin/students/profile/{{$data->student_id}}"> <span class="btn btn-info"> Profile</span> </a>

                                                                @if (isset($data->status) && $data->status == 1)
                                                                <a href="{{ url('admin/students/delete/' . $data->student_id) }}"
                                                                    class="btn btn-danger"
                                                                    onclick="return confirm('Are you you want to delete this Student ? this entry mark as NOT ACTIVE')"><i
                                                                        class="feather icon-trash"></i></a>
                                                                @endif
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
