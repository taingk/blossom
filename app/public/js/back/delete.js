function updateStatus( sId ) {
    const aSelectedMenu = document.URL.split('/');
    const sViews = aSelectedMenu[aSelectedMenu.indexOf('back') + 1];
    const aId = sId.split('-');

    fetch(`/back/${sViews}/delete?id=${aId[1]}`)
        .then(
            (response) => {
                if (response.status !== 200) {
                    console.log('Erreur, code : ' + response.status);
                    return;
                }
                response.json().then((data) => {
                    console.log(data);
                    location.reload();
                });
            }
        ).catch((err) => console.log('Fetch Error :-S', err));
}