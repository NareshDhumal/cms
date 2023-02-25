@extends('backend.layouts.app')
@section('main-section')
@php

use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use Spatie\Permission\Models\Permission;


$user_id = Auth()->guard('admin')->user()->id;

$backend_menubar = BackendMenubar::Where(['visibility'=>1])->orderBy('sort_order')->get();
@endphp
    <div id="layoutSidenav_content">
        <main class='m-2 p-2'>
            <div class="content-header row container-fluid">
                <div class="content-header-left col-md-6 col-12">
                  <h4 class="content-header-title font-weight-bold">Roles</h4>
                  <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                              <a href="{{ route('admin.dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Create Roles</li>
                          </ol>
                    </div>
                  </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0">
                  <div class="btn-group d-flex mb-3" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group ms-lg-auto" role="group">
                        <a class="btn btn-outline-primary" href="{{ route('admin.roles') }}">
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
                              <div class="card-body">
                                @include('backend.includes.errors')
                                <form method="POST" action="{{ route('admin.roles.store') }}" class="form">
                                  {{ csrf_field() }}
                                  <div class="form-body">
                                    <div class="row">
                                      <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                          {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Role Name', 'required' => true]) }}
                                          {{ Form::label('name', 'Role Name *') }}
                                        </div>
                                      </div>
                                      @php

                                      //dd($has_permissions);
                                        foreach($backend_menubar as $menu)
                                        {

                                      @endphp
                                          <div class="col-md-12 col-12">
                                      @php
                                          if($menu->has_submenu == 1)
                                          {
                                            //$backend_menu_permission = explode(',',$role->menu_ids);
                                            //$backend_submenu_permission = explode(',',$role->submenu_ids);
                                            $backend_submenubar = BackendSubMenubar::Where(['menu_id'=>$menu->menu_id])->get();
                                            if($backend_submenubar)
                                            {
                                      @endphp
                                              <!-- <h4 class="card-title">{{$menu->menu_name}}</h4> -->
                                              <h4 class="card-title">
                                                <div class="checkbox checkbox-primary">
                                                  {{ Form::checkbox('menu_id[]', $menu->menu_id, null, ['id'=>'menu['.$menu->menu_id.']']) }}
                                                  {{ Form::label('menu['.$menu->menu_id.']', $menu->menu_name) }}
                                                </div>
                                              </h4>
                                      @php
                                                foreach($backend_submenubar as $submenu)
                                                {
                                      @endphp
                                                  <div class="col-md-6 col-12">
                                                    <!-- <h5 class="">{{ $submenu->submenu_name }}</h5> -->
                                                    <h3 class="card-title">
                                                      <div class="checkbox checkbox-primary">
                                                        {{ Form::checkbox('submenu_id[]', $submenu->submenu_id, null, ['id'=>'submenu['.$menu->menu_id.']['.$submenu->submenu_id.']']) }}
                                                        {{ Form::label('submenu['.$menu->menu_id.']['.$submenu->submenu_id.']', $submenu->submenu_name) }}
                                                      </div>
                                                    </h3>
                                                    <div class="col-md-12 col-12 mt-2 menu_permissions">
                                                      <ul class="list-unstyled mb-0">
                                                        @php
                                                          $backend_permission = explode(',',$submenu->submenu_permissions);
                                                          $permissions = Permission::where('menu_id',$menu->menu_id)->where('submenu_id',$submenu->submenu_id)->get();
                                                          $permissions = collect($permissions)->mapWithKeys(function ($item, $key) {
                                                              return [$item['base_permission_id'] => ['id'=>$item['id'],'name'=>$item['name']]];
                                                            });
                                                         // dd($permissions);


                                                        @endphp

                                                        @foreach($backend_permission as $permission)
                                                        @if($permission)
                                                        <!-- @if(!isset($permissions[$permission]))

                                                       @endif -->

                                                        <li class="d-inline-block mr-2 mb-1">
                                                          <fieldset>
                                                            <div class="checkbox checkbox-primary">

                                                              {{--  {{ Form::checkbox('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['id'], null, ['id'=>'permissions['.$permissions[$permission]['id'].']']) }}
                                                              {{ Form::label('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['name']) }}  --}}
                                                            </div>
                                                          </fieldset>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                      </ul>
                                                    </div>
                                                  </div>


                                      @php

                                                }
                                            }
                                          }
                                          else
                                          {
                                            //$backend_menu_permission = explode(',',$role->menu_ids);
                                      @endphp

                                            <h4 class="card-title">
                                              <div class="checkbox checkbox-primary">
                                                {{ Form::checkbox('menu_id[]', $menu->menu_id, null, ['id'=>'menu['.$menu->menu_id.']']) }}
                                                {{ Form::label('menu['.$menu->menu_id.']', $menu->menu_name) }}
                                              </div>
                                            </h4>

                                            <div class="col-md-6 col-12 mt-2 menu_permissions">
                                              <ul class="list-unstyled mb-0">
                                                @php
                                                  $backend_permission = explode(',',$menu->permissions);
                                                  $permissions = Permission::where('menu_id',$menu->menu_id)->get();
                                                  $permissions = collect($permissions)->mapWithKeys(function ($item, $key) {
                                                      return [$item['base_permission_id'] => ['id'=>$item['id'],'name'=>$item['name']]];
                                                    });
                                                  //dd($permissions);
                                                @endphp

                                                @foreach($backend_permission as $permission)

                                                @if(isset($permissions[$permission]))
                                                <li class="d-inline-block mr-2 mb-1">
                                                  <fieldset>
                                                    <div class="checkbox checkbox-primary">
                                                      {{ Form::checkbox('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['id'], null, ['id'=>'permissions['.$permissions[$permission]['id'].']']) }}
                                                      {{ Form::label('permissions['.$permissions[$permission]['id'].']', $permissions[$permission]['name']) }}
                                                    </div>
                                                  </fieldset>
                                                </li>
                                                @endif
                                                @endforeach

                                              </ul>
                                            </div>
                                      @php
                                          }
                                      @endphp

                                            </div>
                                      @php
                                        }
                                      @endphp

                                      <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-secondary mr-1 mb-1 mx-2">Reset</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
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
