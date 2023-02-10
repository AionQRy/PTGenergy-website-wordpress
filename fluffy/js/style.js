
jQuery(document).ready(function($) {
    $('#tab-bar_style_1').addClass('active');
    $('.tab-bar_style_1').addClass('active');

    const buttons1 = document.querySelectorAll(".tab-bar_style");
    const sections1 = document.querySelectorAll(".list-content");

    buttons1.forEach((btn1)=>{

    btn1.addEventListener("click", ()=>{
    buttons1.forEach((btn1)=>{
    btn1.classList.remove("active");
    });
    btn1.classList.add("active");
    const id1 = btn1.id;
    sections1.forEach((section1)=>{
    section1.classList.remove("active");
    });
    const req1 = document.getElementsByClassName(`${id1}`);
    req1[0].classList.add("active");
    })
})

$('#tab-hotbar_style_1').addClass('active');
$('.tab-hotbar_style_1').addClass('active');

const buttons2 = document.querySelectorAll(".tab-bar_style");
const sections2 = document.querySelectorAll(".list-content");

buttons2.forEach((btn2)=>{

btn2.addEventListener("click", ()=>{
buttons2.forEach((btn2)=>{
btn2.classList.remove("active");
});
btn2.classList.add("active");
const id1 = btn2.id;
sections2.forEach((section2)=>{
section2.classList.remove("active");
});
const req1 = document.getElementsByClassName(`${id1}`);
req1[0].classList.add("active");
})
})
});