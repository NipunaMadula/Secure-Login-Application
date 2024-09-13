// Simple script to confirm the user clicked on a link
document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('a');
    
    links.forEach(link => {
        link.addEventListener('click', function (event) {
            let message = `You are about to go to ${event.target.textContent}. Proceed?`;
            if (!confirm(message)) {
                event.preventDefault(); // Stop the link if the user cancels
            }
        });
    });
});
