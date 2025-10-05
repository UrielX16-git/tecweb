// Variables para rellenar rapido los campos
var nombreDefault = 'Uriel';
var num1Default = Math.floor(Math.random() * 10) + 1;
var num2Default = Math.floor(Math.random() * 10) + 1;
var num3Default = Math.floor(Math.random() * 10) + 1;

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

function ejemplo10() {}
function ejemplo11() {}
function ejemplo12() {}
function ejemplo13() {}
function ejemplo14() {}
function ejemplo15() {}
function ejemplo16() {}
function ejemplo17() {}
function ejemplo18() {}