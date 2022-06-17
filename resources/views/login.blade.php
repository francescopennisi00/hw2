@extends('layouts.starter')

@section('title', 'MilanWeb24: Accedi alla Community')

@section('style')
<link rel="stylesheet" href="{{ url('css/signup_login.css') }}" />
@endsection

@section('contents')

<h1> Accedi alla community MilanWeb24</h1>

            <main>

                <div>
                    <img src="{{ url('images/coreografia.jpg') }}" />
                </div>

                <form method = "post" action = "{{ url('login') }}"> 
                    @csrf  
                    
                    @yield('errore') <!--conterrà gli eventuali messaggi di errore (immessi dalla view che estende questa) -->

                    <p>
                        <label>Username<input type="text" name="username"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Password<input type="password" name="password"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <!-- se al momento del submit il checkbox è cliccato il value viene trasmesso al server, altrimenti no-->
                        <label>Ricorda l'accesso<input type="checkbox" name="remember" value="ok"></label>
                    </p>

                    <p>
                        <label>&nbsp;<input type="submit" value="Accedi"></label>
                    </p>


                    <div id="link">
                        <!-- faccio spazio tra il punto interrogativo ed il link-->
                        <div>Non hai ancora un account? &nbsp; <a href="{{ url('signup') }}"> Registrati</a></div>
                    </div>

                </form>


            </main>

@endsection