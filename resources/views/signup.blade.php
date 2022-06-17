@extends('layouts.starter')

@section('title', 'MilanWeb24: Iscriviti alla Community')

@section('style')
<link rel="stylesheet" href="{{ url('css/signup_login.css') }}" />
@endsection

@section('script')
<script src="{{ url('js/signup.js') }}" defer></script>
@endsection

@section('contents')

<h1> Registrati alla community MilanWeb24</h1>

            <main>

                <div>
                   <img src=" {{ url('images/coreografia.jpg') }}" />
                </div>

                <form method = "post" action = " {{ url('register') }}" >   <!--spedisco i dati al SignUpController, che li valida opportunamente-->
                    @csrf <!-- per evitare attacchi cross-site request forgery -->

                    <p>
                        <label>Nome<input type="text" name="nome"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Cognome<input type="text" name="cognome"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Email<input type="text" name="email"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Username<input type="text" name="username"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Password<input type="password" name="password"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Conferma password<input type="password" name="conferma_password"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Acconsento al trattamento dei dati personali<input type="checkbox" name="allow" value="confermed"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>&nbsp;<input type="submit" value="Registrati"></label>
                    </p>

                    <div id="link">
                        <!-- faccio spazio tra il punto interrogativo ed il link-->   <!--SISTEMARE IL LINK-->
                        <div>Hai già un account? &nbsp; <a href="{{ url('login') }}"> Accedi</a></div>
                    </div>            

                </form>

            </main>

@endsection