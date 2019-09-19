@extends('layouts.app')

@section('content')
<b-container>
    <b-row align-h="center">
        <b-col cols="8">
            <b-card title="Inicio de sesión">
                <b-alert show> Por favor ingresa tus datos</b-alert>
                <b-form method="POST" action="{{ route('login') }}">
                    @csrf
                    <b-form-group label="Correo Electrónico" label-for="email"
                        description="Nunca compartas tu correo. Está seguro con nosotros">
                        <b-form-input type="email" id="email" name="email" placeholder="example@example.com"
                            value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required
                            autofocus />
                    </b-form-group>
                    <b-form-group label="Contraseña" label-for="password">
                        <b-form-input type="password" id="password" name="password" value="{{ old('password') }}"
                            class="@error('password') is-invalid @enderror" required />
                    </b-form-group>
                    <b-form-group>
                        <b-form-checkbox name="remember" id="remember" {{ old('remember') ? 'checked="true"' : '' }}>
                            Mantener sesión
                        </b-form-checkbox>
                    </b-form-group>
                    <b-button type="submit" variant="primary">
                        Ingresar
                    </b-button>
                    <b-button href="{{ route('password.request') }}" variant="link">
                        ¿Olvidaste tu contraseña?
                    </b-button>
                </b-form>
            </b-card>
        </b-col>
    </b-row>
</b-container>
@endsection
