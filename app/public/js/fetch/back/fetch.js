const btn = document.getElementById('add');

const dbData = new FormData();
dbData.append('search', 'iPhone');

btn.addEventListener('click', () => {
    fetch('/back/products/search', {
        method: 'POST',
        body: dbData
    })
    .then(
        function(response) {
            if (response.status !== 200) {
                console.log('Looks like there was a problem. Status Code: ' + response.status);
                return;
            }
            // Examine the text in the response
            response.json().then(function(data) {
                console.log(data);
            });
        }
    )
    .catch(function(err) {
        console.log('Fetch Error :-S', err);
    });
})
