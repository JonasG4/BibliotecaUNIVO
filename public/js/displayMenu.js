var btn = document.getElementById('btn-menu');
btn.onclick = () => {
    var menu = document.getElementById('display-menu');
    if(!menu.classList.contains('active')){
        menu.classList.add('active');
        if(menu.classList.contains('close')){
            menu.classList.remove('close');
        }
    }else if(!menu.classList.contains('close') && menu.classList.contains('active')){
        menu.classList.remove('active')
        menu.classList.add('close');
    }
}