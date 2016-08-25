var home = document.querySelector('.home');
var list1 = document.querySelector('.list-1');
var list2 = document.querySelector('.list-2');
var list3 = document.querySelector('.list-3');
var list4 = document.querySelector('.list-4');
var HomeList = document.querySelector('.ol-1');
var headShot = document.querySelector('.headshot');
var Grow = document.querySelector('.grow');
var backGrow = document.querySelector('.backGrow');

home.addEventListener('click', function (event) {
    event.preventDefault();
    HomeList.classList.remove('srink');
    list1.classList.toggle('visible1');
    list2.classList.toggle('visible2');
    list3.classList.toggle('visible3');
    list4.classList.toggle('visible4');
});

var last_known_scroll_position = 0;
var ticking = false;

function srink(scroll_pos) {
    if (window.scrollY < 10) {
        document.querySelector('.ol-1').classList.remove('srink');
    }else {
        HomeList.classList.add('srink');
        list1.classList.remove('visible1');
        list2.classList.remove('visible2');
        list3.classList.remove('visible3');
        list4.classList.remove('visible4');
    }
}

window.addEventListener('scroll', function (e) {
    last_known_scroll_position = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(function () {
            srink(last_known_scroll_position);
            ticking = false;
        });
    }
    ticking = true;
});

HomeList.addEventListener('mouseover', function (event) {
    HomeList.classList.remove('srink');
});

backGrow.addEventListener('click', function (event) {
    backGrow.classList.toggle('backVisible');
    headShot.classList.toggle('grow');
});
