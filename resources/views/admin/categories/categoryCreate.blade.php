@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
        @widget('translatable')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{__('adminPanel.save')}}</button>
        </div>
    </form>
@endsection
