yii.confirm = function (message, okCallback, cancelCallback) {
	swal({
		title             : 'Eliminar',
		text              : message,
		type              : 'warning',
		showCancelButton  : true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor : '#d33',
		//confirmButtonText : 'Yes, delete it!',
		//cancelButtonText  : 'No, cancel!',
		confirmButtonClass: 'btn btn-success',
		cancelButtonClass : 'btn btn-danger',
		buttonsStyling    : false
	}).then(okCallback, cancelCallback);
};