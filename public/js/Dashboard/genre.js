let CreateForm = document.getElementById("CreateForm");

function showCreateForm(){
    CreateForm.classList.add("active");
}

function closeCreateForm(){
    CreateForm.classList.remove("active");
}


let formCreate = document.getElementById("Genre__Create");

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
                document.getElementById("Name_Error").innerHTML = data['Name_Error'];
                document.getElementById("Description_Error").innerHTML = data["Description_Error"];
            }else{
                document.getElementById("Genre_Name").value = "";
                document.getElementById("Genre_Description").value = "";
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
                        <td class="table__body-cell">` + element['Genre_Name'] + `</td>
                        <td class="table__body-cell">` + element['Genre_Description'] + `</td>
                        <td class="table__body-cell">
                            <a href="" onclick="edit(`+ element['Id_Author']+`)">Editar</a>
                            <a href="" class="btn__action">Borrar</a>
                        </td>
                    </tr>
            `;
        });
    })

}