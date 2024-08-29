function genarateResponse(){
    var text = document.getElementById("text")
    var response = document.getElementById("response")
    
    import fetch from "node-fetch"
    fetch("response.php",{
        method: "post",
        body: JSON.stringify({
            text: text.value
        }),
    })
        .then((res) =>res.text())
        .then((res) => {
            response.innerHTML = res;
        });
    
}
