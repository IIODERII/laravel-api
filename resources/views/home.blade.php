@extends('layouts.app')
@section('content')
    <section class="container">
        @if (Auth::check())
            <h1 class="py-3">Benvenuto/a {{ Auth::user()->name }}, qui è possibile visualizzare, modificare o
                cancellare i progetti esistenti o
                crearne di nuovi</h1>
        @else
            <h1 class="py-3">Benvenuto/a, per utilizzare accedi o registrati</h1>
        @endif
        <a href="{{ route('admin.projects.index') }}" class="btn btn-success">Progetti</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-warning">Categorie</a>
    </section>
@endsection
