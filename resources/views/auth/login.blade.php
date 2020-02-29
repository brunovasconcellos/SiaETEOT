@extends("auth.layout_auth.layoutAuth")
@section("body")
<body class="bg-light login-body">

<section class="login-container">
    <div class="container">
        <div class="login-quadrado">
            <div class="row">
                <div class="col-md-6 login-img">
                    <img src="/storage/imagesAuth/pequena-branca.png" alt="login-logo" class="img-fluid">
                    <hr>
                    <h3>Seja bem vindo ao Sia Eteot</h3>
                </div>
                <div class="col-md-6 col-2-login">
                    <div class="tot-col-2">
                        <div class="topo-login">
                            <h3>Faça login <i class="fas fa-user-circle"></i></h3>
                            <hr>
                        </div>
                        <div class="login-form">

                            <div class="login-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">

                                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                        @error('email')

                                        <span class="invalid-feedback" role="alert">
                                                    <strong>E-mail ou senha invalidos.</strong>
                                                </span>

                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="@error('password') is-invalid @enderror" placeholder="Senha" name="password" required autocomplete="current-password">
                                    </div>
                                    <div><input type="submit" value="Entrar"></div>
                                </form>

                            </div>

                        </div>
                        <hr>
                        <div class="senha-esq-login">

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu sua senha?') }}
                                </a>
                            @endif

                        </div>
                        <div class="rodape-login">
                            <hr>
                            <p>Caso não tenha login, Contate a direção para fazer seu cadastro na plataforma</p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
@endsection