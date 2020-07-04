@extends('layouts.app')

@section('application-module-name')
    <div class="text-white mb-0 ">
        Zmiana hasła
    </div>
@endsection

@section('content')
<div class="ml-3">
    <div class="h3 mb-4 text-info">Zmiana hasła</div>

    @if($errors->any())
        <div class="alert pt-4 alert-danger text-center col-4" role="alert">
            <p class="font-weight-bold">{{ implode('', $errors->all(':message')) }}</p>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success text-center col-4 pt-4">
            <p class="font-weight-bold">{{ session('success') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.change') }}">
        @csrf

        <div class="form-group">
            <label class="mb-1 h5 text-white" for="current-password">Aktualne hasło</label>
            <p class="text-small">
                Aby zmienić swoje hasło, nazwę użytkownika lub adres e-mail, musisz podać swoje aktualne hasło.
            </p>
            <input id="current-password" type="password" 
                        class="col-4 bg-dark text-white-50 form-control py-4 @error('current-password') is-invalid @enderror" 
                        name="current-password"
                        required autofocus 
                        placeholder="Podaj aktualne hasło">
        </div>

        <div class="form-group">
            <label class="mb-1 h5 text-white" for="new-password">Nowe hasło</label>
            <p class="text-small">
                Postaraj się by hasło miało długość od 6 do 30 znaków i składało się z liter różnej wielkości i cyfr.
            </p>
            <input id="new-password" type="password" 
                        class="col-4 bg-dark text-white-50 form-control py-4 @error('new-passsword') is-invalid @enderror" 
                        name="new-password"
                        required autocomplete="new-password" 
                        placeholder="Podaj nowe hasło">
        </div>

        <div class="form-group">
            <label class="mb-1 h5 text-white" for="new-password-confirm">Potwierdź hasło</label>
            <p class="text-small">
                W przypadku, gdy w polu powyżej zostało podane nowe hasło, należy je tutaj potwierdzić, podając je w takiej samej postaci, jak powyżej.
            </p>
            <input id="new-password-confirm" type="password" 
                        class="col-4 bg-dark text-white-50 form-control py-4" 
                        name="new-password-confirm"
                        required
                        placeholder="Potwierdź nowe hasło">
        </div>

        <button type="submit" class="mt-4 col-4 auth-btn btn-primary btn-block">
            Zapisz zmiany
        </button>
    </form>
</div>
@endsection