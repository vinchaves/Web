document.querySelectorAll('.lis').forEach(item => {
    item.addEventListener('mouseover', passarMouse);
});

function passarMouse(e) {
    document.querySelector('.lis.active').classList.remove('active')
    e.target.classList.add('active')
}