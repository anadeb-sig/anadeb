const tbody = document.querySelector('#tbody');

const getdata = async () => {
  const endpoint = "https://api.covid19api.com/summary",
        response = await fetch(endpoint),
        data = await response.json(),
        Ecoles = data.Ecoles;

        Ecoles.forEach(countryObj => {
    let {Message} = countryObj;
    tbody.innerHTML += 
    `<tr>
        <td>${Message}</td>
    </tr>`;
 });

}
getdata();
/*
fetch("http://127.0.0.1:8000/api/ecoles").then((data)=>{
    return data.json();
}).then((objectData)=>{
    console.log(objectData[0]);
    let tableData = "";
    objectData.tableData.map(values => [
        tableData =`<h1>${values.id}</h1>`
    ]);
    document.getElementById('tbody').innerHTML = tableData;
})*/