const card = document.querySelectorAll('.doctor-card');

console.log(card);

console.log('ini adalah konsultasi');

card.forEach(element => {
    element.addEventListener('click', function(e) {
        if(e.target.tagName.toLowerCase() !== 'a') {
            let modal = new bootstrap.Modal(document.getElementById('doctorInfoModal'));
            modal.show();
        }
    })
});