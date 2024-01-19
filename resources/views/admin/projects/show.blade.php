@extends('layouts.app')
@section('content')
    <section class="container">
        <div class="d-flex justify-content-between align-items-center"><a href="{{ route('admin.projects.index') }}"
                class="btn btn-dark mt-3"><i class="fa-solid fa-left-long"></i></a>
            <div>
                <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-warning mt-3">Modifica</a>
                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="d-inline"
                    id="delete-form-{{ $project->slug }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white btn btn-danger mt-3 cancel-button"
                        data-item-title="{{ $project->title }}" data-form-id="{{ $project->slug }}">Elimina</button>
                </form>
            </div>
        </div>

        <div><img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-100 my-3"></div>

        <h1 class="display-1 fs-bold pb-3">{{ $project->title }}</h1>

        <div class="row mb-5 ">
            <div class="pe-5 col-3">
                <a class="btn btn-primary" href="{{ $project->url }}" style="max-width: 200px">Scopri questo
                    progetto su GitHub</a>
                <h3 class="mt-4">Tecnologie utilizzate:</h3>
                <div class="container-fluid">
                    <ul class="list-unstyled row g-3">
                        @if (count($project->technologies) > 0)
                            @foreach ($project->technologies as $technology)
                                <li class="col-3"><a class="text-white"
                                        href="{{ route('admin.technologies.show', $technology->slug) }}"><i
                                            class="fa-brands fs-1 fa-{{ $technology->name }}"></i></a>
                                </li>
                            @endforeach
                        @else
                            <li>Nessuna</li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h4>Tipo di progetto:</h4>
                    <p>
                        @if ($project->category)
                            <a class="text-white"
                                href="{{ route('admin.categories.show', $project->category->slug) }}">{{ $project->category->name }}</a>
                        @else
                            Nessuna
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-9">

                <p>{{ $project->description }}</p>


            </div>
        </div>
    </section>

    @include('partials.modal_delete')
@endsection
