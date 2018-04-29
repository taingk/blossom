function update( sId ) {
    const aId = sId.split('-');

    fetch('/back/users/update?id=' + aId[1])
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
    )
    .catch((err) => console.log('Fetch Error :-S', err));
}