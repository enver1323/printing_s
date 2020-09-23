@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <a href="{{route('admin.users.create')}}" class="btn btn-primary mr-1">{{__('adminPanel.create')}}</a>
        </div>
        <div class="card-body">
            <form action="?" method="GET" class="form-inline">
                <div class="form-group mx-1 mb-1">
                    <label for="id" class="sr-only">{{__('adminPanel.id')}}</label>
                    <input type="number" class="form-control" id="id" name="id" placeholder="{{__('adminPanel.id')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="Name" class="sr-only">{{__('adminPanel.name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{__('adminPanel.name')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="email" class="sr-only">{{__('adminPanel.email')}}</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="{{__('adminPanel.email')}}">
                </div>
                <div class="mx-1 mb-1">
                    <label for="role" class="sr-only">{{__('adminPanel.role')}}</label>
                    <select class="custom-select" name="{{__('adminPanel.role')}}" id="role">
                        <option value="">{{__('frontend.all')}}</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mx-1 mb-1">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i> {{__('adminPanel.search')}}</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{__('adminPanel.id')}}</th>
                    <th scope="col">{{__('adminPanel.name')}}</th>
                    <th scope="col">{{__("adminPanel.name")}}</th>
                    <th scope="col">{{__('adminPanel.role')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as$user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>
                            <a href="{{route('admin.users.show',$user)}}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->isAdmin())
                                <span class="badge badge-success">{{$user->role}}</span>
                            @else
                                <span class="badge badge-info">{{$user->role}}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$users->links()}}
            <span class="align-self-center">views: {{$users->count()}}, total: {{$users->total()}}</span>
        </div>
    </div>

@endsection
