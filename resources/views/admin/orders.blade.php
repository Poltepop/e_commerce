<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-content>
        <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/homepage">Homepage</a></li>
              <li>Orders</li>
            </ul>
        </div>

        <div class="flex justify-between items-center">
            <h1 class="text-4xl mr-5 text-gray-50 font-bold">Orders</h1>
            <form action="{{ route('add.orders.view') }}" method="get">
                <button class="btn btn-accent">New Orders</button>
            </form>
        </div>

        <div class="flex justify-between mt-10">
            <div class="card h-[100px] w-full max-w-lg bg-base-100 mr-4 p-3 pl-8 justify-center">
                <p class="text-gray-400 text-[13px]">Total Orders</p>
                <h1 class="font-bold  text-[30px]">10</h1>
            </div>
            <div class="card w-full max-w-lg bg-base-100 mr-4 p-3 pl-8 justify-center">
                <p class="text-gray-400 text-[13px]">Open Orders</p>
                <h1 class="font-bold  text-[30px]">100</h1>
            </div>
            <div class="card w-full max-w-lg bg-base-100 mr-4 p-3 pl-8 justify-center">
                <p class="text-gray-400 text-[13px]">Average Price</p>
                <h1 class="font-bold  text-[30px]">10,000,00</h1>
            </div>
        </div>

        <div class="flex justify-center mt-10 mb-5">
            <div class="w-full max-w-lg bg-base-100 flex justify-center items-center rounded-xl py-2">
                <button class="btn mx-1 btn-xs">All</button>
                <button class="btn mx-1 btn-xs">New</button>
                <button class="btn mx-1 btn-xs">Procesing</button>
                <button class="btn mx-1 btn-xs">Shipped</button>
                <button class="btn mx-1 btn-xs">Deliverd</button>
                <button class="btn mx-1 btn-xs">Cencelled</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="card bg-base-100 w-full h-auto">
                <div class="border-b-2 border-gray-700 p-5 flex justify-between">
                    <select class="select select-bordered ">
                        <option selected>Orders By</option>
                    </select>

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
                </div>
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>test</th>
                                <th>test</th>
                                <th>test</th>
                                <th>test</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>test</th>
                                <th>test</th>
                                <th>test</th>
                                <th>test</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>        

    </x-content>
</x-layout>