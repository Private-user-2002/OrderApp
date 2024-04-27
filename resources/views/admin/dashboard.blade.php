<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-lg">
                <div class="mt-5 overflow-hidden bg-white hover:bg-gray-300 shadow-sm sm:rounded-lg">
                    <div class="flex justify-start gap-x-2 p-6 text-gray-900">
                        Orders
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
