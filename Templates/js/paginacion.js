
function siguiente() {
	var parametros = window.location.search;
    if (parametros.indexOf('page=') == 1) {
		var page = parseInt(parametros.substring(6));
		page = page + 1;
		var res = window.location.pathname + '?page=' + page.toString();
		location.replace(res);
    } else{
		var res = location.pathname + '?page=1';
		location.replace(res);
	}
}

function previo() {
	var parametros = location.search;
    if (parametros.indexOf('page=') == 1) {
		var page = parseInt(parametros.substring(6));
		if (page > 1){
			page = page - 1;
			var res = window.location.pathname + '?page=' + page.toString();
			location.replace(res);
		}
    }else{
		var res = window.location.pathname + '?page=1';
		location.replace(res);
	}
}
