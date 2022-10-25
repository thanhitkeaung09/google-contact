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
                <form action="{{route('contact.multipleDelete')}}" id="multipleIdDelete" method="post" class="">
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
                                <button  class="px-[50px] bg-blue-600 px-2 py-2 text-white rounded-lg" >Delete</button>

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
                    let selectedItem = [];


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
                                <h1>{{ $item->fname}}  {{$item->lname}}</h1>
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
                    <div class="hidden group-hover:block">
                        <div class="flex space-x-3 ">
                            <a href="">
                                <i class="fa-regular fa-copy"></i>
                            </a>


                            <a href="{{route('contact.edit',$item->id)}}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>



                            <form action="{{route('contact.destroy',$item->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit " class="trashBtn" id="trashBtn">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>


            @endforeach
            </tbody>


        </table>
        <form action="{{route('contact.export')}}" method="get" class="flex justify-end">
            @csrf
            <button class="px-2 py-2 text-white rounded-lg bg-blue-400" >Download</button>
        </form>
    </div>

{{--   <div class="">--}}
{{--       {{ $items->links() }}--}}
{{--   </div>--}}
    <div class="row">
        <div class="col-md-12 mt-6">
            {{ $contact->links('pagination::tailwind') }}
        </div>
    </div>

@endsection
