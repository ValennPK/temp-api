import './bootstrap';

const eyeIcon = `
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8Zm-8 4.5A4.5 4.5 0 1 1 8 3.5a4.5 4.5 0 0 1 0 9Z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z"/>
</svg>
`;

const eyeSlashIcon = `
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
  <path d="M13.359 11.238 15 12.88l-.707.707-1.708-1.708A9.32 9.32 0 0 1 8 13.5C3 13.5 0 8 0 8a15.42 15.42 0 0 1 3.348-3.885L1 1.768 1.707 1.06l12.652 12.651-.707.707-1.293-1.293ZM11.297 9.176 6.824 4.703A3 3 0 0 1 11.297 9.176Zm-1.06 1.06A3 3 0 0 1 5.764 5.764l-.77-.77A4 4 0 0 0 10.99 10.99l-.753-.753Z"/>
  <path d="M8 2.5c5 0 8 5.5 8 5.5a15.692 15.692 0 0 1-2.232 2.928l-.714-.714A14.19 14.19 0 0 0 14.807 8c-.78-1.141-3.09-4.5-6.807-4.5-1.211 0-2.31.357-3.294.899l-.758-.758A8.656 8.656 0 0 1 8 2.5Z"/>
</svg>
`;

function enhancePasswordInput(input) {
    if (!input || input.dataset.passwordToggleReady === '1') {
        return;
    }

    const parent = input.parentElement;
    if (!parent) {
        return;
    }

    input.dataset.passwordToggleReady = '1';
    input.classList.add('pe-5');

    const wrapper = document.createElement('div');
    wrapper.className = 'position-relative';

    parent.insertBefore(wrapper, input);
    wrapper.appendChild(input);

    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'btn btn-link text-secondary p-0 border-0';
    button.style.position = 'absolute';
    button.style.right = '0.75rem';
    button.style.top = '50%';
    button.style.transform = 'translateY(-50%)';
    button.style.lineHeight = '1';
    button.style.zIndex = '5';
    button.innerHTML = eyeIcon;
    button.setAttribute('aria-label', 'Mostrar contrasena');
    button.setAttribute('title', 'Mostrar/Ocultar contrasena');

    button.addEventListener('click', () => {
        const showPassword = input.type === 'password';
        input.type = showPassword ? 'text' : 'password';
        button.innerHTML = showPassword ? eyeSlashIcon : eyeIcon;
        button.setAttribute('aria-label', showPassword ? 'Ocultar contrasena' : 'Mostrar contrasena');
    });

    wrapper.appendChild(button);
}

function initPasswordToggles() {
    document
        .querySelectorAll('input[type="password"]')
        .forEach((input) => enhancePasswordInput(input));
}

function observePasswordInputs() {
    const observer = new MutationObserver(() => {
        initPasswordToggles();
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initPasswordToggles();
    observePasswordInputs();
});
