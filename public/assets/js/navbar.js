const searchNavbar = document.getElementById('search-navbar');

searchNavbar.addEventListener('keydown', function() {
    if (event.key === 'Enter') {
        console.log('Enter key pressed');
    }
});