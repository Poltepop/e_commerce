<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <x-content>
    <div class="breadcrumbs text-sm">
      <ul>
        <li><a href="/homepage">Homepage</a></li>
        <li>Products</li>
      </ul>
    </div>
    <div class="flex pt-4 mb-5 border-b-2 border-gray-700 pb-4">
      <h1 class="text-4xl mr-5 text-gray-50 font-bold">Products</h1>

      <label class="input input-bordered flex items-center gap-2">
        <input type="text" class="grow" placeholder="Search" />
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 16 16"
          fill="currentColor"
          class="h-4 w-4 opacity-70">
          <path
            fill-rule="evenodd"
            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
            clip-rule="evenodd" />
        </svg>
      </label>

      <div class="divider divider-horizontal"></div>
      <a href="{{ route('form.product') }}" class="btn btn-outline btn-accent mr-2">Create</a>
      {{-- <a href="" class="btn btn-neutral">Update</a> --}}
    </div>

    <div class="flex justify-end mb-2">
      <div class="hidden lg:flex w-full">
        <div class="card h-20 w-full max-w-xs bg-base-100 mr-2 p-3 pl-8 justify-center">
          <p class="text-gray-400 text-[13px]">Total Products</p>
          <h1 class="font-bold  text-[30px]">50</h1>
        </div>
        <div class="card h-20 w-full max-w-xs bg-base-100 mr-2 p-3 pl-8 justify-center">
          <p class="text-gray-400 text-[13px]">Products Inventory</p>
          <h1 class="font-bold  text-[30px]">100</h1>
        </div>
        <div class="card h-20 w-full max-w-xs bg-base-100 mr-2 p-3 pl-8 justify-center">
          <p class="text-gray-400 text-[13px]">Average price</p>
          <h1 class="font-bold  text-[30px]">259.00</h1>
        </div>
      </div>
    <div class="join flex items-end">
      <button class="join-item btn">1</button>
      <button class="join-item btn btn-active">2</button>
      <button class="join-item btn">3</button>
      <button class="join-item btn">4</button>
    </div>
  </div>

    <div class="overflow-x-auto">
      <div class="card bg-base-100 w-full h-auto">
        <div class="border-b-2 border-gray-700 p-5">
          {{-- Header --}}
        </div>
        <div class="overflow-x-auto">
          <table class="table">
            <thead>
              <tr>
                <th>
                  <label>
                    <input type="checkbox" class="checkbox" />
                  </label>
                </th>
                <th>Image</th>
                <th class="pr-[160px]">Name</th>
                <th class="pr-[160px]">Slug</th>
                <th>Price</th>
                <th>Weight</th>
                <th class="pr-[160px]">Description</th>
                <th class="pr-[160px]">Short Description</th>
                <th>Status</th>
                <th class="pr-[60px]">Creted_at</th>
                <th class="pr-[60px]">Updated_at</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product )
                
              <!-- row 1 -->
              <tr>
                <th>
                  <label>
                    <input type="checkbox" class="checkbox" />
                  </label>
                </th>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar">
                      <div class="mask mask-squircle h-12 w-12">
                        <img
                          src="{{ asset('storage/' . $product->productImage->path) }}"
                          alt="Avatar Tailwind CSS Component" />
                        </div>
                      </div>
                    </div>
                  </td>
                  <td width='200'>{{ $product->name }}</td>
                  <td>{{ $product->slug }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->weight }}</td>
                  <td>{{ $product->short_description }}</td>
                  <td>{{ $product->description }}</td>
                  <td>{{ $product->status }}</td>
                  <td>{{ $product->created_at->diffForhumans() }}</td>
                  <td>{{ $product->updated_at->diffForhumans() }}</td>
                  <td class="flex mt-3">
                    <form action="{{ route('form.update.product', $product->slug) }}" method="get">
                      <button type="submit" class="btn btn-outline btn-accent btn-xs">Update</button>
                    </form>
                    <form action="{{ route('delete.product', $product->id) }}" method="POST" class="ml-1">
                      @csrf
                      <button type="submit" class="btn btn-outline btn-error btn-xs">Remove</button>
                    </form>
                  </td>
                </tr>
                @endforeach
            </tbody>
            <!-- foot -->
            <tfoot>
              <tr>
                <th></th>
                <th>Image</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Price</th>
                <th>Weight</th>
                <th>Short Description</th>
                <th>Description</th>
                <th>Status</th>
                <th>Creted_at</th>
                <th>Updated_at</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </x-content>
</x-layout>