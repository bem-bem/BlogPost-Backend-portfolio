@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          {{-- card --}}
          <div class="col-md-12">
            @include('partials._show-card')
          </div>
          {{-- card --}}
      </div>
    </div>
@endsection