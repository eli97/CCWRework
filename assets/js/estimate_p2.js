let estimate = localStorage.getItem("myEstimate");
console.log(estimate);
let estimateNotice = '';
estimateNotice += '<input type="hidden" class="form-control" name="Request"  value="Request for '+estimate+'">';
//estimateNotice += '<input type="hidden" class="form-control" name="estimate" value="Request for repairs">';
document.getElementById('Estimates').innerHTML += estimateNotice;