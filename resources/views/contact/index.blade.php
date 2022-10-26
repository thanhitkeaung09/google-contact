@extends('dashboard')
@section('content')



    <div class=" relative">
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

                <th scope="col" class="py-3 px-6 invisible  ">
                    Action
                </th>

            </tr>
            </thead>

            <tbody>

            <div class="hidden" id="del-btn">
                <form  id="multipleIdDelete" method="post" class="">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <div class="">

                            <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">
                                <i class="fa-solid fa-list"></i>
                                <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 !mt-[20px]">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                    <li>
                                        <a class="cursor-pointer block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" id="selectAllBtn">Select All</a>
                                    </li>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="">
                            <i class="fa-solid fa-list-dots" id="deleteBtn"></i>
                            <div class="hidden border shadow-sm" id="delShow">
                                <button id="multipleDelete"  class="px-[50px] bg-blue-600 px-2 py-2 text-white rounded-lg" >Multiple Delete</button>
                                <button id="multipleCopy" class="mt-5 px-[50px] bg-blue-600 px-2 py-2 text-white rounded-lg" >Multiple Copy</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            @push('script')
                <script type="module">
                    let btn = document.getElementById('dropdownDefault');
                    let dropdown = document.getElementById('dropdown');
                    let delBtn = document.getElementById('deleteBtn');
                    let delShow = document.getElementById('delShow');
                    let selectAllBtn = document.getElementById('selectAllBtn');
                    let checkBox = document.querySelectorAll('.checkBox')
                    let selectCount = document.getElementById("selectedCount");
                    let multipleDelete = document.getElementById("multipleDelete");
                    let multipleCopy = document.getElementById("multipleCopy");
                    let multipleIdDelete = document.getElementById('multipleIdDelete');
                    let selectedItem = [];

                    multipleDelete.addEventListener("click",function (){
                        multipleIdDelete.setAttribute('action',"{{route('contact.multipleDelete')}}");
                    })

                    multipleCopy.addEventListener("click",function (){
                        multipleIdDelete.setAttribute('action',"{{route('contact.multipleCopy')}}");

                    })


                    selectAllBtn.addEventListener("click",function (){
                        checkBox.forEach(item => {
                            item.setAttribute('checked',true)
                            console.log(item.checked)
                            if(item.checked == true){
                                selectedItem.push('a')
                                selectCount.innerText = selectedItem.length
                                console.log(selectedItem)
                            }
                            item.addEventListener("click",function(){
                                // console.log(item.checked)
                                if(item.checked == false){
                                    selectedItem.pop()
                                    console.log('ma shi par buu')
                                    selectCount.innerText = selectedItem.length
                                }
                            })

                        })

                    })

                    btn.addEventListener('click',function (){
                        dropdown.classList.toggle('hidden')
                    })

                    delBtn.addEventListener("click",function (){
                        delShow.classList.toggle('hidden')
                    })


                </script>
            @endpush


            <tr class="flex justify-between w-[310%] my-5">
                <td class="ml-[30px]">Contact : {{\App\Models\Contact::count()}}</td>
                <td>Selected item <span id="selectedCount">0</span> </td>
            </tr>

            @foreach($contact as $item)

            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 group hover:bg-gray-100 mb-4 cursor-pointer">

                <td scope="row" id="NameClick{{$item->id}}" class="  font-medium text-gray-900 whitespace-nowrap dark:text-white">
                @if($item->photo)

                        <div class="flex items-center">
                            <span class=" invisible group-hover:visible">
                                <svg class=""  width="20" height="20" viewBox="0 0 24 24" class="NSy2Hd cdByRd RTiFqe undefined"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
                            </span>
                            <input type="checkbox" id="{{$item->id}}"  value="{{$item->id}}" name="checkbox[]" form="multipleIdDelete" class="ml-2 checkBox inp hidden group-hover:block mr-4 checked:block">
                            <div id="{{$item->id}}" class="img group-hover:hidden  w-[30px] h-[30px] mr-2 rounded-full overflow-hidden flex justify-center items-center text-white">
                                <img src="{{asset(\Illuminate\Support\Facades\Storage::url($item->photo))}}" class=" object-cover w-[30px] h-[30px]" alt="">
                            </div>
                            <a href="{{route('contact.show',$item->id)}}">
                                <h1>{{ $item->fname}}  {{$item->lname}}</h1>
                            </a>
                        </div>
                    @else
                        <div class="flex items-center">

                              <span class=" invisible group-hover:visible">
                                <svg class=""  width="20" height="20" viewBox="0 0 24 24" class="NSy2Hd cdByRd RTiFqe undefined"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
                            </span>
                            <input  type="checkbox" id="{{$item->id}}"  value="{{$item->id}}" form="multipleIdDelete"  name="checkbox[]" class="ml-2  checkBox inp hidden group-hover:block mr-4 checked:block">

                            <div style="background-color:{{\App\Models\Contact::randColorBackground()}}" id="{{$item->id}}" class="img group-hover:hidden w-[30px] h-[30px] mr-2 rounded-full flex justify-center items-center text-white">
                                <p>{{\Illuminate\Support\Str::substr($item->fname,0,1)}}</p>
                            </div>
                            <a href="{{route('contact.show',$item->id)}}">
                                <h1> {{ $item->fname}}  {{$item->lname}}</h1>
                            </a>
                        </div>
                    @endif
                    @push('script')
                        <script type="module">
                            let btn = document.querySelectorAll('.inp');
                            let delBtn = document.getElementById('del-btn');
                            let thead = document.getElementById('thead');
                            let selectCount = document.getElementById("selectedCount");
                            let NameClick = document.getElementById("NameClick{{$item->id}}");
                            let img = document.querySelectorAll(".img");
                            let selectedItem = [];
                            let sendBtn = document.querySelectorAll('.send-data');
                            let closeBtn = document.querySelectorAll('.closeBtn');
                            let defaultModal = document.getElementById('defaultModal');

                            btn.forEach(item => {
                                item.addEventListener("click",function(){
                                    if(item.checked){
                                        img.forEach(image => {
                                            if(item.getAttribute('id') === image.getAttribute('id')){
                                                image.classList.add("hidden")
                                            }
                                        })
                                    }
                                    else{
                                        img.forEach(image => {
                                            if(item.getAttribute('id') === image.getAttribute('id')){
                                                image.classList.remove("hidden")
                                            }
                                        })
                                    }

                                    if(item.checked == true){
                                        delBtn.classList.add("!block")
                                        thead.classList.add("hidden")
                                        selectedItem.push("a");
                                        selectCount.innerText = selectedItem.length
                                    }
                                    else if (item.checked == false) {
                                        delBtn.classList.remove("!block")
                                        thead.classList.remove("hidden")
                                        selectedItem.pop();
                                        selectCount.innerText = selectedItem.length
                                    }
                                })
                            })

                            // Modal Js
                            sendBtn.forEach(button => {
                                button.addEventListener("click",function(e){
                                    e.preventDefault();
                                    console.log(button)
                                    // defaultModal.classList.remove('hidden')
                                    // console.log(defaultModal)
                                })
                            })

                            closeBtn.forEach(closeButton =>{
                                closeButton.addEventListener("click",function(){
                                    defaultModal.classList.add('hidden')
                                })
                            })
                        </script>
                    @endpush

                </td>
                <td class="py-4 px-6">
                    {{$item->email}}
                </td>
                <td class="py-4 px-6">
                    {{$item->phone}}
                </td>
                <td class="py-4 px-6 flex items-center justify-between !w-[111%]">
                    <p>{{$item->job}} and {{$item->company}}</p>
                </td>

                <td class="py-4  ">
                    <div class="hidden group-hover:block flex space-x-3 ">
                        <form class="">

                                <form id="{{$item->id}}" class="a-tag" action="{{route('contact.copy',$item->id)}}" method="post" >
                                    @csrf
                                    <button class="btn-copy" id="btnCopy">
                                        <i class="fa-regular fa-copy" id="{{$item->id}}"></i>
                                    </button>
                                </form>


                            <a href="{{route('contact.edit',$item->id)}}">
                                <i class="fa-solid fa-pencil text"></i>
                            </a>



                            <form action="{{route('contact.destroy',$item->id)}}"  class="trash-tag" method="post" id="{{$item->id}}">
                                @csrf
                                @method('delete')
                                <button type="submit " class="trashBtn" id="trashBtn">
                                    <i class="fa-solid fa-trash" id="{{$item->id}}"></i>
                                </button>
                            </form>

