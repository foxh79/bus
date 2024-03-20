
// account section js
document.addEventListener("DOMContentLoaded", function () {
  const asideSpans = document.querySelectorAll('.aside__span');
  const mainSections = document.querySelectorAll('.main');
  const viewOrderLinks = document.querySelectorAll('.my__orders a');

  // Function to remove 'active-aside__span' class from all spans
  const removeActiveClass = () => {
      asideSpans.forEach(s => s.classList.remove('active-aside__span'));
  };

  asideSpans.forEach((span, index) => {
      span.addEventListener('click', () => {
          removeActiveClass();
          span.classList.add('active-aside__span');
          mainSections.forEach(section => section.style.display = 'none');
          mainSections[index].style.display = 'block';
      });
  });

  viewOrderLinks.forEach(link => {
      link.addEventListener('click', (event) => {
          event.preventDefault();
          removeActiveClass();
          mainSections.forEach(section => section.style.display = 'none');
          const orderDetailsIndex = mainSections.length - 1; // Assuming order details is the last section
          mainSections[orderDetailsIndex].style.display = 'block';
      });
  });

  // Set default open section (Personal Information)
  const defaultSectionIndex = 0;
  asideSpans[defaultSectionIndex].classList.add('active-aside__span');
  mainSections.forEach((section, index) => {
      section.style.display = index === defaultSectionIndex ? 'block' : 'none';
  });
});





const openMenu = document.querySelector('.fa-bars');
const closeMenu = document.querySelector('.fa-times');
const menu = document.querySelector('ul');

openMenu.addEventListener('click', () => {
  menu.style.display = 'flex';
  openMenu.style.display = 'none';
  closeMenu.style.display = 'flex';
  
});

closeMenu.addEventListener('click', () => {
  menu.style.display = 'none';
  openMenu.style.display = 'flex';
  closeMenu.style.display = 'none';
  
});

//Shop aside javascript

const asideToggler = document.querySelector('.aside__toggler');
const aside = document.querySelector('.shop__aside');

asideToggler.addEventListener('click', () => {
  aside.classList.toggle('shop__aside-active');
});
;
/* 

const passcode_toggler = document.querySelectorAll('#passcode-toggler');
const passcode= document.querySelectorAll('.passcode');

passcode_toggler.addEventListener('click', () => {
  passcode.classList.toggle('passcode_active');
}); */