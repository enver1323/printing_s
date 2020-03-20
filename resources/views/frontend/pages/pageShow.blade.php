@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-jobs-listing">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{$page->name}}
                </h1>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <div class="container">
        {!! $page->content !!}
    </div>
    @if(!$page->documents->isEmpty())
        <div class="container">
            <div class="list-group">
                @foreach($page->documents as $document)
                    <a href="{{$document->manual->getUrl()}}" class="list-group-item list-group-item-action">
                        {{$document->manual->getName()}}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endsection
