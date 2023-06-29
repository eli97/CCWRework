let isDarkModeEnabled = "";

function contrastToggle() {

    isDarkModeEnabled = getCookie("darkMode");

    let element = document.body;
    element.classList.toggle("darkMode");

    if (isDarkModeEnabled === "" || isDarkModeEnabled === "Disabled") {        
        setCookie("darkMode", "Enabled", 5)
    }
    else{
        setCookie("darkMode", "Disabled", 5)
    }
}

function darkModeEnable() {
    let element = document.body;
    element.classList.add("darkMode");

    setCookie("darkMode", "Enabled", 5)
}

function checkDarkModeCookie() {
    isDarkModeEnabled = getCookie("darkMode");

    if (isDarkModeEnabled === "Enabled") {
        darkModeEnable();
    }
    else {
        setCookie("darkMode", "Disabled", 5)
    }
}

//--- GENERAL COOKIE FUNCTIONS ---///

function setCookie(cname, cvalue, exdays) {
    const date = new Date();
    date.setTime(date.getTime() + (exdays*24*60*60*1000));
    let expires = date.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + "Expires=" + expires + ";" + "SameSite=Lax";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

//--- PAGE LOAD SCRIPTS ---//

document.onreadystatechange = function(){
    console.log(document.cookie);

    if (document.readyState === "complete") {
        checkDarkModeCookie();
    }
    else {
        window.onload = function () {
            //checkDarkModeCookie();
        }
    }
}