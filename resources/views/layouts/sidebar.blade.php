<div class="">
    <div class="text-center">
        <a href="{{route('contact.create')}}" class="flex items-center justify-center space-x-4 bg-white px-2.5 py-3 rounded-full shadow w-[84%] ">
            <i class="fa-regular fa-plus"></i>
            <p class="">Create contact</p>
        </a>
    </div>
    <ul class="space-y-3 mt-3">

        <li class="text-center rounded-full text-black py-1 side-bar ">
            <a href="{{route('contact.index')}}" class="flex items-center space-x-4 ml-5 btn">
                <i class="fa-regular fa-user"></i>
                <p>Contacts</p>
            </a>
        </li>

        <li class="text-center rounded-full text-black py-1 side-bar ">
            <a href="{{route('store.index')}}" class="flex items-center space-x-4 ml-5 btn">
                <i class="fa-regular fa-user"></i>
                <p>Shared Contact</p>
            </a>
        </li>

        <li class="text-center rounded-full text-black py-1 side-bar">
            <a href="{{route('contact.trash')}}" class="flex items-center space-x-4 ml-5 btn">
                <i class="fa-solid fa-trash"></i>
                <p>Trash Bin</p>
            </a>
        </li>
    </ul>
</div>

<script type="module">
    // let sidebtn = document.querySelectorAll('.side-bar');
    // sidebtn.forEach(item => {
    //     item.addEventListener("click", function(e){
    //         // e.preventDefault();
    //         sidebtn.forEach(el=>{
    //             el.classList.remove("bg-blue-400")
    //         })
    //         e.currentTarget.classList.add("bg-blue-400")
    //     })
    //     // item.classList.remove("bg-blue-400")
    //
    // })
</script>
