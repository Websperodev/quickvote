$('.modal').on('hidden.bs.modal', function(){
	$(this).find('form')[0].reset();
});
function validateUrl(url) {
	var p = /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
	return (url.match(p)) ? RegExp.$1 : false;
}
