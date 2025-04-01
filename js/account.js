document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const navItems = document.querySelectorAll('.account_nav_item');
    const sections = document.querySelectorAll('.account_section');

    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Get target section id
            const targetId = this.querySelector('a').getAttribute('href').substring(1);
            
            // Hide all sections
            sections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Show target section
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });

    // Logout functionality
    const logoutItem = document.querySelector('a[href="#logout"]');
    if (logoutItem) {
        logoutItem.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Create and show logout confirmation modal
            const modal = document.createElement('div');
            modal.className = 'logout_modal';
            modal.innerHTML = `
                <div class="logout_modal_content">
                    <h3>Wylogowanie</h3>
                    <p>Czy na pewno chcesz się wylogować?</p>
                    <div class="logout_modal_buttons">
                        <button class="cancel_logout">Anuluj</button>
                        <button class="confirm_logout">Wyloguj</button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Handle modal buttons
            modal.querySelector('.cancel_logout').addEventListener('click', () => {
                modal.remove();
            });
            
            modal.querySelector('.confirm_logout').addEventListener('click', () => {
                // Here you would typically make an API call to logout
                // For now, we'll just redirect to the login page
                window.location.href = 'index.html';
            });
        });
    }

    // Form submission handlers
    const profileForm = document.querySelector('.profile_details');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically make an API call to update profile
            alert('Zmiany zostały zapisane!');
        });
    }

    const settingsForm = document.querySelector('.settings_form');
    if (settingsForm) {
        settingsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically make an API call to update settings
            alert('Ustawienia zostały zapisane!');
        });
    }

    // Order details button handlers
    const orderDetailsButtons = document.querySelectorAll('.order_details');
    orderDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderNumber = this.closest('.order_item').querySelector('.order_number').textContent;
            // Here you would typically show order details in a modal or redirect to order details page
            alert(`Szczegóły zamówienia ${orderNumber} zostaną wyświetlone wkrótce.`);
        });
    });
}); 