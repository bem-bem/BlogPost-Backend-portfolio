<x-card class="mb-5">
  <img src="{{ asset('storage/' . $post->image->path) }}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{ $post->title }}</h5>
    <p class="card-text"> - {{ $post->user->name }} {{ $post->created_at }}</p>
    <p class="card-text"><span class="badge rounded-pill bg-primary px-4 py-2 fs-6">{{ $post->comments_count }}
        comments</span></p>
    <a href="{{ route('Blog-post.show' , [$post->id]) }}" class="btn btn-primary float-end">view</a>
  </div>
</x-card>