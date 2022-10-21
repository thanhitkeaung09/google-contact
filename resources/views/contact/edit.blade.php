@extends('dashboard')
@section('content')
    <div class="ml-10">
{{--        {{dd($contact->fname)}}--}}

        <form action="{{route('contact.update',$contact->id)}}" class="space-y-3" method="post" enctype="multipart/form-data" >
            @csrf
            @method('put')


            <h1 class="text-[30px] font-semibold" >Update Your Information</h1>
            <div class="flex">
                <i class="fa-regular fa-user text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" value="{{$contact->fname}}" name="fname" required class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="First name">
                    <input type="text" value="{{$contact->lname}}" name="lname" required class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600 " placeholder="Last name">
                </div>
            </div>

            <div class="flex">
                <i class="fa-regular fa-building text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" value="{{$contact->company}}" name="company" class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Company">
                    <input type="text" value="{{$contact->job}}" name="job" class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600 " placeholder="Job Title">
                </div>
            </div>

            <div class="flex">
                <i class="fa-regular fa-envelope text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" value="{{$contact->email}}" name="email" class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Email">
                </div>
            </div>

            <div class="flex">
                <i class="fa-solid fa-phone text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" value="{{$contact->phone}}" name="phone" required class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Phone">
                </div>
            </div>

            <div class="flex">
                <i class="fa-solid fa-cake text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" value="{{$contact->birthday}}" name="birthday" class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Birthday">
                </div>
            </div>

            <div class="flex">
                <i class="fa-solid fa-note-sticky text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" value="{{$contact->note}}" name="note" class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Note">
                </div>
            </div>

            <div class="text-end w-[49%]">
                {{--                <input type="file" name="photos[]">--}}
                {{--                <h1 class="text-[20px]">Update Your Information</h1>--}}
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg ">Update</button>
            </div>

        </form>
    </div>
@endsection
