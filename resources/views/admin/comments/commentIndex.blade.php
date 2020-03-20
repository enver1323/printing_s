@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="?" method="GET" class="form-inline">
                <div class="form-group mx-1 mb-1">
                    <label for="id" class="sr-only">{{__('adminPanel.id')}}</label>
                    <input type="number" class="form-control" id="id" name="id" placeholder="{{__('adminPanel.id')}}"
                           value="{{request('id')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="name" class="sr-only">{{__('adminPanel.name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{__('adminPanel.name')}}"
                           value="{{request('name')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="email" class="sr-only">{{__('adminPanel.email')}}</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="{{__('adminPanel.email')}}"
                           value="{{request('email')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="message" class="sr-only">{{__('adminPanel.description')}}</label>
                    <input type="text" class="form-control" id="message" name="message" placeholder="{{__('adminPanel.description')}}"
                           value="{{request('message')}}">
                </div>
                <div class="mx-1 mb-1">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i> {{__('adminPanel.search')}}
                    </button>
                </div>

            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('adminPanel.name')}}</th>
                    <th scope="col">{{__('adminPanel.email')}}</th>
                    <th scope="col">{{__('adminPanel.description')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as$comment)
                    <tr>
                        <th scope="row">{{ $comment->id }}</th>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>{{ $comment->message }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$comments->links()}}
            <span class="align-self-center">views: {{$comments->count()}}, total: {{$comments->total()}}</span>
        </div>
    </div>
@endsection
