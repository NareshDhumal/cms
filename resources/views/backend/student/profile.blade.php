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
                                        <img src="{{ asset('public/uploads/students/picture/'.$student->student_id.'/'.$student->picture) }}" class='rounded' alt="" height='120px' width='100px' align='center'>
                                        @else
                                        <img src="{{ asset('public/backend_assets/images/user.jpg') }}" class='rounded' alt="" height='110px' width='100px' align='center'>
                                        <a href="{{ route('admin.students.edit.photo',[$student->student_id])}}"> <span class="btn btn-sm btn-primary" align='bottom'>edit</span> </a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mx-1 ">
                                        <h3>{{ $student->student_name }} <a href="{{ route('admin.students.edit',[$student->student_id])}}"> <span class="btn btn-sm btn-primary" align='bottom'>edit</span></a></h3>

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
                                            <h5>Total Fees :
                                                @if(isset($student_session['fees']))
                                                {{$student_session['fees']}}
                                                @else
                                                --
                                                @endif
                                                <h5>
                                        </div>

                                        <div class="col-sm-12 mx-1 mt-1 m2-1 float px-2 box_border">
                                            <h5>Paid Fees : @if(isset($student_session['paid_fees']))
                                                {{$student_session['paid_fees']}}
                                                @endif <h5>
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

                                    <div class="col-sm-2 col-12 mx-1 mt-1 text-center px-2 box_border">
                                        <a href="{{url('/')}}/admin/students/fees/{{$student->student_id}}">
                                        <h5>Payments <h5>
                                        </a>
                                    </div>

                                    <div class="col-sm-2 col-12 mx-1 mt-1  text-center px-2 box_border">
                                        <h5>Attendance <h5>
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

                                        <div class="row basic-datatable details_box">
                                            <div class="col m-2 box_border_black no-gutters">
                                                <h5 class='std_details'> Student Details</h5>
                                                <hr>
                                                <div class="student_details_box">
                                                    <p>
                                                        Name of student :
                                                        @if(isset($student->student_name))
                                                        {{ $student->student_name }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        Mother Name :
                                                        @if(isset($student->mother_name))
                                                        {{ $student->mother_name }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        Father Name :
                                                        @if(isset($student->father_name))
                                                        {{ $student->father_name }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        email :
                                                        @if(isset($student->email))
                                                        {{ $student->email }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        Mobile No :
                                                        @if(isset($student->mobile_no))
                                                        {{ $student->mobile_no }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        Parents Mobile No :
                                                        @if(isset($student->parents_mobile_no))
                                                        {{ $student->parents_mobile_no }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        Father Occumaption :
                                                        @if(isset($student->father_occupation))
                                                        {{ $student->father_occupation }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        Mother Occumaption :
                                                        @if(isset($student->mother_occupation))
                                                        {{ $student->mother_occupation }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>

                                                    <p>
                                                        Annual Income :
                                                        @if(isset($student->income))
                                                        {{ $student->income }}
                                                        @else
                                                        --
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row basic-datatable details_box">
                                            <div class="col  m-2 box_border_black">
                                                <h5 class='address_details'> Address Details</h5>
                                                <hr>
                                                <div class="address_details_box">
                                                    <p>

                                                        {{$student->address}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row basic-datatable details_box">
                                            <div class="col  m-2 box_border_black">
                                                <h5> <span class="academic_details"> Academic Details </span> <a href="{{ route('admin.students.academics',[$student->student_id])}}"> <span class="btn btn-sm btn-primary" align='bottom'>edit</span> </a> </h5>
                                                <hr>
                                                <div class="academic_details_box">
                                                    <table class="table zero-configuration table-bordered" id="tbl-datatable" style="white-space: nowrap;">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr. No.</th>
                                                                <th>Exam Name</th>
                                                                <th>Board / Institute / University</th>
                                                                <th>Score</th>
                                                                <th>Year</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($student->academics) && count($student->academics) > 0)
                                                            @foreach ($student->academics as $academics)
                                                            <tr>
                                                                <td class='text-center'>{{$loop->index+1}}</td>
                                                                <td>{{ $academics->exam}}</td>
                                                                <td>{{ $academics->school_board}}</td>
                                                                <td>{{ $academics->score}}</td>
                                                                <td>{{ $academics->year}}</td>
                                                                <td>
                                                                    <a href="{{ route('admin.students.academics.delete',[$academics->student_acadmic_id]) }}" onclick="return confirm('Do you Want to delete This Entry?')">
                                                                        <span class="btn btn-danger">Delete</span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Documents --}}
                                        <div class="row basic-datatable document_details">
                                            <div class="col  m-2 box_border_black">
                                                <h5 class='student_documents'> Documents <a href="{{ route('admin.students.documents',[$student->student_id])}}"> <span class="btn btn-sm btn-primary" align='bottom'>edit</span> </a>   </h5>
                                                <hr>
                                                <div class="document_details_box">
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
                                                                @if (isset($student->documents) && count($student->documents) > 0)
                                                                    @php $srno = 1; @endphp
                                                                    @foreach ($student->documents as $data)
                                                                        <tr>
                                                                            <td class="text-center">{{ $srno }}</td>
                                                                            <td class="text-center">{{ $data->doc_name }}</td>
                                                                            <td class="text-center">{{ $data->doc_name }}</td>


                                                                            <td>
                                                                                <a href="{{asset('/public/uploads/students/documents/'.$data->student_id.'/'.$data->doc_file)}}" target='_new'> <span class="btn btn-info"> View</span> </a>

                                                                                <a href="{{ url('admin/students/documents/delete/' . $data->student_document_id) }}"
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

        //hide show details boxes
            //hide all boxes n page load
        $('.student_details_box').css('display', 'none');
        $('.address_details_box').css('display', 'none');
        $('.academic_details_box').css('display', 'none');
        $('.document_details_box').css('display', 'none');

        //show detail boxes on click event
            //toggle
        $('.std_details').click(function() {
            $('.student_details_box').toggle('slow');
        });

        $('.address_details').click(function() {
            $('.address_details_box').toggle('slow');
        });

        $('.academic_details').click(function() {
            $('.academic_details_box').toggle('slow');
        });

        $('.document_details').click(function() {
            $('.document_details_box').toggle('slow');
        });


    }); //end of Ready Function


</script>
@endsection
