(function() {
    "use strict";
  
    /**
     * The starting point in our program, setting up a listener
     * for the "load" event on the window, signalling the HTML DOM has been constructed
     * on the page. When this event occurs, the attached function (init) will be called.
     */
    window.addEventListener("load", init);
  
    /**
     * TODO: Write a function comment using JSDoc.
     */
    function init() {
      // Note: In this function, we usually want to set up our event handlers
      // for UI elements on the page.
      console.log("Window Loaded!");
      document.getElementById("form-btn").addEventListener("click", validate);
    }
  
    // Add any other functions in this area (you should not implement your
    // entire program in the init function, for similar reasons that
    // you shouldn't write an entire Java program in the main method).
    
    
  })();

function sendMail() {
    let email = document.getElementById('email').value;
    let pNumber = document.getElementById('phonenumber').value;
    let message = document.getElementById('message').value;
    let fName = document.getElementById('firstname').value;
    let lName = document.getElementById('lastname').value;

    window.location="mailto:"
}