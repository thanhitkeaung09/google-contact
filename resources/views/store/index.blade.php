@extends('dashboard')
@section('content')
    <table class="w-[90%] text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class=" text-gray-700 border-b  ">
        <tr id="thead" class="">

            <th scope="col" class="py-3 px-6">
                Name
            </th>
            <th scope="col" class="py-3 px-6">
                Email
            </th>
            <th scope="col" class="py-3 px-6">
                Phone Number
            </th>
            <th scope="col" class="py-3 px-6">
                Job title & company
            </th>

            <th scope="col" class="py-3 px-6">
                Received From
            </th>



        </tr>
        </thead>

        <tbody>

{{--        {{$contacts}}--}}
{{--        @foreach($contacts as $item)--}}

            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 group hover:bg-gray-100 mb-4 cursor-pointer">

                <td class="py-4 px-6 flex items-center">
                    <div style="background-color:{{\App\Models\Contact::randColorBackground()}}"  class="img w-[30px] h-[30px] mr-2 rounded-full flex justify-center items-center text-white">
                        <p>{{\Illuminate\Support\Str::substr($contacts->fname,0,1)}}</p>
                    </div>
                   <p class="" > {{$contacts->fname}} {{$contacts->lname}}</p>
                </td>
                <td class="py-4 px-6">
                    {{$contacts->email}}
                </td>
                <td class="py-4 px-6 flex items-center justify-between !w-[111%]">
                    {{$contacts->phone}}
                </td>

                <td class="py-4  ">
                    {{$contacts->job}} and {{$contacts->company}}
                </td>

                <td class="py-4  ">
                    {{$store->sender}}
                </td>
            </tr>

{{--        @endforeach--}}
        </tbody>

    </table>
@endsection
