@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {{-- profile --}}
      <x-card>
        <div class="card-header">{{ __('User Profile') }}</div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <img src="{{ $user->image ? asset('storage/' . $user->image->path) : ''  }}" class="img-thumbnail"
                alt="...">
            </div>
            <div class="col-md-6">
              <div class="py-3">
                <h3 class="fw-bold text-capitalize">{{ $user->name }}</h3>
                <small class="text-muted mb-4">{{ $user->email }}</small>
              </div>
              <form action="{{ route('users.update', [$user->id]) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Avatar</label>
                  <input type="file" name="avatar" class="form-control" id="formGroupExampleInput">
                  <x-span-error>
                    @error('avatar')
                    {{ $message }}
                    @enderror
                  </x-span-error>
                </div>
                <x-button>Save Change's</x-button>
              </form>

            </div>
          </div>
        </div>
      </x-card>

    </div>
  </div>
</div>
@endsection