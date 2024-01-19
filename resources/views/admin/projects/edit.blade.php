@extends('layouts.app')
@section('content')
    <section class="container">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-dark mt-3"><i class="fa-solid fa-left-long"></i></a>

        <h1 class="display-1 fs-bold py-3">Modifica {{ $project->title }}</h1>
        <form enctype="multipart/form-data" action="{{ route('admin.projects.update', $project->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="title">Titolo</label>
            <input value="{{ old('title', $project->title) }}" required type="text" id="title" name="title"
                class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="category_id">Select Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="description">Descrizione</label>
            <textarea rows="8" id="description" name="description"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-group container-fluid my-4">
                <h4>Seleziona le tecnologie utilizzate</h4>
                <div class="row g-3">
                    @foreach ($technologies as $key => $technology)
                        <div class="form-chech-input col-2">
                            <input id="technology{{ $key }}" type="checkbox" name="technologies[]"
                                value="{{ $technology->id }}"
                                {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                            <label class="form-chech-label" for="technology{{ $key }}">
                                <i style="cursor: pointer" class="fs-1 ms-2 fa-brands fa-{{ $technology->name }}"></i>

                            </label>
                        </div>
                    @endforeach
                    @error('technologies')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="my-3" style="width: 600px;">
                <img class="w-100" id="uploadPreview" src="{{ asset('storage/' . $project->image) }}" alt="Placeholder">
            </div>
            <label for="image">Immagine</label>
            <input value="{{ old('image', $project->image) }}" type="file" id="image" name="image"
                class="form-control @error('description') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="url">Url</label>
            <input value="{{ old('url', $project->url) }}" required type="url" id="url" name="url"
                class="form-control @error('description') is-invalid @enderror">
            @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Save</button>
            <input type="reset" class="btn btn-warning mt-3">
        </form>
    </section>
@endsection
