// Variables para rellenar rapido los campos
var nombreDefault = 'Uriel';
var num1Default = Math.floor(Math.random() * 10) + 1;
var num2Default = Math.floor(Math.random() * 10) + 1;
var num3Default = Math.floor(Math.random() * 10) + 1;

function mostrarMensaje() {
    return "Cuidado<br>Ingresa tu documento correctamente<br>";
}

function mostrarRango(x1, x2) {
    var inicio;
    var resultado = "";
    for (inicio = x1; inicio <= x2; inicio++) {
        resultado += inicio + ' ';
    }
    return resultado;
}

function convertirCastellano(x) {
    if (x == 1)
        return "uno";
    else
    if (x == 2)
        return "dos";
    else
    if (x == 3)
        return "tres";
    else
    if (x == 4)
        return "cuatro";
    else
    if (x == 5)
        return "cinco";
    else
        return "valor incorrecto";
}

function convertirCastellanoSwitch(x) {
    switch (x) {
        case 1:
            return "uno";
        case 2:
            return "dos";
        case 3:
            return "tres";
        case 4:
            return "cuatro";
        case 5:
            return "cinco";
        default:
            return "valor incorrecto";
    }
}


function ejemplo1() {
    document.getElementById("resultado1").innerHTML = "Hola Mundo";
}

function ejemplo2() {
    var nombre = 'Juan';
    var edad = 10;
    var altura = 1.92;
    var casado = false;
    var resultado = "Nombre: " + nombre + "<br>" +
                    "Edad: " + edad + "<br>" +
                    "Altura: " + altura + "<br>" +
                    "Casado: " + casado;
    document.getElementById("resultado2").innerHTML = resultado;
}

function ejemplo3() {
    var nombre;
    var edad;
    nombre = prompt('Ingresa tu nombre:', nombreDefault);
    edad = prompt('Ingresa tu edad:', '18');
    document.getElementById("resultado3").innerHTML = 'Hola ' + nombre + ', así que tienes ' + edad + ' años';
}

function ejemplo4() {
    var valor1;
    var valor2;
    valor1 = prompt('Introducir primer número:', num1Default);
    valor2 = prompt('Introducir segundo número', num2Default);
    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);
    document.getElementById("resultado4").innerHTML = 'Numeros: ' + valor1 + ' y ' + valor2  + '<br>' + ' La suma es ' + suma + '<br>' + 'El producto es ' + producto;
}

function ejemplo5() {
    var nombre;
    var nota;
    nombre = prompt('Ingresa tu nombre:', nombreDefault);
    nota = prompt('Ingresa tu nota:', num3Default);
    if (nota >= 4) {
        document.getElementById("resultado5").innerHTML = nombre + ' esta aprobado con un ' + nota;
    } else {
        document.getElementById("resultado5").innerHTML = nombre + ' esta reprobado con un ' + nota;
    }
}

function ejemplo6() {
    var num1, num2;
    num1 = prompt('Ingresa el primer número:', num3Default);
    num2 = prompt('Ingresa el segundo número:', num1Default);
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    if (num1 > num2) {
        document.getElementById("resultado6").innerHTML = 'el mayor es ' + num1;
    } else {
        document.getElementById("resultado6").innerHTML = 'el mayor es ' + num2;
    }
}

function ejemplo7() {
    var nota1, nota2, nota3;
    nota1 = prompt('Ingresa 1ra. nota:', num1Default);
    nota2 = prompt('Ingresa 2da. nota:', num2Default);
    nota3 = prompt('Ingresa 3ra. nota:', num3Default);
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);
    var pro;
    pro = (nota1 + nota2 + nota3) / 3;
    if (pro >= 7) {
        document.getElementById("resultado7").innerHTML = 'aprobado';
    } else {
        if (pro >= 4) {
            document.getElementById("resultado7").innerHTML = 'regular';
        } else {
            document.getElementById("resultado7").innerHTML = 'reprobado';
        }
    }
}

