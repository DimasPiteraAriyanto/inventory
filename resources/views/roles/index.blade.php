@extends('dashboard.body.main')

@section('content')
    <!-- BEGIN: Header -->
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-solid fa-users"></i></div>
                            Add Roles
                        </h1>
                    </div>


                    <div class="col-auto my-4">
{{--                        <a href="{{ route('units.create') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus me-3"></i>Add</a>--}}
                        @can('create')
                            <a class="btn btn-primary add-list" href="{{ route('roles.create') }}"> Create New Role</a>
                        @endcan
                        <a href="{{ route('units.index') }}" class="btn btn-danger add-list"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                    </div>
                </div>

                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    <!-- END: Header -->

    <!-- BEGIN: Main Page Content -->
    <div class="container px-2 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mx-n4">
                    <div class="col-lg-12 card-header mt-n4">
                        <form action="{{ route('units.index') }}" method="GET">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="form-group row align-items-center">
                                    <label for="row" class="col-auto">Row:</label>
                                    <div class="col-auto">
                                        <select class="form-control" name="row">
                                            <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                            <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                            <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                            <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center justify-content-between">
                                    <label class="control-label col-sm-3" for="search">Search:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search unit" value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20 text-white"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">@sortablelink('name', 'Roles')</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                            @can('edit')
                                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                            @endcan
                                            @can('delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

{{--                    {{ $units->links() }}--}}

                    {!! $roles->render() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- END: Main Page Content -->


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


@endsection
