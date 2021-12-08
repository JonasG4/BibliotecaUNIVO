let CreateForm = document.getElementById("CreateForm");

function showCreateForm(){
    CreateForm.classList.add("active");
}

function closeCreateForm(){
    CreateForm.classList.remove("active");
}


let formCreate = document.getElementById("AuthorBook__Create");

let url = document.getElementById("url").value;
let imageurl = "https://oharasiab1.blob.core.windows.net/ohara-storage/";


formCreate.addEventListener('submit', async function(e){
    e.preventDefault();


    let urlcreate =  url + "create";

    
    let datos = new FormData(formCreate);

    console.log(datos);

    const response = await fetch(urlcreate, { 
        method: "POST",
        body: datos
        });
        
        response.json()
        .then(data => {
            if(data['ErrValidation'] == true){
                document.getElementById("Author_Error").innerHTML = data['Author_Error'];
                document.getElementById("Book_Error").innerHTML = data["Book_Error"];
            }else{
                document.getElementById("Id_Author").value = "";
                document.getElementById("Id_Book").value = "";
                actualizarLista();
            }
        })
})

async function actualizarLista(){
    let tableBody = document.getElementById("formBody");
    
    let urlActualizar = url + 'refresh';

    const response = await fetch(urlActualizar, {
        method: "GET"
    });

    tableBody.innerHTML ="";
    response.json()
    .then(data => {
        data.forEach(element => {
            tableBody.innerHTML += `
            <tr class="table__body-row">
                        <td class="table__body-cell">` + element['First_Name'] + `</td>
                        <td class="table__body-cell">` + element['Book_Title'] + `</td>
                        <td class="table__body-cell">` + element['Book_Synopsis'] + `</td>
                        <td class="table__body-cell">` + element['Number_Pages'] + `</td>
                        <td class="table__body-cell">
                            <a href="" onclick="edit(`+ element['Id_Author']+`)">Editar</a>
                            <a href="" class="btn__action">Borrar</a>
                        </td>
                    </tr>
            `;
        });
    })

}