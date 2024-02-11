document.addEventListener('DOMContentLoaded', () => {

	var commentModifierCopyClass = document.querySelectorAll('.commentModifierCopyClass');
	Array.prototype.forEach.call(commentModifierCopyClass, (el, i) => {
		el.addEventListener('click', commentModifierCopy);
	});

});

function commentModifierCopy(e) {
	e.preventDefault();
	var url = e.srcElement.href;
	navigator.clipboard.writeText(url);
}