let url = document.getElementById('uri').value;
let search = document.getElementById('search');

console.log(url);
async function getBooksFiltered(books){
    const response = await fetch(url,{
        method : 'POST',
        mode : "cors",
        headers: {
            'Content-Type' : 'application/json'
        },
        redirect: 'follow',
        body: JSON.stringify(books)     
        }
    )
    
    response.json().then(
        (data) => {
            console.log(data);
            // document.getElementById('filters').innerHTML = data;
        }
        )
    }
    
    search.onkeydown = (e) => {
        var searchvalue = e.target.value;
        if(searchvalue !=""){
        console.log(searchvalue);
        getBooksFiltered(searchvalue);
    }else{
        getBooksFiltered();
    }
}

