let CreateForm = document.getElementById("CreateForm");

function showCreateForm(){
    CreateForm.classList.add("active");
}

function closeCreateForm(){
    CreateForm.classList.remove("active");
}


let formCreate = document.getElementById("Book__Create");

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
                document.getElementById("ISBN_Error").innerHTML = data['ISBN_Error'];
                document.getElementById("Title_Error").innerHTML = data["Title_Error"];
                document.getElementById("Author_Error").innerHTML = data["Author_Error"]
                document.getElementById("Synopsis_Error").innerHTML = data["Synopsis_Error"];
                document.getElementById("Npages_Error").innerHTML = data["NumberPages_Error"];
                document.getElementById("Edition_Error").innerHTML = data["Edition_Error"];
                document.getElementById("Date_Error").innerHTML = data["Date_Error"];
                document.getElementById("Genre_Error").innerHTML = data["Genre_Error"];
                document.getElementById("Publisher_Error").innerHTML = data["Publisher_Error"];
                document.getElementById("Cover_Error").innerHTML = data["Cover_Error"];
            }else{
                document.getElementById("ISBN").value = "";
                document.getElementById("Book_Title").value = "";
                document.getElementById("Id_Author").value = "";
                document.getElementById("Book_Synopsis").value = "";
                document.getElementById("Number_Pages").value = "";
                document.getElementById("Book_Edition").value = "";
                document.getElementById("Publication_Date").value = "";
                document.getElementById("Id_Genre").value = "";
                document.getElementById("Id_Publisher").value = "";
                document.getElementById("Book_Cover").value = "";

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
                        <td class="table__body-cell"><img src="` + imageurl + element['Book_Cover'] + `" alt="" class="table__cover"></td>
                        <td class="table__body-cell">` + element['Book_Title'] + `</td>
                        <td class="table__body-cell">` + element['Book_Synopsis'] + `</td>
                        <td class="table__body-cell">` + element['First_Name'] + " " + element['Last_Name'] + `</td>
                        <td class="table__body-cell">` + element['Genre_Name'] + `</td>
                        <td class="table__body-cell">`+ element['Publisher_Name']+`</td>
                        <td class="table__body-cell">`+ element['Book_Edition']+`</td>
                        <td class="table__body-cell">`+ element['Number_Pages']+`</td>
                        <td class="table__body-cell">`+ element['Publication_Date']+`</td>
                        <td class="table__body-cell">
                            <a href="" onclick="edit(`+ element['Book_Id']+`)">Editar</a>
                            <a href="" class="btn__action">Borrar</a>
                        </td>
                    </tr>
            `;
        });
    })

}