@extends('adminlte::page')

@section('title', 'Buat tag')
@section('content_header')
    <h1>{{ 'Tag' }}</h1>
@stop

@section('content')
@include('flash::message')
    {{ html()->form('POST', route('tag.updates', $tag->id))->class('form-horizontal')->id('form-question')->open() }}
        <div class="row">
            <div class="form-group">
                {{ html()->label('Tag', 'name') }}
                {{ html()->text('name', $tag->name)->class('form-control') }}
                @if( $errors->has('name') )
                    <span class="text-danger tooltip-field"><span>{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
        {{ html()->submit('Submit') }}
    {{ html()->form()->close() }}
 
@stop