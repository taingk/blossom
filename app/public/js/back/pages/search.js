function search() {
    const sSearch = new FormData();
    sSearch.append('search', document.getElementById('search').value);
    
    fetch('/back/pages/search',{
        method: 'POST',
        body: sSearch
    })
    .then(
        (response) => {
            if (response.status !== 200) {
                console.log('Erreur, code : ' + response.status);
                return;
            }
            response.json().then((data) => {
                console.log(data);
            });
        }
    ).catch((err) => console.log('Fetch Error :-S', err));
}