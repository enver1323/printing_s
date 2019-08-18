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
                </form>
                @if($user->isWait())
                    <form action="{{ route('admin.users.verify',$user) }}" method="POST"
                          class="mr-1">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">Verify</button>
                    </form>
                @endif
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
                    <strong>{{__('adminPanel.status')}}: </strong>
                    @if($user->isActive())
                        <span class="badge badge-primary">Active</span>
                    @endif
                    @if($user->isWait())
                        <span class="badge badge-secondary">Waiting</span>
                    @endif
                </div>
            </div>
            @isset($user->profile)
                @include('admin.profiles.profileShow', ['profile' => $user->profile])
            @endisset
        </div>
    </div>
@endsection
