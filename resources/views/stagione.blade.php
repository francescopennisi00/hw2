@extends('layouts.starter')

@section('title', 'MilanWeb24: Stagione')

@section('style')
<link rel="stylesheet" href="{{ url('css/stagione.css') }}" />
@endsection

@section('script')
<script src="{{ url('js/stagione.js') }}" defer></script>
@endsection

@section('contents')
<section id="classifica">
                <h1>Classifica Serie A 2021-2022</h1>
                    <header>
                        <span>Squadra</span>
                        <span>
                            <a>PG</a>
                            <a>V</a>
                            <a>S</a>
                            <a>P</a>
                            <a>GF</a> 
                            <a>GS</a>
                            <a>DG</a>
                            <a>Pti</a>
                        </span>
                    </header>
            </section>
            <section id="calendario">
                <h1>Risultati Stagione 2021-2022</h1>
            </section>
@endsection