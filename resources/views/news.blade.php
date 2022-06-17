@extends('layouts.starter')

@section('title', 'MilanWeb24')  <!-- questo titolo verrà poi modificato lato client (grazie ai dati prelevati dal json) -->

@section('style')
<link rel="stylesheet" href="{{ url('css/news.css') }}" />
@endsection

@section('script')
<script src="{{ url('js/news.js') }}" defer></script>
@endsection

@section('contents')
<!-- qui troviamo la sezione principale della pagina -->
<section id = "main" data-id-notizia = "{{ $id_notizia }}" >
</section>
@endsection  