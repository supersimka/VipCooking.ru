@extends('layouts.parent')

@section('searchForm')
    @include('details.smallSearchForm')
@endsection

@section('content')
    @include('details.noResults') 
@endsection
