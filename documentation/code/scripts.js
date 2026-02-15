const aside = document.querySelector('aside'),
  menuBtn = document.querySelector('[data-menu-btn]'),
  printBtn = document.querySelector('[data-print-btn]');

menuBtn.addEventListener('click', () => {
  aside.classList.toggle('open_nav');
});

printBtn.addEventListener('click', () => {
  window.print();
});
