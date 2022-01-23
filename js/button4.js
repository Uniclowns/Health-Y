const buy = document.querySelector('.total');
const medics = document.querySelectorAll('.medic');
let total = 0;



function all(e) {
    if (!e.isTrusted) return;
    total++;
    buy.textContent = total;
}

medics.forEach(medic => medic.addEventListener('click', all));