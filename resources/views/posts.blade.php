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
            <th>Job</th>
            <th>Favorite Color</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr class="hover">
            <th>1</th>
            <td>Cy Ganderton</td>
            <td>Quality Control Specialist</td>
            <td>Blue</td>
          </tr>
          <!-- row 2 -->
          <tr class="hover">
            <th>2</th>
            <td>Hart Hagerty</td>
            <td>Desktop Support Technician</td>
            <td>Purple</td>
          </tr>
          <!-- row 3 -->
          <tr class="hover">
            <th>3</th>
            <td>Brice Swyre</td>
            <td>Tax Accountant</td>
            <td>Red</td>
          </tr>
        </tbody>
      </table>
    </div>
  </x-content>
</x-layout>