function ejemplo8() {
    var valor;
    valor = prompt('Ingresar un valor comprendido entre 1 y 5:', 3);
    valor = parseInt(valor);
    switch (valor) {
        case 1:
            document.getElementById("resultado8").innerHTML = 'uno';
            break;
        case 2:
            document.getElementById("resultado8").innerHTML = 'dos';
            break;
        case 3:
            document.getElementById("resultado8").innerHTML = 'tres';
            break;
        case 4:
            document.getElementById("resultado8").innerHTML = 'cuatro';
            break;
        case 5:
            document.getElementById("resultado8").innerHTML = 'cinco';
            break;
        default:
            document.getElementById("resultado8").innerHTML = 'debe ingresar un valor comprendido entre 1 y 5.';
    }
}

function ejemplo9() {
    var col;
    col = prompt('Ingresa el color con que quieras pintar el fondo de la ventana (rojo, verde, azul)', 'azul');
    switch (col) {
        case 'rojo':
            document.body.style.backgroundColor = '#ff0000';
            break;
        case 'verde':
            document.body.style.backgroundColor = '#00ff00';
            break;
        case 'azul':
            document.body.style.backgroundColor = '#0000ff';
            break;
    }
}

function ejemplo10() {
    var x = 1;
    var resultado = "";
    while (x <= 100) {
        resultado += x + '<br>';
        x = x + 1;
    }
    document.getElementById("resultado10").innerHTML = resultado;
}

function ejemplo11() {
    var x = 1;
    var suma = 0;
    var valor;
    while (x <= 5) {
        valor = prompt('Ingresa el valor:', num3Default);
        valor = parseInt(valor);
        suma = suma + valor;
        x = x + 1;
    }
    document.getElementById("resultado11").innerHTML = "La suma de los valores es " + suma;
}

function ejemplo12() {
    var valor;
    var resultado = "";
    do {
        valor = prompt('Ingresa un valor entre 0 y 999:', '777');
        valor = parseInt(valor);
        resultado += 'El valor ' + valor + ' tiene ';
        if (valor < 10) {
            resultado += '1 dígito';
        } else if (valor < 100) {
            resultado += '2 dígitos';
        } else {
            resultado += '3 dígitos';
        }
        resultado += '<br>';
    } while (valor != 0);
    document.getElementById("resultado12").innerHTML = resultado;
}

function ejemplo13() {
    var f;
    var resultado = "";
    for (f = 1; f <= 10; f++) {
        resultado += f + " ";
    }
    document.getElementById("resultado13").innerHTML = resultado;
}

function ejemplo14() {
    var resultado = "";
    resultado += "Cuidado<br>";
    resultado += "Ingresa tu documento correctamente<br>";
    resultado += "Cuidado<br>";
    resultado += "Ingresa tu documento correctamente<br>";
    resultado += "Cuidado<br>";
    resultado += "Ingresa tu documento correctamente<br>";
    document.getElementById("resultado14").innerHTML = resultado;
}

function ejemplo15() {
    var resultado = "";
    resultado += mostrarMensaje();
    resultado += mostrarMensaje();
    resultado += mostrarMensaje();
    document.getElementById("resultado15").innerHTML = resultado;
}

function ejemplo16() {
    var valor1, valor2;
    valor1 = prompt('Ingresa el valor inferior:', '5');
    valor1 = parseInt(valor1);
    valor2 = prompt('Ingresa el valor superior:', '37');
    valor2 = parseInt(valor2);
    document.getElementById("resultado16").innerHTML = mostrarRango(valor1, valor2);
}

function ejemplo17() {
    var valor = prompt("Ingresa un valor entre 1 y 5", "4");
    valor = parseInt(valor);
    var r = convertirCastellano(valor);
    document.getElementById("resultado17").innerHTML = r;
}

function ejemplo18() {
    var valor = prompt("Ingresa un valor entre 1 y 5", "3");
    valor = parseInt(valor);
    var r = convertirCastellanoSwitch(valor);
    document.getElementById("resultado18").innerHTML = r;
}