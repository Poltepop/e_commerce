<x-layout>
  <x-content>
    <div class="breadcrumbs text-sm">
      <ul>
        <li><a>Homepage</a></li>
        <li>Posts</li>
      </ul>
    </div>
    <div class="flex pt-4 mb-5">
      <h1 class="text-4xl mr-5">Posts</h1>

      <input type="text" placeholder="Serch"class="input input-bordered w-full max-w-xs" />

      <div class="divider divider-horizontal"></div>
      <select class="select select-bordered  max-w-xs">
        <option>Create</option>
        <option>Update</option>
      </select>
    </div>
    <hr>

    <div class="flex justify-end">
    <div class="join mt-10 mb-2">
      <button class="join-item btn">1</button>
      <button class="join-item btn btn-active">2</button>
      <button class="join-item btn">3</button>
      <button class="join-item btn">4</button>
    </div>
  </div>

    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Weight</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          @foreach ($products as $product)
          <tr class="hover">
            <th>1</th>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['price'] }}</td>
            <td>{{ $product['weight'] }}</td>
            <td>{{ $product['description'] }}</td>
            <td>{{ $product['status'] }}</td>
            <td>{{ $product['created_at'] }}</td>
            <td>{{ $product['updated_at'] }}</td>
            <td>
              <button type="submit">Remove</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </x-content>
</x-layout>