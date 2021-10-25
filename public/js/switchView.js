var btns = document.querySelectorAll('#btn__group button');
var content = document.getElementById('content__selected');




btns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        
        switch(e.target.id){
            case 'btn__history-Loan':
                window.location.href = '/Biblioteca/loan/'
            break;
            case 'btn__my-books':
                content.innerHTML = '<h1>Mis libros</h1>';
            break;
            case 'btn__edit-profile':
                content.innerHTML = '<h1>Editar perfil</h1>';
                break;
                case 'btn__change-password':
                    content.innerHTML = '<h1>Cambiar contraseña</h1>';
                    break;    
        }
    } )
});

