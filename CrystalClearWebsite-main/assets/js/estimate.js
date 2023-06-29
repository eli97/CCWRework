const cleaning = document.getElementById("cleaning");
const repairs = document.getElementById("repairs");
const inpect = document.getElementById("inpect");
const sendMgs = document.getElementById("sendMsg");
let estimateNotice = "none";
    localStorage.setItem("myEstimate", estimateNotice);
cleaning.addEventListener('click', function(){
    console.log("Cleaning is pressed");
    let estimateNotice = "Cleaning";
    localStorage.setItem("myEstimate", estimateNotice);
    window.location.href="contact.html"
    

})
repairs.addEventListener('click', function(){
    console.log("Repairs is pressed");
    let estimateNotice = "Repairs";
    localStorage.setItem("myEstimate", estimateNotice);
    window.location.href="contact.html"
    //estimateNotice += '<input type="hidden" class="form-control" name="estimate" value="Request for repairs">';
    //document.getElementById('Estimates').innerHTML += estimateNotice;
    

})
inpect.addEventListener('click', function(){
    console.log("Inpect is pressed");
    let estimateNotice = "Inpection";
    localStorage.setItem("myEstimate", estimateNotice);
    window.location.href="contact.html"
    //estimateNotice +='<input type="hidden" class="form-control" name="estimate" value="Request for inpect">';
    //document.getElementById('Estimates').innerHTML += estimateNotice;
    

})
    
/*
function cleaningNotice(){
    console.log("Cleaning is pressed2");
    
}
function repairsNotice(){
    console.log("Repairs is pressed");
    let estimateNotice = '';
    estimateNotice += '<p>Repair</p>'; 
    estimateNotice += '<input type="hidden" class="form-control" name="estimate" value="Request for repairs">';
    document.getElementById('Estimates').innerHTML += estimateNotice;
}
function inpectNotice(){
    console.log("Inpect is pressed");
    let estimateNotice = '';
    estimateNotice += '<p>Inpect</p>';
    estimateNotice +='<input type="hidden" class="form-control" name="estimate" value="Request for inpect">';
    document.getElementById('Estimates').innerHTML += estimateNotice;
    
}
*/