@extends("auth.layout_auth.layoutAuth")

@section("body")

<body class="bg-light login-body">

<section class="login-container">
    <div class="container">
        <div class="login-quadrado">
            <div class="row">
                <div class="col-md-6 login-img">
                    <h3>Acesse a Plataforma para ter acesso</h3>
                    {{-- <img src="/storage/imagesAuth/Sia-Gradient.png" alt="login-logo" class="img-fluid"> --}}

                </div>
                <div class="col-md-6 col-2-login">
                    <div class="tot-col-2">
                        <div class="topo-login">
                            <div class="row">
                            <div class="col-2"><img src="/storage/imagesAuth/Sia-Gradient.png" alt="login-logo" class="img-fluid"></div>                            
                            <div class="col-6"><h3><strong>Sia</strong> eteot <i class="fas fa-user-circle"></i></h3></div>
                            </div>
                            
                            
                            <hr>
                        </div>
                        <div class="login-form">
                            <div class="login-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">

                                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                        @error('email')

                                        <span class="invalid-feedback text-center" role="alert">
                                                    <strong>E-mail ou senha invalidos.</strong>
                                                </span>

                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="@error('password') is-invalid @enderror" placeholder="Senha" name="password" required autocomplete="current-password">
                                    </div>
                                    <div class="senha-esq-login">

                                    @if (Route::has('password.request'))
                                     <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu sua senha?') }}
                                      </a>
                                     @endif

                                    </div>

                                    <div><input type="submit" value="Entrar"></div>
                                </form>

                            </div>

                        </div>
                        <hr>
                        
                        <div class="rodape-login">
                            <p>Caso não tenha login, Contate a direção para fazer seu cadastro na plataforma</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>

@endsection