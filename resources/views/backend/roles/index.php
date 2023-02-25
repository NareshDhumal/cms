@extends('backend.layouts.app')
@section('title', 'Roles')

@section('content')
<div class="content-header row container-fluid">
    <div class="content-header-left col-md-6 col-12">
      <h4 class="content-header-title font-weight-bold">Roles</h4>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Roles</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0">
      <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group ms-lg-auto" role="group">
          <a class="btn btn-outline-primary" href="{{ route('admin.roles.create') }}">
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
                            <table class="table zero-configuration table-bordered" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th class='text-center col-1'>Sr. No</th>
                                      <th class='text-center'>Name</th>
                                      <th class='text-center'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($roles) && count($roles)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($roles as $role)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $role->name }}</td>
                                      <td>
                                        <!-- @can('Update') -->
                                        <!-- @endcan -->
                                        <a href="{{ url('admin/roles/edit/'.$role->id) }}" class="btn btn-primary"><i class="feather icon-edit-2"></i></a>
                                        <!-- @can('Delete') -->
                                        <!-- @endcan -->
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/roles/delete', $role->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="feather icon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                        {!! Form::close() !!}
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
</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>

<script>
  $(document).ready(function()
  {

  });
</script>
@endsection
