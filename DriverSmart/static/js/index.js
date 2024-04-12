function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("contractTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        var td1 = tr[i].getElementsByTagName("td")[0];
        var td2 = tr[i].getElementsByTagName("td")[1];
        if (td1 || td2) {
            var txtValue1 = td1.textContent || td1.innerText;
            var txtValue2 = td2.textContent || td2.innerText;
            if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
function validatePassword() {
    var password = document.getElementById("password").value;

    // Controleer of het wachtwoord minstens 8 karakters lang is
    if (password.length < 8) {
        alert("Wachtwoord moet minimaal 8 karakters lang zijn.");
        return false;
    }

    // Controleer of het wachtwoord minstens 1 hoofdletter bevat
    if (!/[A-Z]/.test(password)) {
        alert("Wachtwoord moet minstens 1 hoofdletter bevatten.");
        return false;
    }

    // Controleer of het wachtwoord minstens 1 kleine letter bevat
    if (!/[a-z]/.test(password)) {
        alert("Wachtwoord moet minstens 1 kleine letter bevatten.");
        return false;
    }

    // Controleer of het wachtwoord minstens 1 speciaal karakter bevat
    if (!/[\W_]/.test(password)) {
        alert("Wachtwoord moet minstens 1 speciaal karakter bevatten.");
        return false;
    }

    return true;
}