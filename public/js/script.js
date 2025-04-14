function switchForm(formType) {
    const inscription = document.getElementById("form-inscription");
    const connexion = document.getElementById("form-connexion");
    if (formType === "login") {
        inscription.style.display = "none";
        connexion.style.display = "block";
    } else {
        inscription.style.display = "block";
        connexion.style.display = "none";
    }
}
