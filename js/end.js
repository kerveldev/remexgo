function logout(_nick) {
    fetch('https://remex.parp.mx/api/logger/logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            nick: _nick
        })
    }).then((res) => res.json()).then((respApi) => {

        if (respApi.status == "TRUE")
        { location = "https://remex.parp.mx" }

        });

}