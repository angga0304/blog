@extends('adminlte::page')

@section('title', 'List Jadwal')
@section('content_header')
    <h1>{{ 'List Tag' }}</h1>
@stop

@section('content')
    @include('flash::message')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            'Nama',
            ['label' => 'berita', 'no-export' => false, 'width' => 5],
            ['label' => 'Actions', 'no-export' => true, 'width' => 15],
        ];

        $config = [
            'data' => $tags,
            'order' => [[1, 'asc']],
            'columns' => [null, null, ['orderable' => false]],
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