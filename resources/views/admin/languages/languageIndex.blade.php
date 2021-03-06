@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <a href="{{route('admin.languages.create')}}" class="btn btn-primary mr-1">{{__('adminPanel.create')}}</a>
        </div>

        <div class="card-body">
            <form action="{{route('admin.languages.index')}}" method="GET" class="form-inline">
                <div class="form-group mx-1 mb-1">
                    <label for="code" class="sr-only">{{__('adminPanel.code')}}</label>
                    <input type="text" maxlength="2" class="form-control" id="code" name="code" placeholder="{{__('adminPanel.code')}}"
                           value="{{request('code')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="name" class="sr-only">{{__('adminPanel.name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{__('adminPanel.name')}}"
                           value="{{request('name')}}">
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
                    <th scope="col">{{__('adminPanel.code')}}</th>
                    <th scope="col">{{__('adminPanel.name')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($languages as $language)
                    <tr>
                        <th scope="row">{{ $language->code }}</th>
                        <td>
                            <a href="{{route('admin.languages.show', $language)}}">{{ $language->name }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$languages->links()}}
            <span class="align-self-center">views: {{$languages->count()}}, total: {{$languages->total()}}</span>
        </div>
    </div>

@endsection
{{--@section('scripts')--}}
{{--    <script type="text/javascript" src="{{asset('js/admin/colorLanguage.js')}}"></script>--}}
{{--@endsection--}}
