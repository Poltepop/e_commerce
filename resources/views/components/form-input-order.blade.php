<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-content>
        <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/homepage">Homepage</a></li>
              <li><a href="/orders">Orders</a></li>
              <li>Create</li>
            </ul>
        </div>

        <div class="flex pt-4 mb-5 items-center">
            <h1 class="text-4xl font-bold">Create</h1>
            <div class="divider divider-horizontal"></div>
            <p class="font-light text-sm text-gray-50">add orders</p>
        </div>

        <form action="" method="post">  
            @csrf
            <div class="flex">
              {{-- right --}}
              <div class="rounded-box flex-col flex-grow place-items-center mr-4 w-1/3">

                {{-- Text Input --}}
                  <div class="card rounded-box bg-base-100 h-auto w-full p-5">
                    <div class="flex flex-row mb-3">
                        <label class="form-control w-full max-w-xl mr-3">
                          <div class="label">
                            <span class="label-text text-gray-50">Products</span>
                          </div>
                          <select class="select select-bordered w-full max-w-xl">
                            @foreach ($products as $product )
                              <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                          </select>
                        </label>
                        <label class="form-control w-full max-w-xl">
                          <div class="label">
                            <span class="label-text text-gray-50">Users</span>
                          </div>
                          <select class="select select-bordered w-full max-w-xl">
                            @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                          </select>
                        </label>
                    </div>
                    <label class="form-control w-full">
                      <div class="label">
                        <span class="label-text text-gray-50">quantity</span>
                      </div>
                      <input name="qty" type="text" placeholder="100" class="input input-bordered w-ful" />
                    </label>
                    <label class="form-control">
                      <div class="label">
                        <span class="label-text text-gray-50">Note</span>
                      </div>
                      <textarea name="note" class="textarea textarea-bordered h-24" placeholder="Description">Noted</textarea>
                    </label>
                  </div>

                  <div class="card rounded-box bg-base-100 h-auto w-full mt-5">
                    <div class="border-b-2 w-full  border-gray-700">
                      <h1 class="font-bold rounded-lg p-4 ">Discount</h1>
                    </div>
                    <div class="p-5">
                      <div class="flex flex-row mb-3">
                        <label class="form-control w-full max-w-xl mr-3">
                          <div class="label">
                            <span class="label-text text-gray-50">Discount percent</span>
                          </div>
                          <input name="discount_percent" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl" />
                        </label>
                        <label class="form-control w-full max-w-xl">
                          <div class="label">
                            <span class="label-text text-gray-50">Discount Amound</span>
                          </div>
                          <input name="discount_amount" type="text" placeholder="-" class="input input-bordered w-full max-w-xl" disabled/>
                        </label>
                    </div>
                    </div>
                  </div>

                  <div class="card rounded-box bg-base-100 h-auto w-full mt-5">
                    <div class="border-b-2 w-full  border-gray-700">
                      <h1 class="font-bold rounded-lg p-4 ">Bil</h1>
                    </div>
                    <div class="p-5">
                      <div class="flex flex-row mb-3">
                        <label class="form-control w-full mr-3">
                          <div class="label">
                            <span class="label-text text-gray-50">Shipping Cost</span>
                          </div>
                          <input name="shipping_cost" type="text" placeholder="1.00" class="input input-bordered w-full" />
                        </label>
                      </div>
                      <div class="flex flex-row mb-3">
                        <label class="form-control w-full max-w-xl mr-3">
                          <div class="label">
                            <span class="label-text text-gray-50">Base Total Price</span>
                          </div>
                          <input name="base_total" type="text" placeholder="-" class="input input-bordered w-full max-w-xl" disabled/>
                        </label>
                        <label class="form-control w-full max-w-xl">
                          <div class="label">
                            <span class="label-text text-gray-50">Grand total</span>
                          </div>
                          <input name="grand_total" type="text" placeholder="-" class="input input-bordered w-full max-w-xl" disabled/>
                        </label>
                    </div>
                    </div>
                  </div>

                  <div class="flex-row mt-5">
                    <button class="btn btn-sm btn-outline btn-accent">Create</button>
                    <a href="/orders" class="btn btn-sm btn-outline btn-error">Cencel</a>
                  </div>
                </div>
            </div>
        </form>
    </x-content>
</x-layout>