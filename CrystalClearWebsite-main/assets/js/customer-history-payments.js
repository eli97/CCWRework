let payments = [
    [1, "Micheal Miyer",  "10/26/2022", 000000000, 10, "Chemical + Basket", "Cash"],
    [1, "Micheal Miyer",    "9/29/022", 123456789,  5, "Chemical + Basket", "Online"],
    [1, "Micheal Miyer",   "7/26/2022", 856956789, 20, "Full Service",  "Online"],
    [1, "Micheal Miyer",   "6/26/2022", 123456789, 20, "Full Service",  "Online"],
];
var currentindex = 0;
var currentindex = 0;
var originTable = myTable.innerHTML
show()

function show(){
    var table = document.getElementById('myTable')
    var row = '';
    for(var i = currentindex; i < (currentindex+2) && i < payments.length; i++){
        row += `<tr>
                <th scope="row">${payments[i][2]}</th>
                <th>${payments[i][3]}</th>
                <th>${payments[i][4]}</th>
                <th>${payments[i][5]}</th>
            </tr>`;
        
    }
    
    table.innerHTML += row;
}
function next(){
    currentindex += 2;
    myTable.innerHTML = originTable
    show();         
}
function prev(){
    currentindex -= 2;
    myTable.innerHTML = originTable
    show(); 
    
}