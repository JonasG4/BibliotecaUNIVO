let CreateForm = document.getElementById("CreateForm");

function showCreateForm(){
    CreateForm.classList.add("active");
}

function closeCreateForm(){
    CreateForm.classList.remove("active");
}


let formCreate = document.getElementById("Book__Create");

formCreate.addEventListener('submit', async function(e){
    e.preventDefault();

    let url = "http://localhost/Biblioteca/book/create";

    let datos = new FormData(formCreate);

    console.log(datos);

    const response = await fetch(url, { 
        method: "POST",
        body: datos
        });
        
        if(response.ok){
            console.log("OOOOOOOOOOOOOK")
        }

        response.json()
        .then(data => {
            console.log(data);
            window.location.reload(true);
        })
})