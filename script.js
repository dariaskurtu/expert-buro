// Модальное окно
function initModal() {
    const modal = document.getElementById('authModal');
    if (!modal) return;
    const closeBtn = document.getElementById('closeModal');
    if (closeBtn) closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    window.addEventListener('click', (e) => { if (e.target === modal) modal.classList.remove('active'); });
    const showRegister = document.getElementById('showRegister');
    const showLogin = document.getElementById('showLogin');
    if (showRegister) showRegister.addEventListener('click', () => {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'block';
    });
    if (showLogin) showLogin.addEventListener('click', () => {
        document.getElementById('loginForm').style.display = 'block';
        document.getElementById('registerForm').style.display = 'none';
    });
}

// Калькулятор стоимости
function initCalculator() {
    const calcBtn = document.getElementById('calcBtn');
    if (!calcBtn) return;
    calcBtn.addEventListener('click', async () => {
        const type = document.getElementById('expertiseType')?.value;
        const brand = document.getElementById('carBrand')?.value;
        const visit = document.getElementById('needVisit')?.value;
        if (!type) return;
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'calculate', type, brand, visit })
            });
            const data = await response.json();
            const resultDiv = document.getElementById('calcResult');
            if (resultDiv) resultDiv.innerHTML = `Примерная стоимость: от ${data.price} ₽`;
            const priceInput = document.getElementById('formPrice');
            if (priceInput) priceInput.value = data.price;
            const typeSelect = document.getElementById('expertiseType');
            const typeMap = { dtp: 'Оценка после ДТП', court: 'Судебная экспертиза', inheritance: 'Оценка для наследства', casco: 'Оценка для КАСКО/ОСАГО' };
            const formType = document.getElementById('formType');
            if (formType) formType.value = typeMap[type] || '';
        } catch(e) { console.error(e); }
    });
}

// Отправка заявки
function initApplicationForm() {
    const form = document.getElementById('applicationForm');
    if (!form) return;
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'create_application', ...data })
            });
            const result = await response.json();
            if (result.success) {
                alert('Заявка отправлена! Скоро с вами свяжутся.');
                form.reset();
                const resultDiv = document.getElementById('calcResult');
                if (resultDiv) resultDiv.innerHTML = '';
            } else {
                alert('Ошибка: ' + (result.error || 'Неизвестная ошибка'));
            }
        } catch(e) { alert('Ошибка отправки'); }
    });
}

function initMobileMenu() {
    const hamburger = document.getElementById('hamburgerBtn');
    const navLinks = document.getElementById('navLinks');
    if (hamburger && navLinks) hamburger.addEventListener('click', () => navLinks.classList.toggle('show'));
}

document.addEventListener('DOMContentLoaded', () => {
    initModal();
    initCalculator();
    initApplicationForm();
    initMobileMenu();
});