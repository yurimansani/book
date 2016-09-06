/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


!(function() {

  // Get any lib=___ param from the query string.
  var library = location.search.match(/[?&]lib=(.*?)(?=&|$)/);

  /* jshint -W060 */
  if (library) {
    document.write('<script src="../libs/' + library[1] + '"></script>');
  } else {
    document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>');
  }
}());
