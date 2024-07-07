function post(method, url, data = null) {
    return new Promise((res, rej) => {
        let req = new XMLHttpRequest();
        req.open(method, url);
        req.addEventListener("readystatechange", e => {
            if(req.readyState == XMLHttpRequest.DONE) {
                let value = JSON.parse(req.responseText);
                if(req.status == 200) res(value);
                else rej(value);
            }
        })
        if(data != null) {
            req.send(data);
        } else {
            req.send();
        }
    })
}