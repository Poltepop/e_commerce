<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-content>
        <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/homepage">Homepage</a></li>
              <li>Carts</li>
            </ul>
          </div>

          <div class="flex pt-4 mb-5 border-b-2 border-gray-700 pb-4">
            <h1 class="text-4xl mr-5 text-gray-50 font-bold">Carts</h1>

            <label class="input input-bordered flex items-center gap-2">
              <form action="{{ route('carts') }}" class="flex">
                <input type="text" class="grow" name="search" placeholder="Search" />
                <button class="border-l-2 border-gray-700 pl-2" type="submit"><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 16 16"
                  fill="currentColor"
                  class="h-4 w-4 opacity-70">
                  <path
                    fill-rule="evenodd"
                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                    clip-rule="evenodd" />
                </svg></button>
              </form>
            </label>

          </div>

          {{-- Paginate --}}
          <div class="flex justify-end mb-2">
            <div class="hidden lg:flex w-full">
              <div class="card h-20 w-full max-w-xs bg-base-100 mr-2 p-3 pl-8 justify-center">
                <p class="text-gray-400 text-[13px]">Total Carts</p>
                <h1 class="font-bold  text-[30px]">{{ $totalCarts }}</h1>
              </div>
            </div>
          <div class="join flex items-end">
            <button class="join-item btn">1</button>
            <button class="join-item btn btn-active">2</button>
            <button class="join-item btn">3</button>
            <button class="join-item btn">4</button>
          </div>
        </div>

        {{-- table --}}
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
                      <th>Product Image</th>
                      <th>Username</th>
                      <th>Product</th>
                      <th>price</th>
                      <th>Quantity</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($carts as $cart)
                     @foreach ($cart->cartItems as $product)
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
                                src="{{ asset('storage/'. $product?->productImage?->path) }}"
                                alt="Avatar Tailwind CSS Component" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>{{ $cart->userCart->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td></td>
                        <td class="flex mt-3">
                              <form action="{{ route('delete.cart', $product->pivot->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline btn-error btn-xs">Remove</button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <!-- foot -->
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Product Image</th>
                        <th>username</th>
                        <th>Product</th>
                        <th>price</th>
                        <th>Quantity</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
    </x-content>
</x-layout>
