<x-admin.app-layout>
    <div class="flex  justify-start items-start ml-12 mt-5">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center ring-1 ring-gray-300 text-gray-900 font-semibold py-2 px-4 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
              </svg>

            Back
        </a>
    </div>

    <div class="px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl font-semibold leading-6 text-gray-900 m-5">Orders Details</h1>
        <div class="sm:flex sm:items-center mt-4 m-5">
            <div class="bg-white p-4 rounded-lg mr-4 w-72">
                <p class="text-base text-gray-500">Order Name</p>
                <p class="text-md-center font-semibold text-gray-900">{{ $order->title }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg w-72">
                <p class="text-base text-gray-500">User Name</p>
                <p class="text-lg font-semibold text-gray-900">{{ $order->user?->name }}</p>
            </div>
        </div>
        <div class="m-5">
            <h1 class="text-xl font-semibold leading-6 text-gray-900">Products Detaila</h1>
        </div>

        <div class="m-5">
            <div class="overflow-x-auto">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->item_name ?? '--' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->amount ?? '--' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->total ?? '--' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
