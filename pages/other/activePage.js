//const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('nav a');
const sectionEls = document.querySelectorAll('.section');

let currentSection = 'pricing';
window.addEventListener('scroll', () =>{
    sectionEls.forEach(sectionEl => {
        if(window.scrollY >= sectionEl.offsetTop){
            currentSection = sectionEl.id;
        }
    });

    navLinks.forEach(navLinks => {
        if(navLinks.href.includes(currentSection)){
            navLinks.classList.add('active');
        }
    });
});