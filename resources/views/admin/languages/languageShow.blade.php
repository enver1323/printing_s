@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.languages.edit', $language) }}" class="btn btn-primary mr-1">
                    {{__('adminPanel.edit')}}
                </a>
                <form action="{{route('admin.languages.destroy', $language)}}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">{{__('adminPanel.delete')}}</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.code')}}: </strong>
                    <span>{{$language->code}}</span>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.name')}}: </strong>
                    <span>{{$language->name}}</span>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/admin/colorLanguage.js')}}"></script>
@endsection
