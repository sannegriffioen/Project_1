var idVar = setInterval(() => {
    timer();
}, 1000);
function timer() {
    var dateVar = new Date();
    var time = dateVar.toLocaleTimeString();
    document.getElementById("tijd").innerText = time;
}
