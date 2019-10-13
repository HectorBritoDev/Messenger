@extends('layouts.app')

@section('content')
{{-- <messenger-component :auth-user="{{ auth()->user()}}" /> --}}
<router-view :auth-user="{{ auth()->user()}}" />
@endsection
