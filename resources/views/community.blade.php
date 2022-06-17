@extends('layouts.starter')

@section('title', 'MilanWeb24: Community')

@section('style')
<link rel="stylesheet" href="{{ url('css/community.css') }}" />
@endsection

@section('script')
<script src="{{ url('js/community.js') }}" defer></script>
@endsection

@section('contents')

<h1>MILANWEB24: COMMUNITY</h1>

            <header id="navbar_user_logout">
                <div>
                    <!-- l'attributo dataset serve per generare la pagina dinamica dell'utente al click sullo username-->
                    <a id = "user_button" class="gold" data-id-user = "{{ $userid }}">@ {{ $username }}</a>
                    <a class="gold" href="{{ url('logout') }}">Logout</a>
                </div>
                <a id="button_new_post" href="{{ url('community/create_post') }}">Nuovo Post</a>
            </header>

            <section id="main">
                <!-- qui dentro ci saranno i post prelevati dal database (al massimo i 100 post più recenti)-->     
            </section>
            <!-- form invisibile per la creazione della pagina dell'utente al click sullo username -->
            <form id="form_user_page" class="hidden">
                @csrf
            </form>

@endsection             