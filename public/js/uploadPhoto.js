let url = document.getElementById('thisurl').value;
let redirecto = document.getElementById('redirecto').value;

document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById("form__file");

    form.addEventListener("submit", function(e){
        e.preventDefault();
        uploadFile(this).then(window.location.href= redirecto);
    })
})

function uploadFile(form){
    let progress_bar = document.getElementById('bar__state'),
        span = document.getElementById('progress__percent'),
        btn_cancel = document.getElementById('cancelar');

    //Peticion
    let request = new XMLHttpRequest();

    //Progreso
    request.upload.addEventListener("progress", function (e){
            let percent = Math.round((e.loaded / e.total) * 100);
            console.log(percent);

            progress_bar.style.width = percent+'%';
            span.innerHTML = percent+'%';
        });

        //Finalizado
        request.addEventListener('load', () =>{
            progress_bar.classList.add('upload_complete');
            span.innerHTML = "Progreso completado";
        })
        console.log(form)
        
        request.open('POST', url)
        request.send(new FormData(form));
    }



document.getElementById("userPhoto").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview = document.getElementById('preview__img'),
            image = document.createElement('img');

    var file = e.target.value;
    var filename = file.split('\\');
            
    image.src = reader.result;
    image.classList.add('preview__img');
    preview.innerHTML = '';
    preview.append(image);

    document.getElementById('form__file').classList.add('active');
    document.getElementById('sbmt__btn').classList.add('active');
    document.getElementById("preview").classList.add('active');
    document.getElementById("input__label").innerHTML = "Cambiar imagen"
    document.getElementById('icon-upload').classList.remove('fa-upload')
    document.getElementById('icon-upload').classList.add('fa-undo-alt');
    document.getElementById('btn__file').classList.add('active');
}}


    let btnFile = document.getElementById("btn__file");
    let inputFile = document.getElementById("userPhoto");


btnFile.onclick = () => {
    inputFile.click();
}