{{--                            transfer btn--}}
{{--                            <form action="{{route('store.create',$item->id)}}" method="post"></form>--}}

                                <button type="submit" class="send-data" id="{{$item->id}}" >
                                    <i class="fa-solid fa-arrow-up-from-bracket " id="{{$item->id}}"></i>
                                </button>

{{--                            </form>--}}

{{--                            --}}{{--        Modal Box--}}
{{--                            <div id="defaultModal" tabindex="-1" aria-hidden="true" class=" flex items-center justify-center bg-[#80808096] overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">--}}
{{--                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">--}}
{{--                                    <!-- Modal content -->--}}
{{--                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">--}}
{{--                                        <!-- Modal header -->--}}
{{--                                        <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">--}}
{{--                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">--}}
{{--                                                Terms of Service--}}
{{--                                            </h3>--}}
{{--                                            <button type="button" class=" closeBtn text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">--}}
{{--                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--                                                <span class="sr-only">Close modal</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}

{{--                                        <!-- Modal body -->--}}
{{--                                        <div class="p-6 space-y-6">--}}
{{--                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">--}}
{{--                                            <form action="{{route('store.store',$item->id)}}" method="post" id="transferForm">--}}
{{--                                                @csrf--}}
{{--                                                <input type="text" name="receiverEmail" class="rounded-lg border-gray-300 active:ring-0 focus:outline-none">--}}
{{--                                                {{$item->id}}--}}
{{--                                                </form>--}}
{{--                                            </p>--}}

{{--                                        </div>--}}
{{--                                        <!-- Modal footer -->--}}
{{--                                        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">--}}
{{--                                            <button  id="{{$item->id}}" data-modal-toggle="defaultModal" form="transferForm" type="submit" class=" transform-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send Data {{$item->id}} </button>--}}
{{--                                            <button data-modal-toggle="defaultModal" id="" type="button" class="closeBtn text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </td>
            </tr>


            @endforeach
            </tbody>
        </table>

        @push('script')
            <script>
                let transferBtn = document.querySelectorAll('.transform-btn');
                transferBtn.forEach(transferButton =>{
                    transferButton.addEventListener("click",function(){
                        console.log(transferButton)
                    })
                })
            </script>
        @endpush


        <form action="{{route('contact.export')}}" method="get" class="flex justify-end">
            @csrf
            <button class="px-2 py-2 text-white rounded-lg bg-blue-400" >Download</button>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 mt-6">
            {{ $contact->links('pagination::tailwind') }}
        </div>
    </div>

@endsection
