@extends('layouts.app', ['activePage' => 'rol', 'titlePage' => __('Roles')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary justify-content-end">
            <h4 class="card-title sm">Roles</h4>
            <p class="card-category"> Lista de los usuarios existentes en el sistema</p>
            <form class="navbar-form ">
              <div class="input-group no-border">
              <input type="text" value="" class="form-control" placeholder="Search...">
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
              </button>
              </div>
            </form>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
            </thead>
            
            <tbody>
                @foreach ($role as $role)      
                    <tr >
                    <td>{{$role['id']}}</td>
                    <td>{{$role['name']}}</td>
                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                    <td>
                        <a href="/users/{{ $role['id'] }}"><i class="fa fa-eye"></i></a>
                        <a href="/users/{{ $role['id'] }}/edit"><i class="fa fa-edit"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$role['id']}}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <form method="POST" action="{{ route('role.store') }}" class="form-horizontal">
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Crear Rol') }}</h4>
                <p class="card-category">{{ __('Digite la Informacion Para Crear Un Nuevo Rol') }}</p>
              </div>
              <div class="card-body ">
              
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    
                      <input name="name" id="name" type="text" placeholder="{{ __('Name') }}"  required="true" aria-required="true"/>
                   
                
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Permiso') }}</label>
                   <div class="col-sm-7">  
                      @foreach($permission as $permission)
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="permission[]" multiple value="{{ $permission->name }}"> {{ $permission->name }}
                        <br>
                      @endforeach
                    </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
  </div>
  </div>
</div>
@endsection


