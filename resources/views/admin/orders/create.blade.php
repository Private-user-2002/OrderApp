<x-admin.app-layout>
    <div class="mx-48 py-5">
        <form action="{{ route('admin.orders.store') }}" method="POST">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-xl font-semibold leading-7 text-gray-900">Orders Information</h2>
                    @csrf
                    <x-input-error :messages="$errors->all()" class="mt-2" />
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" autocomplete="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="user_id" class="block text-sm font-medium leading-6 text-gray-900">User</label>
                            <div class="mt-2">
                                <select id="user_id" name="user_id" autocomplete="user_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="my-5 grid grid-cols-1 gap-x-6 sm:grid-cols-6">
                        <div class="mt-5 sm:col-span-6 flex justify-between">
                            <h1 class="text-xl font-semibold leading-7 text-gray-900 my-3">Products</h1>
                            <button type="button" class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-3 me-2 mb-2" id="add-btn">Add Products</button>
                        </div>
                        <div class="sm:col-span-6 sm:col-start-1" id="dynamicInput">
                            <div class="flex gap-x-6 py-3 input-container">
                                <input required type="text" name="items[0][item_name]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300" placeholder="Product Name">
                                <input required type="text" name="items[0][amount]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 amount" placeholder="Product Amount">
                                <input required type="text" name="items[0][qty]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 quantity" placeholder="Product Quantity">
                                <input type="text" disabled name="items[0][total]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 total" placeholder="Product Total">
                                <button type="button" class="btn btn-danger remove-btn">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('admin.orders.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-2">Cancel</a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-5 py-2.5 me-2 mb-2 mt-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
    </div>
</x-admin.app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Add more input fields
        $("#add-btn").click(function(){
            var index = $(".input-container").length; // Get the current number of items
            var html = '<div class="sm:col-span-2 sm:col-start-1 flex gap-x-6 py-3 input-container">' +
                '<input type="text" name="items[' + index + '][item_name]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300" placeholder="Product Name">' +
                '<input type="text" name="items[' + index + '][amount]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 amount" placeholder="Product Amount">' +
                '<input type="text" name="items[' + index + '][qty]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 quantity" placeholder="Product Quantity">' +
                '<input type="text" disabled name="items[' + index + '][total]" class="rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 total" placeholder="Product Total">' +
                '<button type="button" class="btn btn-danger remove-btn">Remove</button></div>';
            $("#dynamicInput").append(html);
        });


        // Remove input fields
        $(document).on("click", ".remove-btn", function(){
            $(this).parent('.input-container').remove();
        });

        // Calculate total when amount or quantity changes
        $(document).on("input", ".amount, .quantity", function() {
            var container = $(this).closest('.input-container'); // Get the parent container
            var amount = parseFloat(container.find('.amount').val());
            var quantity = parseInt(container.find('.quantity').val());
            var total = 0.00; // Initialize total outside the if-else block

            if (!isNaN(amount) && !isNaN(quantity)) {
                total = parseFloat(amount) * parseInt(quantity); // Update total without var keyword
            } else {
                total = 0.00; // Reset total if either amount or quantity is not a valid number
            }

            container.find('.total').val(total.toFixed(2)); // Update the total field within the same container
        });

    });
</script>

