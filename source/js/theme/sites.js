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