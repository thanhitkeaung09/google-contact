import './bootstrap';
import Swal from 'sweetalert2'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// let btn = document.getElementById('btnCopy')
let aTag = document.getElementById('aTag');
let aTagSubmit = document.querySelectorAll('.a-tag');
let multipleCopy = document.getElementById("multipleCopy");
let multipleIdDelete = document.getElementById('multipleIdDelete');
let multipleDelete = document.getElementById("multipleDelete");
let trashBtn = document.querySelectorAll('.trashBtn');
let deleteSingle = document.getElementById('deleteSingle');
let copyBtn = document.querySelectorAll(".btn-copy");
let trashTagSubmit = document.querySelectorAll('.trash-tag');

copyBtn.forEach(btn=>{
    btn.addEventListener('click', function (e){
        e.preventDefault();
        console.log(e.target.id);
        Swal.fire({
            title: 'Do you want to copy the contact?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Copy',
            denyButtonText: `Don't copy`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if ( result.isConfirmed) {
                // aTag.submit();
                aTagSubmit.forEach(a=>{
                    if(e.target.id === a.getAttribute('id')){
                        a.submit();
                    }

                    // console.log(a.getAttribute('id'))
                })
            }
        })
    })
})

multipleCopy.addEventListener('click', function (e){
    e.preventDefault();
    Swal.fire({
        title: 'Do you want to copy the contacts?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Copy',
        denyButtonText: `Don't copy`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if ( result.isConfirmed) {
            // multipleIdDelete.setAttribute('action',"{{route('contact.multipleCopy')}}");
            multipleIdDelete.submit();
            // console.log(result.isConfirmed)
            // window.location.href = 'http://127.0.0.1:8000/copy?1'
        }
    })
})

multipleDelete.addEventListener('click', function (e){
    e.preventDefault();
    Swal.fire({
        title: 'Do you want to delete the contacts?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Delete',
        denyButtonText: `Don't delete`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if ( result.isConfirmed) {
            // multipleIdDelete.setAttribute('action',"{{route('contact.multipleCopy')}}");
            multipleIdDelete.submit();
            // console.log(result.isConfirmed)
            // window.location.href = 'http://127.0.0.1:8000/copy?1'
        }
    })
})

trashBtn.forEach(item => {
    item.addEventListener('click', function (e){
        e.preventDefault();
        Swal.fire({
            title: 'Do you want to delete the contact?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Delete',
            denyButtonText: `Don't delete`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if ( result.isConfirmed) {
                console.log("this is delete")
                // deleteSingle.submit();
                trashTagSubmit.forEach(item => {
                    // console.log(e.target.id);
                    if(e.target.id === item.getAttribute('id')){
                        item.submit();
                    }
                    // return item.getAttribute('id')
                })
            }
        })
    })
})







