@extends('auth.layout_auth.layoutAuth')

@section('body')
<body class="bg-esqueceu_senha">

    <section class="esqueceu_senha">
        <div class="esqueceu_senha">
            <div class="">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-1-esqueceu">
                        <div class="col-1-esqueceu-div">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-2-esqueceu">
                        <div class="col-2-esqueceu-div">
                            <div class="titulo-col-2-esqueceu-div"><h3>Recuperar senha</h3><hr></div>
                            <form method="POST" action="{{route("password.email")}}">
                                @csrf
                                <h3>Digite seu email</h3>
                                <hr>
                                <input id="email" type="email" class="esqueceu-email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email" autofocus>

                                @error('email')

                                <span class="invalid-feedback" role="alert">
                                <strong>Não encontramos este endereço de e-mail.</strong>
                            </span>

                                @enderror

                                <button type="submit">Recuperar</button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a href="{{route("login")}}">Voltar para o login</a>
                            </div>
                            <div class="baixo-esqueceu">
                                <p>Será enviado um email para o email registrado em sua conta, Acesse-o para que seja
                                    feita a alteração.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
@endsection
