// Navbar scroll effect
window.addEventListener('scroll', () => {
    document.querySelector('.navbar').style.background = 
        window.scrollY > 50 ? 'rgba(0, 0, 0, 0.95)' : 'rgba(0, 0, 0, 0.8)';
});

 // Menu button click
document.querySelector('.menu-btn').addEventListener('click', e => {
    e.preventDefault();
    console.log('View Our Menu clicked');
});