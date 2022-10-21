@extends('dashboard')
@section('content')
{{--        {{$contact}}--}}
        <div class="mt-6">
            <a href="{{route('contact.index')}}">
                <i class="fa-solid fa-arrow-left-long"></i>
            </a>
        </div>
        <div class="w-[90%] mx-auto py-6 border-b">
            <div class="grid grid-cols-12">
                <div class="col-span-6">
                    <div class="flex items-center">
                        <div class="mr-[30px]">
                            @if($contact->photo)
                                <div class=" w-[180px] h-[180px] rounded-full overflow-hidden">
                                    <img src="{{asset('storage/'.$contact->photo)}}" class="w-[180px] h-[180px] object-cover" alt="">
                                </div>
                            @else
                                <div style="background-color:{{\App\Models\Contact::randColorBackground()}}" class=" w-[180px] h-[180px] rounded-full overflow-hidden flex justify-center items-center text-white">
                                    <div  class="  w-[30px] h-[30px]  rounded-full flex justify-center items-center">
                                        <p class="text-[50px] font-semibold">{{\Illuminate\Support\Str::substr($contact->fname,0,1)}}</p>
                                    </div>
                                    {{--                                <img src="{{asset('storage/'.$contact->photo)}}" class="w-[120px] h-[120px] object-cover" alt="">--}}
                                </div>
                            @endif


                        </div>
                        <div class="">
                            <h1 class="text-[20px]">{{$contact->fname}} {{$contact->lname}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="flex items-center justify-end h-[100%]">
                            <a href="{{route('contact.edit',$contact->id)}}" class="px-6 py-2 bg-blue-500 rounded-md text-white" >Edit</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-[90%] mx-auto mt-6">
            <div class="grid grid-cols-12">
                <div class="col-span-6">
                    <div class="space-y-3 border p-5 border-1 rounded-lg border-gray-300">
                        <h1 class="font-semibold">Contact detail</h1>
                        @if($contact->email)
                            <div class="flex items-center space-x-5">
                                <i class="fa-regular fa-envelope text-gray-400"></i>
                                <p class="text-blue-700">{{$contact->email}}</p>
                            </div>
                        @else
                            <div class="flex items-center space-x-5">
                                <i class="fa-regular fa-envelope text-gray-400"></i>
                                <a href="{{route('contact.edit',$contact->id)}}">
                                    <p class="text-blue-700" >Add an email</p>
                                </a>
                            </div>
                        @endif

                        <div class="flex items-center space-x-5">
                            <i class="fa-solid fa-phone text-gray-400"></i>
                            <p class="text-blue-700">{{$contact->phone}}<span class="text-gray-400 text-[15px]">. Mobile</span> </p>
                        </div>

                        <div class="flex items-center space-x-5">
                            <i class="fa-solid fa-cake text-gray-400"></i>
                            <p class="text-blue-700">{{$contact->birthday}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
