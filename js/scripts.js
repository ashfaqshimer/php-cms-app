// Setup delete confirmation for delete
const deleteBtn = document.querySelector('.deleteBtn');
const publishBtn = document.querySelector('.publishBtn');

if (deleteBtn) {
	deleteBtn.addEventListener('click', e => {
		e.preventDefault();
		console.log('this is loaded');
		if (confirm('Are you sure?')) {
			const deleteForm = document.createElement('form');

			deleteForm.setAttribute('method', 'post');
			deleteForm.setAttribute('action', e.target.href);
			document.body.append(deleteForm);
			deleteForm.submit();
		}
	});
}

// Validations using jqueryValidator
$.validator.addMethod(
	'dateTime',
	(value, element) => {
		return value === '' || !isNaN(Date.parse(value));
	},
	'Must be a valid date and time.'
);

$('#formArticle').validate({
	rules: {
		title: {
			required: true
		},
		content: {
			required: true
		},
		published_at: {
			dateTime: true
		}
	}
});

// Publish the article
if (publishBtn) {
	publishBtn.addEventListener('click', e => {
		const id = publishBtn.dataset.id;
		const url = '/admin/publish-article.php';

		$.ajax({
			url,
			type: 'POST',
			data: { id }
		})
			.done(data => {
				const parent = publishBtn.parentElement;
				parent.innerHTML = data;
			})
			.fail(data => alert('An error occured'));
	});
}

// Datetime picker
$('#published_at').datetimepicker({
	format: 'Y-m-d H:i:s'
});

// Validate contact form
$('#contactForm').validate({
	rules: {
		email: {
			required: true,
			email: true
		},
		subject: {
			required: true
		},
		message: {
			required: true
		}
	}
});
