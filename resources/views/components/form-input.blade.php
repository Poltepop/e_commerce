<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
    <x-content>
        <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/homepage">Homepage</a></li>
              <li><a href="/products">Products</a></li>
              <li>Create</li>
            </ul>
          </div>

          <div class="flex pt-4 mb-5 items-center">
            <h1 class="text-4xl font-bold">Create</h1>
            <div class="divider divider-horizontal"></div>
            <p class="font-light text-sm text-gray-50">Add Your Product here</p>
          </div>

          @error('required')
          <x-alert-form>Error! {{ $message }}.</x-alert-form>
          @enderror

          <form action="{{ route('save.product') }}" method="post" enctype="multipart/form-data">  
            @csrf
            <div class="flex">
              {{-- right --}}
              <div class="rounded-box flex-col flex-grow place-items-center mr-4 w-1/3">

                {{-- Text Input --}}
                  <div class="card rounded-box bg-base-100 h-auto w-full p-5">
                    <div class="flex flex-row mb-3">
                      <label class="form-control w-full max-w-lg mr-3">
                        <div class="label">
                          <span class="label-text text-gray-50">What is your name product?</span>
                        </div>
                        <input type="text" name="name" value="Product-dummy" placeholder="Type here" class="input input-bordered w-full max-  w-lg" />
                      </label>
                      <label class="form-control w-full max-w-lg">
                        <div class="label">
                          <span class="label-text text-gray-50">Slug</span>
                        </div>
                        <input type="text" name="slug" placeholder="Type here" disabled class="input input-bordered w-full max-w-lg" />
                      </label>
                    </div>
                    <label class="form-control">
                      <div class="label">
                        <span class="label-text text-gray-50">Your Description</span>
                      </div>
                      <textarea name="description" class="textarea textarea-bordered h-24" placeholder="Description">Dummy Description</textarea>
                    </label>
                    <label class="form-control mt-3">
                      <div class="label">
                        <span class="label-text text-gray-50">Short Description</span>
                      </div>
                      <textarea name="short_description" class="textarea textarea-bordered h-24" placeholder="Description">Dummy Short Description</textarea>
                    </label>
                  </div>
                  {{-- File Input --}}
                  <div class="card rounded-box bg-base-100 h-auto w-full mt-5">
                    <div class="border-b-2 w-full  border-gray-700">
                      <h1 class="font-bold rounded-lg p-4 ">Image</h1>
                    </div>
                    <div class="p-5">
                      <label class="form-control w-full">
                        <div class="label">
                          <span class="label-text">Add Pitcure Here</span>
                        </div>
                        <input name="image" type="file" class="file-input file-input-bordered w-full"  accept="image/*">
                      </label>
                    </div>
                  </div>
                  
                  <div class="card rounded-box bg-base-100 h-auto w-full mt-5">
                    <div class="border-b-2 w-full  border-gray-700">
                      <h1 class="font-bold rounded-lg p-4 ">Inventory</h1>
                    </div>
                    <div class="p-5">
                      <label class="form-control w-full">
                        <div class="label">
                          <span class="label-text text-gray-50">Quantity</span>
                        </div>
                        <input type="text" name="qty" value="100" placeholder="Quantity" class="input input-bordered w-full" />
                      </label>
                    </div>
                  </div>

                  {{-- Pricing--}}
                  <div class="card rounded-box bg-base-100 h-auto w-full mt-5">
                    <div class="border-b-2 w-full  border-gray-700">
                      <h1 class="font-bold rounded-lg p-4">Pricing</h1>
                    </div>
                    <div class="p-5">
                      <div class="flex flex-row">
                        <label class="form-control w-full max-w-lg mr-3">
                          <div class="label">
                            <span class="label-text text-gray-50">Price</span>
                          </div>
                          <input type="text" name="price" value="100000.00" placeholder="Price" class="input input-bordered w-full max-w-lg" />
                        </label>
                        <label class="form-control w-full max-w-lg">
                          <div class="label">
                            <span class="label-text text-gray-50">Weight</span>
                          </div>
                          <input type="text" name="weight" value="10.00" placeholder="Weight" class="input input-bordered w-full max-w-lg" />
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="flex-row mt-5">
                    <button class="btn btn-sm btn-outline btn-accent">Create</button>
                    <a href="/products" class="btn btn-sm btn-outline btn-error">Cencel</a>
                  </div>
              </div>

              {{-- left --}}
              <div class="rounded-box flex-col flex-grow place-items-center max-w-xs">
                <div class="card rounded-box bg-base-100 h-auto w-full">
                  <div class="border-b-2 w-full  border-gray-700">
                    <h1 class="font-bold rounded-lg p-4">Status</h1>
                  </div>
                  <div class="p-5">
                    <div class="form-control w-auto">
                      <label class="label cursor-pointer">
                        <span class="label-text">Active</span>
                        <input type="checkbox" class="toggle toggle-accent" checked="checked" />
                      </label>
                      <p class="font-thin text-xs">This product will be hidden from all sales channels.</p>
                    </div>
                  </div>
                </div>

                <div class="rounded-box flex-col flex-grow place-items-center max-w-xs mt-5">
                  <div class="card rounded-box bg-base-100 h-auto w-full">
                    <div class="border-b-2 w-full border-gray-700">
                      <h1 class="font-bold rounded-lg p-4">Categories</h1>
                    </div>
                    <div class="p-5">
                      @foreach ($categories as $category)
                        
                      <div class="form-control">
                        <label class="label cursor-pointer">
                          <span class="label-text text-gray-50">{{ $category->name }}</span>
                          <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="checkbox checkbox-accent" />
                        </label>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
    </x-content>
</x-layout>