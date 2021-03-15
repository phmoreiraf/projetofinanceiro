//document.getElementById("nome").placeholder = "Seu nome";
//document.getElementById("endereco").placeholder = "Ex.Avenida/Rua A";
//document.getElementById("cep").placeholder = "32090-700";
//document.getElementById("telefone").placeholder = "(00) 00000-0000";
//document.getElementById("email").placeholder = "EX: email@email.com";
//document.getElementById("cpf").placeholder = "000.000.000.00";
//document.getElementById("data").placeholder = "12/11/2020";


function mascara_telefone() {

    var tel_formatado = document.getElementById("telefone").value
    if (tel_formatado[0] != "(") {
        if (tel_formatado[0] != undefined) {
            document.getElementById("telefone").value = "(" + tel_formatado[0];
        }
    }

    if (tel_formatado[3] != ")") {

        if (tel_formatado[3] != undefined) {
            document.getElementById("telefone").value = tel_formatado.slice(0, 3) + ")" + tel_formatado[3]
        }
    }

    if (tel_formatado[9] != "-") {
        if (tel_formatado[9] != undefined) {
            document.getElementById("telefone").value = tel_formatado.slice(0, 9) + "-" + tel_formatado[9]
        }
    }
}


function mascara_cep() {

    var cep_formatado = document.getElementById("cep").value
    if (cep_formatado[5] != "-") {
        if (cep_formatado[5] != undefined) {
            document.getElementById("cep").value = cep_formatado.slice(0, 5) + "-" + cep_formatado[5];
        }
    }
}

function mascara_cpf() {

    var cpf_formatado = document.getElementById("cpf").value
    if (cpf_formatado[3] != ".") {
        if (cpf_formatado[3] != undefined) {
            document.getElementById("cpf").value = cpf_formatado.slice(0, 3) + "." + cpf_formatado[3];
        }
    }

    if (cpf_formatado[7] != ".") {

        if (cpf_formatado[7] != undefined) {
            document.getElementById("cpf").value = cpf_formatado.slice(0, 7) + "." + cpf_formatado[7]
        }
    }

    if (cpf_formatado[11] != "-") {
        if (cpf_formatado[11] != undefined) {
            document.getElementById("cpf").value = cpf_formatado.slice(0, 11) + "-" + cpf_formatado[11]
        }
    }
}

function mascara_data() {

    var data_formatado = document.getElementById("data").value
    if (data_formatado[3] != "/") {
        if (data_formatado[3] != undefined) {
            document.getElementById("data").value = data_formatado.slide(0, 3) + "/" + data_formatado[3];
        }
    }

    if (data_formatado[7] != "/") {

        if (data_formatado[7] != undefined) {
            document.getElementById("data").value = data_formatado.slice(0, 7) + "/" + data_formatado[7]
        }
    }
}