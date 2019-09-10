@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">
                    {{__('adminPanel.edit')}}
                </a>
                <form action="{{route('admin.users.destroy', $user)}}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">{{__('adminPanel.delete')}}</button>
                </form>.
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.id')}}: </strong>
                    <span>{{$user->id}}</span>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.name')}}: </strong>
                    <span>{{$user->name}}</span>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.email')}}: </strong>
                    <span>{{$user->email}}</span>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.role')}}: </strong>
                    @if($user->isAdmin())
                        <span class="badge badge-success">{{$user->role}}</span>
                    @else
                        <span class="badge badge-info">{{$user->role}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
