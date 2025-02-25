<x-layout>
    <x-content>
        <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/homepage">Homepage</a></li>
              <li><a href="/posts">Posts</a></li>
              <li>Update</li>
            </ul>
          </div>

          <div class="flex pt-4 mb-5 items-center">
            <h1 class="text-4xl">Update</h1>
            <div class="divider divider-horizontal"></div>
            <p class="font-light text-sm">Update produk kamu di sini</p>
          </div>

          {{-- @error('name')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror
          @error('slug')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror
          @error('price')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror
          @error('weight')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror
          @error('short_description')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror
          @error('description')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror
          @error('status')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror --}}

          <form action="{{ route('update.product', $product->slug) }}" method="post">  
            @csrf
            <div class="flex flex-col justify-center">
                <select class="select select-bordered w-full mb-2" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                <div class="flex flex-row justify-between mb-2">
                    <input name="name" type="text" placeholder="Name" class="input input-bordered w-full mr-1" value="{{ $product->name }}"/>
                    <input name="slug" type="text" placeholder="Slug" class="input input-bordered w-full ml-1" value="{{ $product->slug }}"/>
                </div>
                <input name="price" type="text" placeholder="price" class="input input-bordered w-full mb-2"
                value="{{ $product->price }}"/>
                <input name="weight" type="text" placeholder="Weight" class="input input-bordered w-full mb-2" 
                value="{{ $product->weight }}"/>
                <div class="flex flex-row justify-between mb-2">
                    <textarea name="short_description" class="textarea textarea-bordered w-full mr-1" placeholder="Short Description">{{ $product->short_description }}</textarea>
                    <textarea name="description" class="textarea textarea-bordered w-full ml-1" placeholder="Description">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="mt-8">
                <p class="text-xs font-thin mb-1">*Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur architecto quod non..</p>
                <button class="btn btn-outline btn-accent w-60" type="submit">Save</button>
            </div>
          </form>
    </x-content>
</x-layout>