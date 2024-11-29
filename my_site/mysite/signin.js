document.getElementById("toggleSignUp").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("signInForm").style.display = "none";
    document.getElementById("signUpForm").style.display = "block";
  });
  
  document.getElementById("toggleSignIn").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("signUpForm").style.display = "none";
    document.getElementById("signInForm").style.display = "block";
  });
  