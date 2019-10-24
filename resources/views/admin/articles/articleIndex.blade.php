@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <a href="{{route('admin.articles.create')}}" class="btn btn-primary mr-1">{{__('adminPanel.create')}}</a>
        </div>
        <div class="card-body">
            <form action="{{route('admin.articles.index')}}" method="GET" class="form-inline">
                <div class="form-group mx-1 mb-1">
                    <label for="id" class="sr-only">{{__('adminPanel.id')}}</label>
                    <input type="number" class="form-control" id="id" name="id" placeholder="{{__('adminPanel.id')}}"
                           value="{{request('id')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="name" class="sr-only">{{__('adminPanel.name')}}</label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="{{__('adminPanel.name')}}" value="{{request('name')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="name" class="sr-only">{{__('adminPanel.description')}}</label>
                    <input type="text" class="form-control" id="description" name="description"
                           placeholder="{{__('adminPanel.description')}}" value="{{request('description')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label class="col-form-label" for="author">{{__('adminPanel.author')}}</label>
                    <select name="author" id="author" class="form-control">
                        <option value="">{{__('adminPanel.choose')}}</option>
                    </select>
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
                    <th scope="col">{{__('adminPanel.photo')}}</th>
                    <th scope="col">{{__('adminPanel.name')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <th scope="row">{{ $article->id }}</th>
                        <td width="10%">
                            <a href="{{route('admin.articles.show', $article)}}">
                                <img src="{{$article->photo->getUrl()}}" alt="{{$article->name}}" class="w-100">
                            </a>
                        </td>
                        <td>
                            <a href="{{route('admin.articles.show', $article)}}">{{ $article->name }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$articles->links()}}
            <span class="align-self-center">views: {{$articles->count()}}, total: {{$articles->total()}}</span>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/apiSelect.js', 'build')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#author", "{{route('ajax.users')}}");
        });
    </script>
@endpush
