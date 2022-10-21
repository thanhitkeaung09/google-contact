@extends('dashboard')
@section('content')
    <div class="ml-10">
        <form action="{{route('contact.store')}}" class="space-y-3" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="flex items-center w-[50%] justify-between">
                <div class="img">
                    <div class="flex items-center justify-center relative" id="replactImg">
                        <i class="fa-solid fa-camera fa-2x absolute text-gray-400 "></i>
                        <img src="{{asset('storage/user.png')}}" class="upload rounded-full w-[50%]" id="default" alt="">
                        <div class="flex w-[120px] h-[120px] rounded-full bg-blue-600 hidden overflow-hidden" id="div">
                            <img src="" class="hidden object-cover " id="output" alt="">
                        </div>
                        <input type="file" name="photos" class="" id="file" hidden>
                    </div>
                </div>
                <button type="submit" id="btn" class="bg-blue-600 text-white px-6 py-2 rounded-lg ">Save</button>
            </div>

            <script type="module">
                let input = document.getElementById('file');
                let defau = document.getElementById("default");
                let output = document.getElementById('output');
                let div = document.getElementById('div');
                input.addEventListener("change",function (){
                    let currentFile = this.files[0]

                    let reader = new FileReader();
                    reader.readAsDataURL(currentFile)

                    reader.onload = function (e){
                        defau.classList.add('hidden')
                        output.classList.remove('hidden')
                        div.classList.remove('hidden')
                        output.src = e.target.result
                    }
                })
            </script>


            <div class="flex">
                <i class="fa-regular fa-user text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" name="fname" required class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="First name">
                    <input type="text" name="lname" required class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600 " placeholder="Last name">
                </div>
            </div>

            <div class="flex">
                <i class="fa-regular fa-building text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" name="company" class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Company">
                    <input type="text" name="job" class="border-0 border-b w-[100%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600 " placeholder="Job Title">
                </div>
            </div>

            <div class="flex">
                <i class="fa-regular fa-envelope text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" name="email" class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Email">
                </div>
            </div>

            <div class="flex">
                <i class="fa-solid fa-phone text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" name="phone" required class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Phone">
                </div>
            </div>

            <div class="flex">
                <i class="fa-solid fa-cake text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="date" name="birthday" class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Birthday">
                </div>
            </div>

            <div class="flex">
                <i class="fa-solid fa-note-sticky text-gray-300 mt-3 mr-3" ></i>
                <div class="space-y-3">
                    <input type="text" name="note" class="border-0 border-b w-[203%] border-b-gray-300 placeholder-gray-300 focus:ring-0 focus:border-b-blue-600" placeholder="Note">
                </div>
            </div>
        </form>
    </div>
@endsection
