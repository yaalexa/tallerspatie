@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Usuarios')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary justify-content-end">
            <h4 class="card-title sm">Usuarios</h4>
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
                <th>Email</th>
                <th>Role</th>
                <th>Tools</th>
            </tr>
            </thead>
            
            <tbody>
                @foreach ($users as $user)      
                                
                <tr >
                    <td>{{$user['id']}}</td>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>
                        @if ($user->roles->isNotEmpty())
                            @foreach ($user->roles as $role)
                                <span class="badge badge-secondary">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        @endif

                    </td>
                    
                    <td>
                      @can('profile.password')
                        <a href="/users/{{ $user['id'] }}"><i class="fa fa-eye"></i></a>
                      @endcan
                        <a href="/users/{{ $user['id'] }}/edit"><i class="fa fa-edit"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$user['id']}}"><i class="fas fa-trash-alt"></i></a>
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
          <form method="POST" action="{{ route('user.store') }}" class="form-horizontal">
            @csrf
 
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Crear Usuario') }}</h4>
                <p class="card-category">{{ __('Digite la Informacion del Usuario') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" placeholder="{{ __('Name') }}"  required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="email" placeholder="{{ __('Email') }}"  required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Rol') }}</label>
                   <div class="col-sm-7">  
                   <select class="form-control" name="role" id="role">
                   @foreach(Spatie\Permission\Models\Role::get() as $r)
                    <option selected value="{{ $r->name }}" > {{ $r->name }}</option>
                    @endforeach
                  </select>
                    </div>
                </div>

                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" type="password" placeholder="{{ __('password') }}"  required />
                      @if ($errors->has('password'))
                        <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                          <strong>{{ $errors->first('password') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Confimacion Password') }}</label>
                  <div class="col-sm-7">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password...') }}" required>
                  @if ($errors->has('password_confirmation'))
                  <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                   </div>
                 @endif
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
@endsection


