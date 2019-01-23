yii.confirm = function (message, okCallback) {
	Swal.fire({
		title             : 'Eliminar',
		text              : message,
		type              : 'warning',
		showCancelButton  : true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonClass: 'btn btn-success mr5',
		cancelButtonClass : 'btn btn-danger ml5',
		buttonsStyling    : false
	}).then((result) => {
  	if (result.value) {
	    okCallback();
	  }
	});
};
