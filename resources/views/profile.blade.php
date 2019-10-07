@extends('layouts.app')

@section('content')
<profile-form-component :user="{{ auth()->user()}}"></profile-form-component>
@endsection
