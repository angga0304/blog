@extends('adminlte::page')

@section('title', 'List Jadwal')
@section('content_header')
    <h1>{{ 'List Post' }}</h1>
@stop

@section('content')
    @include('flash::message')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            'Judul',
            'Penulis',
            'Status',
            ['label' => 'Published', 'no-export' => false, 'width' => 15],
            ['label' => 'Actions', 'no-export' => true, 'width' => 15],
        ];

        $config = [
            'data' => $posts,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];
    @endphp

    <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config"
        striped hoverable with-buttons/>
@stop

@section('plugins.DatatablesPlugin', true)
@section('js')
<script>
    function ConfirmDelete()
    {
      return confirm("Are you sure you want to delete?");
    }
</script> 
@stop