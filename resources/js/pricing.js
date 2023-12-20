const buttons = document.querySelectorAll('.price-plan > button');

document.addEventListener('DOMContentLoaded', function() {
    initListeners();
});

function initListeners() {
    buttons.forEach(button => button.addEventListener('click', (e) => handlePricePlanSwitch(e)));
}

function handlePricePlanSwitch(e) {
    e.preventDefault();

    const button = e.target;
    const plan = button.dataset.plan;

    buttons.forEach(button => button.classList.remove('bg-blue-500', 'text-white'));
    button.classList.add('bg-blue-500', 'text-white');

    const h1s = document.querySelectorAll('h1[data-plan]');
    h1s.forEach(h1 => h1.classList.add('hidden'));

    console.log(plan);

    const h1 = document.querySelector(`h1[data-plan="${plan}"]`);
    h1.classList.remove('hidden');
}
