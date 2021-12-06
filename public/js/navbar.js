
function setLocationMenu(url) {
    window.location.href= url;
    console.log(url);
}

let svg_user = document.getElementById("svg_user");
var btn = document.getElementById('btn-menu');
btn.onclick = () => {
    var menu = document.getElementById('display-menu');
    if(!menu.classList.contains('active')){
        menu.classList.add('active');
        btn.classList.add('active');
        svg_user.innerHTML = '<path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" class=""></path>'
        if(menu.classList.contains('close')){
            menu.classList.remove('close');
        }
    }else if(!menu.classList.contains('close') && menu.classList.contains('active')){
        menu.classList.remove('active')
        btn.classList.remove('active');
        menu.classList.add('close');
        svg_user.innerHTML = '<path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path>';
    }
}


let searchInput = document.getElementById('searchInput');
let resultContainer = document.getElementById('searchFilter');
console.log(searchInput.value.length); 
async function filter(url){
        if(searchInput.value.length > 0) {
        data = 
        {
            criterio: searchInput.value,
        }
    
        const response = await fetch(url, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json'
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data)
        });
    
        response.json()
        .then(data => {
           resultContainer.innerHTML = data;
        })
    }else{
        resultContainer.innerHTML = `
        <div class="recent__Search">
        <h1 class="recent__Search-head">Busquedas Recientes</h1>
        <ul class="recent__Search-list">
            <li>
                <p class="search__list-item">It stephen king</p>
                <span class="btn__quit">
                    <svg aria - hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="item__list-icon">
                        <path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
                    </svg>
                </span>
            </li>
        </ul>
    </div>
           `;
    
    }
    }
