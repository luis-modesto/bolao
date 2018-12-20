
function aceitarNotificacao(id){
	document.getElementById('notf'+id).value = 1;
	document.getElementById('btn-submeter').disabled = false;
	if (document.getElementById('li-'+id).classList.contains('bg-light')){
		document.getElementById('li-'+id).classList.remove('bg-light');
		document.getElementById('acc-'+id).classList.remove('bg-light');
		document.getElementById('rec-'+id).classList.remove('bg-light');
	} else if (document.getElementById('li-'+id).classList.contains('list-group-item-danger')){
		document.getElementById('li-'+id).classList.remove('list-group-item-danger');
		document.getElementById('acc-'+id).classList.remove('bg-danger');
		document.getElementById('rec-'+id).classList.remove('bg-danger');
	}
	document.getElementById('rec-'+id).style.backgroundColor = "transparent";
	document.getElementById('acc-'+id).style.backgroundColor = "transparent";
	document.getElementById('li-'+id).classList.add('list-group-item-success');
}

function rejeitarNotificacao(id){
	document.getElementById('notf'+id).value = 2;
	document.getElementById('btn-submeter').disabled = false;
	if (document.getElementById('li-'+id).classList.contains('bg-light')){
		document.getElementById('li-'+id).classList.remove('bg-light');
		document.getElementById('acc-'+id).classList.remove('bg-light');
		document.getElementById('rec-'+id).classList.remove('bg-light');
	} else if (document.getElementById('li-'+id).classList.contains('list-group-item-success')){
		document.getElementById('li-'+id).classList.remove('list-group-item-success');
		document.getElementById('acc-'+id).classList.remove('bg-success');
		document.getElementById('rec-'+id).classList.remove('bg-success');
	}
	document.getElementById('rec-'+id).style.backgroundColor = "transparent";
	document.getElementById('acc-'+id).style.backgroundColor = "transparent";
	document.getElementById('li-'+id).classList.add('list-group-item-danger');
}