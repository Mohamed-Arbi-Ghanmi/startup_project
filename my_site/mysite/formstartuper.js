function showError(inputId, message) {
  var errorElement = document.getElementById(inputId + "-error");
  if (errorElement) {
    errorElement.textContent = message;
    errorElement.style.display = "inline"; // Ajout de cette ligne pour afficher le message d'erreur
  }
}

function clearError(inputId) {
  var errorElement = document.getElementById(inputId + "-error");
  if (errorElement) {
    errorElement.textContent = "";
    errorElement.style.display = "none"; // Ajout de cette ligne pour masquer le message d'erreur
  }
}


function validateNom() {
  var nom = document.forms["inscription"]["nom"].value.trim();
  var lettersWithSpace = /^[A-Za-z\s]+$/;
  if (nom === "" || !nom.match(lettersWithSpace)) {
    showError("nom", "Veuillez saisir votre nom avec des lettres uniquement.");
    return false;
  } else {
    clearError("nom");
    return true;
  }
}

function validatePrenom() {
  var prenom = document.forms["inscription"]["prenom"].value.trim();
  var lettersWithSpace = /^[A-Za-z\s]+$/;
  if (prenom === "" || !prenom.match(lettersWithSpace)) {
    showError("prenom", "Veuillez saisir votre prénom avec des lettres uniquement.");
    return false;
  } else {
    clearError("prenom");
    return true;
  }
}

function validateCIN() {
  var cin = document.forms["inscription"]["cin"].value.trim();
  var cinRegex = /^\d{8}$/;
  if (!cin.match(cinRegex)) {
    showError("cin", "Le numéro CIN doit être composé de 8 chiffres.");
    return false;
  } else {
    clearError("cin");
    return true;
  }
}

function validateEmail() {
  var email = document.forms["inscription"]["email"].value.trim();
  if (!email.includes("@")) {
    showError("email", "L'email doit être valide.");
    return false;
  } else {
    clearError("email");
    return true;
  }
}

function validateRC() {
  var rc = document.forms["inscription"]["rc"].value.trim();
  var rcRegex = /^[A-Z]\d{10}$/;
  if (!rc.match(rcRegex)) {
    showError("rc", "Le numéro de registre de commerce doit commencer par une lettre majuscule suivie de 10 chiffres.");
    return false;
  } else {
    clearError("rc");
    return true;
  }
}

function validatePassword() {
  var password = document.forms["inscription"]["password"].value.trim();
  var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}[#$]$/;
  if (!password.match(passwordRegex)) {
    showError("password", "Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre et un chiffre, et doit se terminer par le symbole $ ou #.");
    return false;
  } else {
    clearError("password");
    return true;
  }
}

function validateForm() {
  return validateNom() && validatePrenom() && validateCIN() && validateEmail() && validateRC() && validatePassword();
}
