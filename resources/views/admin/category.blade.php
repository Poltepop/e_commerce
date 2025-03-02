<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-content>
        {{-- Header --}}
        <div class="breadcrumbs text-sm">
            <ul>
              <li><a href="/homepage">Homepage</a></li>
              <li>Categories</li>
            </ul>
          </div>
          <div class="flex pt-4 mb-5 border-b-2 border-gray-700 pb-4">
            <h1 class="text-4xl mr-5 text-gray-50 font-bold">Categories</h1>
      
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
            <a href="{{ route('form.input.category') }}" class="btn btn-outline btn-accent mr-2">Create</a>
          </div>

          {{-- Paginate --}}
          <div class="flex justify-end mb-2">
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
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Created_at</th>
                      <th>Updated_at</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category )
                      
                    <!-- row 1 -->
                    <tr>
                      <th>
                        <label>
                          <input type="checkbox" class="checkbox" />
                        </label>
                      </th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td class="flex mt-3">
                          <form action="{{ route('form.update.category', $category->slug) }}" method="get">
                            <button type="submit" class="btn btn-outline btn-accent btn-xs">Update</button>
                          </form>
                          <form action="{{ route('delete.category', $category->id) }}" method="POST" class="ml-1">
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
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Created_at</th>
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