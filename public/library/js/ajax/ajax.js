/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//Criando objeto ajax instanciando a classe XMLHttpRequest (específica para cada navegador)
try{
	//Criando objeto para IE 6 ou superior
	var ajax = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
	try{
		//Criando objeto IE inferior a 6
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}catch(E){
		ajax = false;
	}
}
if(!ajax && typeof XMLHttpRequest != 'undefined'){
	//Criando objeto para Firefox ou Chrome (...)
	ajax = new XMLHttpRequest;
}