function showPassword() {
    var x = document.getElementById("password");
    const icon = document.getElementById("icon"); 
    if (x.type === "password") {
        x.type = "text";
        icon.className = "bx bx-show";
    } else {
        icon.className = "bx bx-low-vision";
        x.type = "password";
    }
  }

  function showPassword1() {
    var x = document.getElementById("password1");
    const icon = document.getElementById("icon1"); 
    if (x.type === "password") {
        x.type = "text";
        icon.className = "bx bx-show";
    } else {
        icon.className = "bx bx-low-vision";
        x.type = "password";
    }
  }