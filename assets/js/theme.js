/*!
  * domready (c) Dustin Diaz 2014 - License MIT
  */
!function (name, definition) {

  if (typeof module != 'undefined') module.exports = definition()
  else if (typeof define == 'function' && typeof define.amd == 'object') define(definition)
  else this[name] = definition()

}('domready', function () {

  var fns = [], listener
    , doc = typeof document === 'object' && document
    , hack = doc && doc.documentElement.doScroll
    , domContentLoaded = 'DOMContentLoaded'
    , loaded = doc && (hack ? /^loaded|^c/ : /^loaded|^i|^c/).test(doc.readyState)


  if (!loaded && doc)
  doc.addEventListener(domContentLoaded, listener = function () {
    doc.removeEventListener(domContentLoaded, listener)
    loaded = 1
    while (listener = fns.shift()) listener()
  })

  return function (fn) {
    loaded ? setTimeout(fn, 0) : fns.push(fn)
  }

});

domready(function () {

	// Check page

	if(document.getElementById('sites').length)
		return;

	const sites = document.querySelectorAll('#sites li');

	// List sites

	const list = ( group ) => {
		let list = document.querySelector('#sites');
		let order = 0;
		sites.forEach(el => {
			if(group == '' || el.getAttribute('data-group') == group) {
				el.setAttribute('style', '--order:'+order);
				list.appendChild(el);
				order++;
			}
		});
	}

	// Clear the list

	const clear = () => {
		document.querySelectorAll('#sites li').forEach(el => el.parentNode.removeChild(el));
	}

	// Active group

	const active = ( group ) => {
		document.querySelectorAll('#groups a').forEach(el => {
			el.classList.remove('active');
			if(el.innerText == group)
				el.classList.add('active');
		});
	}

	// Group menu

	document.querySelectorAll('#groups a').forEach(el => {
		el.addEventListener('click', function(e) {

			const group = e.target.innerText;
			
			// List all

			if(e.target.classList.contains('active')) {

				active('');
				clear();
				list('');

			// List group

			} else {

				active(group);
				clear();
				list(group);

			}

		});

	});

});