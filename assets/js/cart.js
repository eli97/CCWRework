function showCart() {
  document.getElementById("cartDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')){
    var dropdowns = document.getElementsByClassName("cartContent");
    var i;
    for(i = 0; i<dropdowns.length; i++){
      var openDropdown = dropdowns[i];
      if(openDropdown.classList.contains('show')){
        openDropdown.classList.remove('show');
      }
    }
  }
}
