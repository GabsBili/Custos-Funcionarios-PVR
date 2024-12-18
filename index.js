// Função para capitalizar a primeira letra de uma string
function FirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Função para manipular o evento onblur
function letra(event) {
    var input = event.target;
    input.value = FirstLetter(input.value);
}

document.getElementById("Formulario").onsubmit = function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
        }
    };
    xhr.send(formData);
}

