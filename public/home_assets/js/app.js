// When the user scrolls down 20px from the top of the document, slide down the navbar
// window.onscroll = function() {scrollFunction()};

// function scrollFunction() {
//   if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
//     document.getElementById("navbar-header").style.top = "0";
//   } else {
//     document.getElementById("navbar-header").style.top = "-250px";
//   }
// }




// // mobile nav

// var menu= document.querySelector('#nav-btn')
// var menuwrapper=document.querySelector('.mobile-nav-wrapper')
// var close= document.querySelector('#close-btn')
// var nav= document.querySelector('#nav-btns')
// var mobilenav=document.querySelector('.mobile-nav-wrappers')
// var remove= document.querySelector('#close-btns')

// menu.addEventListener('click',function(e){
//     menuwrapper.style.display='inline-block';
//     close.style.display='inline-block';
//     menu.style.display='none';
//     remove.style.display='inline-block';
//     nav.style.display='none';

// })

// close.addEventListener('click',function(e){
//     menuwrapper.style.display='none';
//     close.style.display='none';
//     menu.style.display='inline-block';
//     mobilenav.style.display='none';
//     remove.style.display='none';
//     nav.style.display='inline-block';
// })




// nav.addEventListener('click',function(e){
//     mobilenav.style.display='inline-block';
//     remove.style.display='inline-block';
//     nav.style.display='none'
//     close.style.display='inline-block';
//     menu.style.display='none';
//     menuwrapper.style.display='none';
// })

// remove.addEventListener('click',function(e){
//   menuwrapper.style.display='none';
//     mobilenav.style.display='none';
//     remove.style.display='none';
//     nav.style.display='inline-block';
//     close.style.display='none';
//     menu.style.display='inline-block';
    
// })

$(window).scroll(function () {
    var sc = $(window).scrollTop()
    var topH = $(".header").outerHeight();
    if (sc > topH) {
        $(".header").addClass("fixed")
    } else {
        $(".header").removeClass("fixed")
    }
});



