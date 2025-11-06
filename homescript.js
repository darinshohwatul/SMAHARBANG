// Mobile Navigation
function showMenu() {
    document.getElementById('navLinks').style.right = '0';
}

function hideMenu() {
    document.getElementById('navLinks').style.right = '-100%';
}

// Sticky Header
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    header.classList.toggle('sticky', window.scrollY > 0);
});

// Close mobile menu when clicking on a link
const navLinks = document.querySelectorAll('.nav-links ul li a');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            hideMenu();
        }
    });
});

// Dropdown menu for mobile
const dropdowns = document.querySelectorAll('.dropdown > a');
dropdowns.forEach(dropdown => {
    dropdown.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            const dropdownContent = this.nextElementSibling;
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        }
    });
});