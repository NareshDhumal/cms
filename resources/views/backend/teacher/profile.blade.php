@extends('backend.layouts.app')
@section('title', 'Create Teacher')
@php
    use Spatie\Permission\Models\Role;
@endphp
@section('main-section')
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                    <h4 class="content-header-title font-weight-bold">Profile</h4>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.teachers') }}">Teachers</a>
                                </li>

                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                    <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group ms-lg-auto" role="group">
                            <a class="btn btn-outline-primary" href="{{ route('admin.teachers') }}">
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
                                    <div class="row">
                                        <div class="col-sm-12 col-12 mb-2 text-center teacher_menu_box">
                                            <a href="{{ url('/') }}/admin/teachers/edit/{{ $teacher->teacher_id }}"
                                                class='mx-2 menu_link'>
                                                <span>Edit Profile</span>
                                            </a>

                                            <a href="#" class='mx-2 menu_link' data-bs-toggle="modal"
                                                data-bs-target="#addressModal">
                                                <span>Address Details</span>
                                            </a>

                                            <a href="#" class='mx-2 menu_link' data-bs-toggle="modal"
                                                data-bs-target="#educationModal">
                                                <span>Education Details</span>
                                            </a>


                                            <a href="#" class='mx-2 menu_link'  data-bs-toggle="modal"
                                            data-bs-target="#pdfModal">
                                                <span>Resume</span>
                                            </a>

                                            <a href="#" class='mx-2 menu_link' data-bs-toggle="modal"
                                            data-bs-target='#picureModal'>
                                                <span>Picture</span>
                                            </a>

                                            <a href="{{url('/')}}/admin/teachers/documents/{{$teacher->teacher_id}}" class='mx-2 menu_link'>
                                                <span>Documents</span>
                                            </a>

                                            <a href="#" class='mx-2 menu_link'>
                                                <span>Lecture History</span>
                                            </a>

                                            <a href="#" class='mx-2 menu_link'>
                                                <span>Payment History</span>
                                            </a>
                                        </div>
                                        <hr>
                                        <div class="col-md-12 col-12">
                                            <h5 class='head_box'>Details</h5>
                                        </div>
                                        <div class="col-md-2 sm-12 col-12 bg-white mx-2 center">
                                            <center> <img
                                                    src="{{ asset('public/uploads/teachers/picture/' . $teacher->teacher_id . '/' . $teacher->picture) }}"
                                                    class='float-right img-fluid'
                                                    style='height:160px; width:160px; float:left; border-radius:20px; margin-top:20px; margin-bottom:auto'>
                                            </center>
                                        </div>
                                        <div class="col-sm-5 col-12 px-2 bg-white box_container">
                                            <h6 class='font-weight-bold text-center'>{{ ucwords($teacher->full_name) }}</h6>
                                            <hr>
                                            <p class='disp_text'>Email ID : {{ $teacher->email }} </p>
                                            <p class='disp_text'>Mobile No : {{ $teacher->mobile }} </p>
                                            <p class='disp_text'>Birth Date : {{ date('d/m/Y', strtotime($teacher->dob)) }}
                                            </p>
                                            <p class='disp_text'>Gender : {{ $teacher->gender }} </p>
                                            <p class='disp_text'>Joined On :
                                                {{ date('d/m/Y', strtotime($teacher->created_at)) }} </p>
                                            <hr>
                                        </div>
                                        <div class="col-sm-4 p-4 col-12 ">
                                            <div class="row">
                                                <div class=" m-2 box_border">
                                                    Current Outstanding <br>
                                                    7000
                                                </div>
                                                <div class=" m-2 box_border">
                                                    Today's Lecture <br>
                                                    5 Hr
                                                </div>

                                                <div class=" m-2 box_border">
                                                    Last Payment <br>
                                                    Date : 20/01/2023
                                                    6000.Rs
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- Modals --}}
                <!-- Modal -->
                <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Address Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if (isset($teacher->address))
                                    <span>{{ $teacher->address }}</span>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- education details modal --}}
                <div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Education details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if (isset($teacher->edu_details))
                                    <p>Highest Education:-</p>
                                    <span>{{ $teacher->edu_details }}</span>
                                @endif
                                <hr>
                                <table class='table'>
                                    <tr>
                                        <th>Sr. no.</th>
                                        <th>Name</th>
                                        <th>Institute</th>
                                        <th>Year</th>
                                        <th>Remark</th>
                                    </tr>
                                    @if (isset($teacher->education))
                                        @foreach ($teacher->education as $education)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $education->course }}</td>
                                                <td>{{ $education->institute }}</td>
                                                <td>{{ $education->year }}</td>
                                                <td>{{ $education->remark }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Resume modal --}}
                <!-- Modal -->
                <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">View Resume</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if (isset($teacher->resume))
                                <iframe src="{{asset('/public/uploads/teachers/resume/'.$teacher->teacher_id.'/'.$teacher->resume)}}#toolbar=0" width=100% height=100%></iframe>
                                @endif
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Picture modal --}}
                <!-- Modal -->
                <div class="modal fade" id="picureModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">View Picture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if (isset($teacher->picture))
                                <img src="{{asset('/public/uploads/teachers/picture/'.$teacher->teacher_id.'/'.$teacher->picture)}}" height='100%' width='100%' class='image image-responsive'>
                                @endif
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
