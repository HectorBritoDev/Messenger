@extends('layouts.app')

@section('content')
<b-container>
    <b-row align-h="center">
        <b-col cols="8">
            <b-card title="Registro de usuario">

                @if ($errors->any())
                <b-alert show variant="danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </b-alert>
                @else
                <b-alert show> Por favor ingresa tus datos</b-alert>
                @endif

                <b-form method="POST" action="{{ route('register') }}">
                    @csrf
                    <b-form-group label="Nombre" label-for="name">
                        <b-form-input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus />
                    </b-form-group>

                    <b-form-group label="Correo Electrónico" label-for="email"
                        description="Nunca compartas tu correo. Está seguro con nosotros">
                        <b-form-input type="email" id="email" name="email" placeholder="example@example.com"
                            value="{{ old('email') }}" required />
                    </b-form-group>
                    <b-form-group label="Contraseña" label-for="password">
                        <b-form-input type="password" id="password" name="password" required />
                    </b-form-group>
                    <b-form-group label="Confirme la contraseña" label-for="password_confirmation">
                        <b-form-input type="password" id="password_confirmation" name="password_confirmation"
                            required />
                    </b-form-group>

                    <b-button type="submit" variant="primary">
                        Registrarme
                    </b-button>
                    <b-button href="{{ route('login') }}" variant="link">
                        ¿Ya tienes una cuenta?
                    </b-button>
                </b-form>
            </b-card>
        </b-col>
    </b-row>
</b-container>
@endsection
