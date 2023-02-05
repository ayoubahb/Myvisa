const form = document.getElementById('form');

form.addEventListener('submit', async (event) => {
	event.preventDefault();

	const formData = new FormData(form);
	const data = {};

	formData.forEach((value, key) => {
		data[key] = value;
	});

	try {
		const response = await fetch('http://localhost/myvisa/dossier/create', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify(data),
		});

		if (!response.ok) {
			throw new Error('Request failed');
		}

		const result = await response.json();

		console.log(result);
	} catch (error) {
		console.error(error);
	}
});
