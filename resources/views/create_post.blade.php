@extends('layouts.starter')

@section('title', 'MilanWeb24 - Community: Crea post')

@section('style')
<link rel="stylesheet" href="{{ url('css/create_post.css') }}" />
@endsection

@section('script')
<script src="{{ url('js/create_post.js') }}" defer></script>
@endsection

@section('contents')

<main>

<header>
    <a href= "{{ url('login/auth') }}" >
         <img src = "{{ url('images/esci.png') }}" />
     </a>
    <h3> Crea un post </h3> 
    <button> Pubblica </button>
</header>

<section> <!-- questa sezione racchiude i dati dell'utente loggato (ottenuti tramite fetch) seguiti dalla textarea-->
     
     <div></div>
 
     <form id = "textarea" method="post">
         @csrf
     </form>
     <textarea form="textarea" name = "content" placeholder="A cosa stai pensando?"></textarea>

 </section>

</main>

@endsection       