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
                            <a onclick="editBook('`+ element['Id_Book']+`')" class="btn__action">Editar</a>
                            <a onclick="deleteBook('`+ element['Id_Book']+`')" class="btn__action">Borrar</a>
                        </td>
                    </tr>
            `;
        });
    })

}

let updateForm = document.getElementById("UpdateForm");

// let update__Form = document.getElementById("Book__Update");

// updateForm.addEventListener("submit", function(e) {
//     e.preventDefault();
    
//     let urlcreate =  url + "create";

    
//     let datos = new FormData(formCreate);

//     console.log(datos);

//     const response = await fetch(urlcreate, { 
//         method: "POST",
//         body: datos
//         });
        
//         response.json()
//         .then(data => {
//             if(data['ErrValidation'] == true){
//                 document.getElementById("ISBN_Error").innerHTML = data['ISBN_Error'];
//                 document.getElementById("Title_Error").innerHTML = data["Title_Error"];
//                 document.getElementById("Author_Error").innerHTML = data["Author_Error"]
//                 document.getElementById("Synopsis_Error").innerHTML = data["Synopsis_Error"];
//                 document.getElementById("Npages_Error").innerHTML = data["NumberPages_Error"];
//                 document.getElementById("Edition_Error").innerHTML = data["Edition_Error"];
//                 document.getElementById("Date_Error").innerHTML = data["Date_Error"];
//                 document.getElementById("Genre_Error").innerHTML = data["Genre_Error"];
//                 document.getElementById("Publisher_Error").innerHTML = data["Publisher_Error"];
//                 document.getElementById("Cover_Error").innerHTML = data["Cover_Error"];
//             }else{
//                 document.getElementById("ISBN").value = "";
//                 document.getElementById("Book_Title").value = "";
//                 document.getElementById("Id_Author").value = "";
//                 document.getElementById("Book_Synopsis").value = "";
//                 document.getElementById("Number_Pages").value = "";
//                 document.getElementById("Book_Edition").value = "";
//                 document.getElementById("Publication_Date").value = "";
//                 document.getElementById("Id_Genre").value = "";
//                 document.getElementById("Id_Publisher").value = "";
//                 document.getElementById("Book_Cover").value = "";

//                 actualizarLista();
//             }
//         })
// })

async function editBook(id){

    let urlupdate = url + 'update/' + id;

    const response = await fetch(urlupdate, {
        method: 'GET',
    });

    response.json().then(data => {
        console.log(data);

    let auxAuthor = '';

    data["Authors"].forEach(element => {
        if(element["Id_Author"] == data["Book"]["Id_Author"]){
            auxAuthor += `<option selected value="` + element['Id_Author'] + `">` + element["First_Name"] + ' ' + element["Last_Name"] + `</option>`;
        }else{
            auxAuthor += `<option value="` + element['Id_Author'] + `">` + element["First_Name"] + ' ' + element["Last_Name"] + `</option>`;
        }
    })

    let auxGenre = "";
    data["Genres"].forEach(element => {
        if(element["Id_Genre"] == data["Book"]["Id_Genre"]){
            auxGenre += `<option selected value="` + element['Id_Genre'] + `">` + element["Genre_Name"] + `</option>`;
        }else{
            auxGenre += `<option value="` + element['Id_Genre'] + `">` + element["Genre_Name"] +`</option>`;
        }
    }) 
    
    let auxPublisher = "";
    data["Publishers"].forEach(element => {
        if(element["Id_Publisher"] == data["Book"]["Id_Publisher"]){
            auxPublisher += `<option selected value="` + element['Id_Publisher'] + `">` + element["Publisher_Name"] + `</option>`;
        }else{
            auxPublisher += `<option value="` + element['Id_Publisher'] + `">` + element["Publisher_Name"] +`</option>`;
        }
    }) 
    
    updateForm.innerHTML += `
    <form id="Book__Update" method="POST" autocomplete="off" class="Main__Form" enctype="multipart/form-data">
        <div class="Main__Form-Row">
            <div class="Main__Form-Group">
                <label for="ISBN">ISBN: </label>
                <input type="text" name="ISBN" id="ISBN" placeholder="Ingrese un ISBN válido" value="`+data["Book"]["ISBN"]+`">
                <span id="ISBN_Error"></span>
            </div>
        </div>
        <div class="Main__Form-Row">
            <div class="Main__Form-Group">
                <label for="Book_Title">Título del libro: </label>
                <input type="text" name="Book_Title" id="Book_Title" placeholder="Escribe el título del libro" value="`+data["Book"]["Book_Title"]+`">
                <span id="Title_Error"></span>
            </div>
            <div class="Main__Form-Group">
                <label for="Id_Author">Autor del libro: </label>
                <select name="Id_Author" id="Id_Author" class="Input__Select">
                ` +
                auxAuthor             
                + `
                </select>
                <span id="Author_Error"></span>
            </div>
        </div>

        <div class="Main__Form-Group">
            <label for="Book_Synopsis">Añade una pequeña sinopsis: </label>
            <textarea name="Book_Synopsis" id="Book_Synopsis">`+data["Book"]["Book_Synopsis"]+`</textarea>
            <span id="Synopsis_Error"></span>
        </div>

        <div class="Main__Form-Row">
            <div class="Main__Form-Group">
                <label for="Number_Pages">Cantidad de páginas: </label>
                <input type="number" name="Number_Pages" id="Number_Pages"  value="`+data["Book"]["Number_Pages"]+`" placeholder="Escribe la cantidad de páginas">
                <span id="Npages_Error"></span>
            </div>
            <div class="Main__Form-Group">
                <label for="Book_Edition">Edición del libro: </label>
                <input type="number" name="Book_Edition" id="Book_Edition" value="`+data["Book"]["Book_Edition"]+`" placeholder="Añade la edición del libro">
                <span id="Edition_Error"></span>
            </div>
            <div class="Main__Form-Group">
                <label for="Publication_Date">Fecha de publicación: </label>
                <input type="date" name="Publication_Date" id="Publication_Date" value="`+data["Book"]["Publication_Date"]+`">
                <span id="Date_Error"></span>
            </div>
        </div>

        <div class="Main__Form-Row">
            <div class="Main__Form-Group">
                <label for="Id_Genre">Géneros: </label>
                <select name="Id_Genre" id="Id_Genre" class="Input__Select">
                   `+auxGenre+`
                </select>
                <span id="Genre_Error"></span>

            </div>
            <div class="Main__Form-Group">
                <label for="Id_Publisher">Editoriales: </label>
                <select name="Id_Publisher" id="Id_Publisher" class="Input__Select">
                  `+auxPublisher+`
                </select>
                <span id="Publisher_Error"></span>
            </div>
        </div>
        <div class="Main__Form-row">
            <div class="Main__Form-Group">
                <label for="Book_Cover">Seleccione portada</label>
                <input type="file" name="Book_Cover" id="Book_Cover" accept="images/*">
            </div>
            <span id="Cover_Error"></span>
        </div>
        <button type="submit" class="Main__Button Main__Button-Save">
            <i class="fas fa-save"></i>
            Actualizar
        </button>
        <button onclick="closeCreateForm()" class="Main__Button Main__Button-Cancel">
            Cancelar
        </button>
    </form>
    `;
    
    updateForm.classList.add("active");
})

}

async function deleteBook(id){

    let urldelete = url + 'Delete/' + id;

    const response = await fetch(urldelete, {
        method: 'GET'
    });

    response.json()
    .then(data => {
        console.log(data);
        actualizarLista();
    })



}