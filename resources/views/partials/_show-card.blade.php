<article>
  <!-- Post header-->
  <header class="mb-4">
    <!-- Post title-->
   @if ($message = Session::get('success'))
    <x-alert>{{ $message }}</x-alert>
    @endif
    @error('content')
        <x-alert class="alert-danger">{{ $message }}</x-alert>
    @enderror
    <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
    <!-- Post meta content-->
    <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at }}</div>

    @can('delete', $post)
    <a class="badge bg-danger px-4 py-2 text-decoration-none link-light"
      href="{{ route('Blog-post.destroy', [$post->id]) }}" onclick="event.preventDefault();
            document.getElementById('destroy').submit();">Delete</a>

     <form id="destroy" action="{{ route('Blog-post.destroy', [$post->id]) }}" method="post" class="d-none">
        @csrf
        @method('DELETE')
      </form>
     
    @endcan
    @can('update', $post)
        <a class="badge bg-secondary px-4 py-2 text-decoration-none link-light" href="{{ route('Blog-post.edit', [$post->id]) }}">Update</a>
    @endcan
    
  </header>
  <!-- Preview image figure-->
  <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg"
      alt="..." /></figure>
  <!-- Post content-->
  <section class="mb-5">
    <p class="fs-5 mb-4">{{ $post->content }}</p>
  </section>
</article>

<!-- Comments section-->
<section class="mb-5">
  <div class="card bg-light">
    <div class="card-body">
      <!-- Comment form-->
      <form class="mb-4" action="{{ route('posts.comment', [$post->id]) }}" method="post">
        @csrf
        <textarea name="content" class="form-control mb-3" rows="3"
          placeholder="Join the discussion and leave a comment!"></textarea>
          <x-span-error>
            @error('content')
                {{ $message }}
            @enderror
          </x-span-error>
          <x-button>submit</x-button>
        </form>
      <!-- Single comment-->
   @forelse ($post->comments as $comment)
       <div class="d-flex mb-4">
            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                alt="..." />
            </div>
            <div class="ms-3">
              <div class="fw-bold">
                <a href="{{ route('users.show', [$comment->user->id]) }}">{{ $comment->user->name }}</a> {{ $comment->user->created_at }} </div>
              {{ $comment->content }}
            </div>
          </div>
   @empty
      <span>no comments .....</span>
   @endforelse
    </div>
  </div>
</section>