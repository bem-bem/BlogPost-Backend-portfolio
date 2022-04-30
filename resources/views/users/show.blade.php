@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {{-- profile --}}
      <div class="card mb-4 shadow">
        <div class="card-header">{{ __('User Profile') }}</div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <img src="{{ $user->image ? asset('storage/' . $user->image->path) : ''  }}" class="img-thumbnail"
                alt="...">
            </div>
            <div class="col-md-6">
              <div class="p-5">
                <h3 class="fw-bold text-capitalize">{{ $user->name }}</h3>
                <small class="text-muted mb-4">{{ $user->email }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
@endsection