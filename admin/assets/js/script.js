document.querySelectorAll('.filtre').forEach(button => {

    button.addEventListener('click', function() {

        let idCategorie = this.dataset.id;

        fetch(
            'admin/src/php/ajax/filtrer_boissons.php?id_categorie='
            + idCategorie
        )
        .then(response => response.text())
        .then(data => {

            document.getElementById('listeBoissons').innerHTML = data;

        });

    });

});


setTimeout(function() {

    let success = document.getElementById('toastSuccess');
    let error = document.getElementById('toastError');

    if (success) {

        success.classList.remove('show');
        success.classList.add('hide');

    }

    if (error) {

        error.classList.remove('show');
        error.classList.add('hide');

    }

}, 2000);