// Initialize Telegram WebApp
const telegram = window.Telegram.WebApp;

// Main initialization
document.addEventListener('DOMContentLoaded', () => {
    initializeTelegramWebApp();
    setupEventListeners();
    checkPlatform();
});

// Initialize Telegram WebApp features
function initializeTelegramWebApp() {
    try {
        // Expand the Web App to take up the full screen
        telegram.expand();

        // Enable closing confirmation if needed
        telegram.enableClosingConfirmation();

        // Set the header color if we're in Telegram
        if (telegram.headerColor) {
            document.querySelector('header').style.backgroundColor = telegram.headerColor;
        }

        // Apply Telegram theme colors if available
        applyTelegramTheme();

        // Show main content after initialization
        document.body.style.visibility = 'visible';

    } catch (error) {
        console.error('Error initializing Telegram WebApp:', error);
    }
}

// Apply Telegram theme colors to elements
function applyTelegramTheme() {
    if (telegram.colorScheme) {
        document.body.classList.add(`theme-${telegram.colorScheme}`);
    }

    // Add the telegram-webapp class to body when opened in Telegram
    if (telegram.platform !== 'unknown') {
        document.body.classList.add('telegram-webapp');
    }
}

// Setup event listeners for interactive elements
function setupEventListeners() {
    // Feature cards hover effect
    document.querySelectorAll('.card-hover').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.classList.add('shadow-lg');
        });
        card.addEventListener('mouseleave', () => {
            card.classList.remove('shadow-lg');
        });
    });

    // Custom button click effects
    document.querySelectorAll('.custom-button').forEach(button => {
        button.addEventListener('click', createRippleEffect);
    });

    // Handle back button if shown in Telegram
    if (telegram.BackButton) {
        telegram.BackButton.onClick(() => {
            // Handle back button click
            history.back();
        });
    }
}

// Create ripple effect for buttons
function createRippleEffect(event) {
    const button = event.currentTarget;
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;
    
    ripple.style.left = `${x}px`;
    ripple.style.top = `${y}px`;
    ripple.classList.add('ripple');
    
    button.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

// Check platform and adjust UI accordingly
function checkPlatform() {
    const platform = telegram.platform || 'web';
    document.body.setAttribute('data-platform', platform);

    // Adjust UI based on platform
    if (platform !== 'web') {
        // Hide elements that shouldn't be shown in Telegram
        document.querySelectorAll('.web-only').forEach(el => {
            el.style.display = 'none';
        });
    }
}

// Handle main button if needed
if (telegram.MainButton) {
    telegram.MainButton.setText('Close Web App');
    telegram.MainButton.onClick(() => {
        telegram.close();
    });
}

// Example function to send data back to Telegram bot
function sendDataToBot(data) {
    try {
        telegram.sendData(JSON.stringify(data));
    } catch (error) {
        console.error('Error sending data to bot:', error);
    }
}

// Example function to show popup alert
function showAlert(message) {
    if (telegram.showPopup) {
        telegram.showPopup({
            title: 'Alert',
            message: message,
            buttons: [{text: 'OK'}]
        });
    } else {
        alert(message);
    }
}

// Handle visibility changes
document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') {
        // Refresh data or update UI when app becomes visible
        console.log('Web App became visible');
    }
});

// Handle viewport changes
window.addEventListener('resize', () => {
    // Update UI elements if needed when viewport changes
    console.log('Viewport changed');
});

// Example error handler
window.onerror = function(msg, url, lineNo, columnNo, error) {
    console.error('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
    return false;
};