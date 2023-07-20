window.onload = () => {
    const choreForm = document.getElementById('choreForm');
    const timingInput = document.getElementById('choreTime');
    const timingError = document.getElementById('timing-error');

    choreForm.onsubmit = (event) => {
        event.preventDefault(); // Prevent form submission by default

        const timingValue = timingInput.value.trim();
        const validTiming = /^([01]\d|2[0-3]):([0-5]\d)$/.test(timingValue);

        if (validTiming) {
            timingError.textContent = ''; // Clear error message
            timingInput.classList.add('is-valid');
            timingInput.classList.remove('is-invalid');

            // If the timing is valid, submit the form
            choreForm.submit();
        } else {
            timingError.textContent = 'Please enter a valid time in the format hh:mm.';
            timingInput.classList.add('is-invalid');
            timingInput.classList.remove('is-valid');
        }
    };

};