// Get the modals
let vorlagen = document.getElementById('vorlagen');
let buchung = document.getElementById('buchung');
let auswertung = document.getElementById('auswertung');
let change = document.getElementById('change');

// When the user clicks anywhere outside the modals, close it
window.onclick = function(event) {
    if (event.target === vorlagen) {
        vorlagen.style.display = "none";
    }
    if (event.target === buchung) {
        buchung.style.display = "none";
    }
    if (event.target === auswertung) {
        auswertung.style.display = "none";
    }
    if (event.target === change) {
        change.style.display = "none";
    }
}