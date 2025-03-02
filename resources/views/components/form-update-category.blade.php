<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-content>
        <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/homepage">Homepage</a></li>
              <li><a href="/categories">Categories</a></li>
              <li>Update</li>
            </ul>
          </div>

          <div class="flex pt-4 mb-5 items-center">
            <h1 class="text-4xl font-bold">Create</h1>
            <div class="divider divider-horizontal"></div>
            <p class="font-light text-sm text-gray-50">Update Your Category here</p>
          </div>

          @error('name')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror
          <form action="{{ route('update.category' , $category->slug) }}" method="post">
          @csrf
          <div class="card w-full bg-base-100">
            <div class="border-b-2 border-gray-700 w-full p-4">
              <h1 class="font-bold">Category</h1>
            </div>
            <div class="p-5">
              <div class="flex justify-between w-full">
              <label class="form-control w-full max-w-lg mr-1">
                <div class="label">
                  <span class="label-text text-gray-50">Category</span>
                </div>
                <input name="name" type="text" value="{{ $category->name }}" placeholder="Category" class="input input-bordered w-full max-w-lg" />
              </label>
              <label class="form-control w-full max-w-lg">
                <div class="label">
                  <span class="label-text text-gray-50">Slug</span>
                </div>
                <div class="border-2 border-gray-700 rounded-md">
                  <input name="slug" type="text" value="{{ $category->slug }}" placeholder="Slug" class="input input-bordered w-full max-w-lg" disabled/>
                </div>
              </label>
            </div>

            <label class="form-control">
              <div class="label">
                <span class="label-text">Description</span>
              </div>
              <div class="border-2 border-gray-700 rounded-md">
                <textarea class="textarea textarea-bordered h-24 w-full" placeholder="Lagi Maintenance" disabled></textarea>
              </div>
            </label>
          </div>
        </div>
        <div class="flex-row mt-5">
          <button class="btn btn-sm btn-outline btn-accent">Update</button>
          <a href="/categories" class="btn btn-sm btn-outline btn-error">Cencel</a>
        </div>
      </form>
    </x-content>
</x-layout>