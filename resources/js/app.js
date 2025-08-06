import './bootstrap';
import '../css/app.css';

<<<<<<< Updated upstream
// humburger

const hamburger = document.querySelector('#hamburger');
const navMenu = document.querySelector('#nav-menu');

hamburger.addEventListener('click', function() {
    hamburger.classList.toggle('hamburger-active');
    navMenu.classList.toggle('hidden');
});


=======
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
>>>>>>> Stashed changes
