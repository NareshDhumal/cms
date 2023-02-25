@extends('backend.layouts.app')
@section('title', 'Profile')
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
                                    <a href="{{ route('admin.students') }}">Students</a>
                                </li>

                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 ">
                    <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group ms-lg-auto" role="group">
                            <div class="col col-sm-2 mx-2">
                            <a class="btn btn-outline-primary" href="{{ route('admin.students') }}">
                                <i class="feather icon-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                        <div class="col col-sm-2 mx-2" style='width:150px!important'>

                        {{-- check if course selected or not --}}
                        @php
                        $selected_year = null;
                            $student_session = Session('student_'.$student->student_id);
                            if(isset($student_session['year_id']) && $student_session['year_id'] !='' ){
                                $selected_year = $student_session['year_id'];
                            }
                        @endphp
                            {{Form::select('student_course',$student_course, $selected_year ,['id'=>'student_course' , 'class'=>'form-control'])}}
                        </div>

                        <div class="col col-sm-2 mx-2">
                            <a href="{{url('/')}}/admin/students/admissions/{{$student->student_id}}" class='btn btn-info '>
                            Admission</a>
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
                                        <div class="col-md-2 mx-1 pt-2 text-center">
                                            @if (isset($student->picture) && $student->picture != '')
                                                <img src="" class='rounded' alt="" height='120px'
                                                    width='100px' align='center'>
                                            @else
                                                <img src="{{ asset('public/backend_assets/images/user.jpg') }}"
                                                    class='rounded' alt="" height='110px' width='100px'
                                                    align='center'>
                                                    <span class="btn btn-sm btn-primary" align='bottom'>edit</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mx-1 ">
                                            <h3>{{ $student->student_name }}  <span class="btn btn-sm btn-primary" align='bottom'>edit</span></h3>

                                            <p class='m-0'> Roll No :
                                            @if(isset($student_session['roll_no']) && $student_session['roll_no'] !="")
                                                {{ $student_session['roll_no'] }}
                                                @else
                                                --
                                            @endif

                                            </p>

                                            <p class='m-0'> Date of Birth :
                                                @if (isset($student->date_of_birth) && $student->date_of_birth != '')
                                                    {{ $student->date_of_birth }}
                                                @endif
                                            </p>

                                            <p class='m-0'> Gendar :
                                                @if (isset($student->gendar) && $student->gendar != '')
                                                    {{ $student->gendar }}
                                                @endif
                                            </p>

                                            <p class='m-0'> Mobile No :
                                                @if (isset($student->mobile_no) && $student->mobile_no != '')
                                                    {{ $student->mobile_no }}
                                                @endif
                                            </p>

                                            <p class='m-0'> Parents Mobile No :
                                                @if (isset($student->parents_mobile_no) && $student->parents_mobile_no != '')
                                                    {{ $student->parents_mobile_no }}
                                                @endif
                                            </p>


                                        </div>

                                        <div class="col-md-3 px-3 text-right">
                                            <div class="col-sm-12 mx-1 mt-1 m2-1 float px-2 box_border">
                                                <h5>Total Fees : @if(isset($student_session['total_fees']))
                                                                {{$student_session['total_fees']}}
                                                @endif <h5>
                                            </div>

                                            <div class="col-sm-12 mx-1 mt-1 m2-1 float px-2 box_border">
                                                <h5>Paid Fees :  @if(isset($student_session['paid_fees']))
                                                                {{$student_session['paid_fees']}}
                                                @endif  <h5>
                                            </div>

                                            <div class="col-sm-12 mx-1 mt-1 mb-1 float px-2 box_border">
                                                <h5>Remain Fees : 100,00.00 <h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- row for details --}}

            <section class='mt-2'>
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="row  basic-datatable justify-content-center">

                                        <div class="col-sm-2 col-12 mx-1 mt-1 text-center px-2 box_border">
                                           <a href="{{url('/')}}/admin/students/admissions/{{$student->student_id}}">
                                               <h5>Admissions <h5>
                                            </a>
                                        </div>

                                        <div class="col-sm-2 col-12 mx-1 mt-1  text-center px-2 box_border">
                                            <h5>Attendance <h5>
                                        </div>

                                        <div class="col-sm-2 col-12 mx-1 mt-1 text-center px-2 box_border">
                                            <h5>Payment Details <h5>
                                        </div>

                                        <div class="col-sm-2 col-12 mx-1 mt-1 text-center px-2 box_border">
                                            <h5>Exam Records <h5>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <section>


            <section class='mt-2'>
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="row  basic-datatable">
                                        <h5 class='details_h1'>Details</h5>
                                    </div>

                                    <div class="row   basic-datatable details_box" >
                                        <h5 class='details'>
                                            <div class="row m-2 box_border_black">
                                                <h5> Student Details</h5>
                                                <hr>
                                                <p>
                                                  Name of student :
                                                </p>

                                                <p>
                                                    Mother Name :
                                                  </p>

                                                  <p>
                                                    Father Name :
                                                  </p>

                                                  <p>
                                                    email :
                                                  </p>

                                                  <p>
                                                    Mobile No :
                                                  </p>

                                                  <p>
                                                    Parents Mobile No :
                                                  </p>

                                                  <p>
                                                    Father Occumaption :
                                                  </p>

                                                  <p>
                                                    Mother Occumaption :
                                                  </p>

                                                  <p>
                                                    Annual Income :
                                                  </p>
                                            </div>

                                            <div class="row  m-2 box_border_black">
                                                <h5> Address Details</h5>
                                                <hr>
                                                <p>
                                                    {{$student->address}}
                                                </p>
                                            </div>

                                            <div class="row  m-2 box_border_black">
                                                <h5> Academic Details </h5>
                                                <hr>
                                                <p>
                                                    {{$student->address}}
                                                    print botton
                                                    transfer studet
                                                    365 report
                                                    remarks
                                                    documents
                                                </p>
                                            </div>

                                        </h5>
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

                $('.details_h1').click(function(){
                    $('.details_box').toggle();
                });

            });
        </script>
    @endsection
