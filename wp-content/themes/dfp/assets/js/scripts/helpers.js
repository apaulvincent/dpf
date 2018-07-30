export const debounce = (func, wait, immediate) => {
	var timeout;
	return function() {

		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};

		var callNow = immediate && !timeout;

		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

export const getUrlParameter = (sParam) => {
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	var arr = [];
	for (var i = 0; i < sURLVariables.length; i++)
	{
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == sParam)
		{
			arr.push(sParameterName[1]);
		}
	}
	return arr;
}


export const isMobile = () => {
	if(window.innerWidth <= 800 && window.innerHeight <= 600) {
	return true;
	} else {
	return false;
	}
}

