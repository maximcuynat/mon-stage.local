document.addEventListener('DOMContentLoaded', function () {
    // Validation des formulaires
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });

    // Gestion des filtres de tables
    const tableSearchInput = document.getElementById('table-search');
    if (tableSearchInput) {
        tableSearchInput.addEventListener('keyup', function () {
            const searchText = this.value.toLowerCase();
            const table = document.querySelector('table');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    }
});