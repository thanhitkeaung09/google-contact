<div id="modalBox" tabindex="-1" class=" bg-[#80808078] flex items-center justify-center overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="closeBtn">Close</button>
            <div class="p-6 text-center space-y-5">

                <h3 class=" text-lg font-normal text-gray-500 dark:text-gray-400">Send the Email</h3>
                <input type="text" class="rounded-lg w-[300px]">
                <div class="">
                    <button data-modal-toggle="popup-modal" type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Send{{$item->id}}
                    </button>
                    <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>

            </div>
        </div>
    </div>
</div>
