document.addEventListener('DOMContentLoaded', () => {
    const card = document.querySelector('[data-swipe-card]');
    const forms = document.querySelectorAll('[data-swipe-form]');

    forms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!card || form.dataset.submitting === 'true') {
                return;
            }

            event.preventDefault();
            form.dataset.submitting = 'true';

            const direction = form.dataset.swipeForm;
            card.classList.add(direction === 'like' ? 'swipe-out-like' : 'swipe-out-pass');

            window.setTimeout(() => form.submit(), 420);
        });
    });
});
