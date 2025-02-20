@extends('adminlte::page')

@section('title', 'Buat tag')
@section('content_header')
    <h1>{{ 'Berita' }}</h1>
@stop

@section('content')
@include('flash::message')
    {{ html()->form('POST', route('post.updates', $post->id))->acceptsFiles()->class('form-horizontal')->id('form-question')->open() }}
        <div class="row">
            <div class="form-group">
                {{ html()->label($post->slug) }}
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {{ html()->label('Image', 'file_id') }}
                <br>
                @if($post->image)
                    <img width="360" height="auto" src='{{ asset($post->image->original_name) }}' alt="{{ $post->title }}">
                @endif
                <input type="file" class="form-control @error('file_id') is-invalid @enderror" name="file_id">
                @if( $errors->has('file_id') )
                    <span class="text-danger tooltip-field"><span>{{ $errors->first('file_id') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {{ html()->label('Judul Berita', 'title') }}
                {{ html()->text('title', $post->title)->class('form-control') }}
                @if( $errors->has('title') )
                    <span class="text-danger tooltip-field"><span>{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {{ html()->label('Body', 'body') }}
                <x-adminlte-text-editor name="body" >
                    {{ $post->body }}
                </x-adminlte-text-editor>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group">
                <x-adminlte-select2 name="tag_id" label="Tag" label-class="text-black"
                    igroup-size="lg" data-placeholder="Select tag...">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-tag"></i>
                        </div>
                    </x-slot>
                    @foreach ($tags as $key => $tag)
                        <option value={{ $key }} @if($post->tag_id == $key) selected @endif>{{ $tag }}</option>
                    @endforeach
                </x-adminlte-select2>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {{ html()->label('Active', 'active') }}
                {{ html()->checkbox('active', $post->active)->class('form-control') }}
                @if( $errors->has('active') )
                    <span class="text-danger tooltip-field"><span>{{ $errors->first('active') }}</span>
                @endif
            </div>
        </div>
        {{ html()->submit('Submit') }}
    {{ html()->form()->close() }}

@stop
@section('plugins.summernote', true)