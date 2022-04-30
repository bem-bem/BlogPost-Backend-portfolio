@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {{-- card --}}
      <x-card>
        <div class="card-header">Update Blog post here</div>
        <div class="card-body">
          @if ($message = Session::get('success'))
          <x-alert>{{ $message }}</x-alert>
          @endif
          {{-- form --}}
          <form action="{{ route('Blog-post.update', [$post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('posts._form')
            <div class="mb-3">
              <x-button>submit</x-button>
            </div>
          </form>
          {{-- form --}}
        </div>
      </x-card>
      {{-- card --}}
    </div>
  </div>
</div>
@endsection