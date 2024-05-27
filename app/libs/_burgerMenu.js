export function burgerMenu() {
  const menuBtn = document.querySelector('.menu__btn');
  const menuBody = document.querySelector('.menu__body');

  if (menuBtn) {
    menuBtn.addEventListener("click", function (e) {
      menuBody.classList.toggle('--active');
      menuBtn.classList.toggle('--active');
    });
    menuBody.addEventListener("click", function (e) {
      menuBody.classList.remove('--active');
      menuBtn.classList.remove('--active');
    });
  }

  const menuLinks = document.querySelectorAll('.go-to[data-goto]');
  if (menuLinks.length > 0) {
    menuLinks.forEach(menuLink => {
      menuLink.addEventListener("click", onMenuLinkClick);
    });

    function onMenuLinkClick(e) {
      const menuLink = e.target;
      if (menuLink.dataset.goto && document.querySelector(menuLink.dataset.goto)) {
        const gotoBlock = document.querySelector(menuLink.dataset.goto);
        const gotoBlockValue = gotoBlock.getBoundingClientRect().top + pageYOffset - document.querySelector('header').offsetHeight;

        if (menuBtn.classList.contains('--active')) {
          menuBody.classList.remove('--active');
          menuBtn.classList.remove('--active');
        }

        window.scrollTo({
          top: gotoBlockValue,
          behavior: "smooth"
        });
        e.preventDefault();
      }
    }
  }

  // Добавление класса при скролле
  let scrollpos = window.scrollY

  const headerFixed = document.querySelector(".header")
  const btnTop = document.querySelector(".floating-top")
  const scrollChange = 20
  const scrollChangeBtn = 450

  const add_class_on_scroll = () => headerFixed.classList.add("--fixed")
  const remove_class_on_scroll = () => headerFixed.classList.remove("--fixed")

  const add_class_on_scrollBtn = () => btnTop.classList.add("--visible")
  const remove_class_on_scrollBtn = () => btnTop.classList.remove("--visible")

  window.addEventListener('scroll', function () {
    scrollpos = window.scrollY;

    if (scrollpos >= scrollChange) { add_class_on_scroll() }
    else { remove_class_on_scroll() }

  })

  window.addEventListener('scroll', function () {
    scrollpos = window.scrollY;

    if (scrollpos >= scrollChangeBtn) { add_class_on_scrollBtn() }
    else { remove_class_on_scrollBtn() }

  })
}