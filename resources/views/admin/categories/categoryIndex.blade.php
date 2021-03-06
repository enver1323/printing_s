@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <a href="{{route('admin.categories.create')}}" class="btn btn-primary mr-1">{{__('adminPanel.create')}}</a>
        </div>
        <div class="card-body">
            <form action="{{route('admin.categories.index')}}" method="GET" class="form-inline">
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
                <div class="mx-1 mb-1">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i> {{__('adminPanel.search')}}
                    </button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{__('adminPanel.id')}}</th>
                    <th scope="col">{{__('adminPanel.name')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $index => $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <a href="{{route('admin.categories.show', $category)}}">{{ str_repeat('~', $category->depth).$category->name }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$categories->links()}}
            <span class="align-self-center">views: {{$categories->count()}}, total: {{$categories->total()}}</span>
        </div>
    </div>
@endsection
