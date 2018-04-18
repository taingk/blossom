const btn = document.getElementById('add');
// 'btn' : à remplacer par l'élément trigger

const sSearch = new FormData();
sSearch.append('search', 'iPhone');
// 'iPhone' : à remplacer par la valeur que l'utilisateur veut rechercher

// 'btn' : à remplacer par la variable en haut
btn.addEventListener('click', () => {
    // url : à remplacer par la bonne url action
    fetch('/back/products/search', {
        method: 'POST',
        body: sSearch
    })
    .then(
        function(response) {
            if (response.status !== 200) {
                console.log('Erreur, code : ' + response.status);
                return;
            }
            response.json().then(function(data) {
                console.log(data);
            });
        }
    )
    .catch(function(err) {
        console.log('Fetch Error :-S', err);
    });
})
