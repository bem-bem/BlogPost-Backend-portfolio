<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" name="title" value="{{ old('title' , optional($post ?? null)->title) }}" class="form-control" id="exampleFormControlInput1" placeholder="Blog posts Title">
  <x-span-error>
    @error('title')
      {{ $message }}
    @enderror
  </x-span-error>
</div>

<div class="mb-3">
  <label for="exampleFormControlInput2" class="form-label">Image</label>
  <input type="file" name="postImages" class="form-control" id="exampleFormControlInput2">
  <x-span-error>
      @error('postImages')
      {{ $message }}
      @enderror
    </x-span-error>
</div>

<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Content</label>
  <textarea class="form-control" name="content" id="exampleFormControlTextarea1" placeholder="Blog post Content"
    rows="3">{{ old('content' , optional($post ?? null)->content) }}</textarea>
   <x-span-error>
      @error('content')
      {{ $message }}
      @enderror
    </x-span-error>
</div>

