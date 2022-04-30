@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row mb-4">
    @if ($message = Session::get('success'))
      <x-alert>{{ $message }}</x-alert>
      @endif
      <div class="col-md-6 mb-3">
        <a href="{{ route('Blog-post.create') }}" class="btn btn-success">Create</a>
      </div>
      <div class="col-md-6">
        <form action="{{ route('search.index') }}" method="get" class="d-flex">
          <input type="search" name="searchTitle" class="form-control me-3" id="exampleFormControlInput1" placeholder="search title ...">
          <x-button>search</x-button>
        </form>
       <x-span-error>
         @error('searchTitle')
             {{ $message }}
         @enderror
       </x-span-error>
      </div>
    </div>

  <div class="row">
      @forelse ($posts as $post)
      <div class="col-md-4">
          @include('partials._index-card')
      </div>
      @empty
        <h1>no data</h1>
      @endforelse
  </div>
  {{-- pagination --}}
  <div class="row ">
      <div class="col-md-12">
        {{ $posts->links() }}
      </div>
  </div>
</div>
@endsection