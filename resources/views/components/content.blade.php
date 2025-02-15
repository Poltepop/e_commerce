<div class="drawer lg:drawer-open mt-1 text-slate-50">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col items-center ml-1">
      <!-- Page content here -->
      <div class="flex w-full flex-col border-opacity-50">
        <div class="card bg-base-300 rounded-box grid pb-10 pt-4 px-8">
            {{ $slot }} 
        </div>
      </div>
    </div>
    <x-sidebar></x-sidebar>
</div>