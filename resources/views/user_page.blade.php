@extends('layouts.starter')

@section('title', 'MilanWeb24: Community - Pagina Utente' )

@section('style')
<link rel="stylesheet" href="{{ url('css/community.css') }}" />
@endsection

@section('script')
<script src="{{ url('js/community_user.js') }}" defer></script>
@endsection

@section('contents')

<h1>{{ $nome }} {{ $cognome }} - @ {{ $username }}</h1>

            <header id="navbar_user_logout">
                <div>
                    <!-- l'attributo dataset serve per generare la pagina dinamica dell'utente al click sullo username-->
                    <a id = "user_button" class="gold" data-id-user = "{{ $userid_logged }}">@ {{ $username_logged }}</a>
                    <a class="gold" href="{{ url('logout') }}">Logout</a>
                </div>
                <a id="button_new_post" href="{{ url('community/create_post') }}">Nuovo Post</a>
            </header>

            <section id="main" data-id-utente-pagina-attiva = "{{ $userid }}">
                <!-- qui dentro ci saranno i post prelevati dal database (al massimo i 100 post più recenti)-->     
            </section>
            <!-- form invisibile per la creazione della pagina dell'utente al click sullo username -->
            <form id="form_user_page" class="hidden">
                @csrf
            </form>

@endsection  