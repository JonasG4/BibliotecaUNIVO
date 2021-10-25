async function Update(Id, Url){
    let First_Name = document.getElementById(First_Name).value;
    let Last_Name = document.getElementById(Last_Name).value;
    let Origin_Country = document.getElementById(Origin_Country).value;

    data = {
        Id : Id,
        First_Name : First_Name,
        Last_Name : Last_Name,
        Origin_Country : Origin_Country
    };
    
    const response = await fetch(Url, {
        method : 'POST',
        mode : 'cors',
        cache : 'no-cache',
        credentials : 'same-origin',
        headers: {
            'Content-Type' : 'application/json'
        },
        redirect : 'follow',
        referrerPolicy : 'no-referrer',
        body : JSON.stringify(data)
    });

    response.json().then(data => {
        if(data){
            alert('Good');
        }else{
            alert(data);
        }
    });
}