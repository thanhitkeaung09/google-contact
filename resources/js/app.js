import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// let btn = document.querySelectorAll('.btn');

// console.log(btn)
// console.log(btn)

const btn = document.querySelector(".upload");
const file = document.getElementById("file");
btn.addEventListener("click",function(){
    // console.log("hello")
    file.click()

})


