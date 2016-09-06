/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global ajax */

// function escolheCurso(curso) {
// 	ajax.open("get","curso.php?curso="+escape(curso));
// 	//Propriedades utilizadas somente quando o método de envio for POST
// 	//-----------------------------------------------------------------
// 	ajax.onreadystatechange = function(){
// 		if(ajax.readyState == 4 && ajax.status == 200){
			
// 			document.getElementById('categoria-lateral').innerHTML  = ajax.responseText;	
			

			
// 		}
// 	}
// 	ajax.send();
// 	document.getElementById('tit').innerHTML = 'Matéria';

// }


/*
function modelo(){
	var login = document.getElementById("login").value;
	var pass = document.getElementById("pass").value;

	var params = "login="+login+"&pass="+pass;
	
	ajax.open("POST", "autentica.php")
	//Propriedades utilizadas somente quando o método de envio for POST
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.setRequestHeader("encoding", "ISO-8859-1");
	ajax.setRequestHeader("Content-length", params.length);
	ajax.setRequestHeader("Connection", "close");
	//-----------------------------------------------------------------
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4 && ajax.status == 200){
			

			

			//1 ou 0
			var result = ajax.responseText;
			if(result == "1"){
				document.getElementById("complemento").innerHTML = result;
			}else{
				document.getElementById("complemento").innerHTML = result;
			}
			//document.getElementById("complemento").innerHTML = result;
			
		}
	}
	ajax.send(params);
}
*/
function escolheMateria(diretorio,curso,nomeMateria) {

	var params = '';
	params +='diretorio=' + escape(diretorio);
	params +='&curso=' + escape(curso);
	params +='&nomeMateria=' + escape(nomeMateria);

	ajax.open("POST","stream/")+params;
	//Propriedades utilizadas somente quando o método de envio for POST
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.setRequestHeader("encoding", "ISO-8859-1");
	ajax.setRequestHeader("Content-length", params.length);
	ajax.setRequestHeader("Connection", "close");
	//-----------------------------------------------------------------
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4 && ajax.status == 200){
			
			//alert(materia);
			document.getElementById('conteudo').innerHTML  = ajax.responseText;	
			
			
		}
	}
	ajax.send(params);
}
function retorna () {
	window.location.replace("index.php");
}


