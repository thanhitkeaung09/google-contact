<x-app-layout>
    <div class="w-[90%] mx-auto">
        <div class="grid grid-cols-12">
            <div class="col-span-2">
                @include('layouts.sidebar')
            </div>
            <div class="col-span-10">
                <div class="">
                    @include('components.query')

                    @yield('content')
                    @stack('script')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
