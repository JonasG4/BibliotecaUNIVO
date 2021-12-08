let CreateForm = document.getElementById("CreateForm");

function showCreateForm(){
    CreateForm.classList.add("active");
}

function closeCreateForm(){
    CreateForm.classList.remove("active");
}


let formCreate = document.getElementById("Publisher__Create");

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
                document.getElementById("Phone_Error").innerHTML = data["Phone_Error"];
                document.getElementById("Country_Error").innerHTML = data["Country_Error"]
            }else{
                document.getElementById("Publisher_Name").value = "";
                document.getElementById("Phone_Number").value = "";
                document.getElementById("Origin_Country").value = "";
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
                        <td class="table__body-cell">` + element['Publisher_Name'] + `</td>
                        <td class="table__body-cell">` + element['Phone_Number'] + `</td>
                        <td class="table__body-cell">` + element['Origin_Country'] + `</td>
                        <td class="table__body-cell">
                            <a href="" onclick="edit(`+ element['Id_Author']+`)">Editar</a>
                            <a href="" class="btn__action">Borrar</a>
                        </td>
                    </tr>
            `;
        });
    })

}