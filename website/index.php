<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Bot Web App</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Telegram WebApp API -->
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body class="bg-gray-50 font-[Poppins]">
    <!-- Header -->
    <header class="bg-blue-600 text-white py-6">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-center">
                <i class="fab fa-telegram"></i> Telegram Bot Web App
            </h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Features Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-center">Features</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 text-3xl mb-4">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Interactive Bot</h3>
                    <p class="text-gray-600">
                        Engage with our intelligent bot that responds to your commands and messages.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 text-3xl mb-4">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Web Integration</h3>
                    <p class="text-gray-600">
                        Seamlessly integrated web application accessible directly from Telegram.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 text-3xl mb-4">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Mobile Friendly</h3>
                    <p class="text-gray-600">
                        Fully responsive design that works perfectly on all devices.
                    </p>
                </div>
            </div>
        </section>

        <!-- Instructions Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-center">How to Use</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <ol class="list-decimal list-inside space-y-4">
                    <li class="text-gray-700">
                        Start the bot by clicking the button below or searching for <span class="font-mono bg-gray-100 px-2 py-1 rounded">@YourBotName</span> in Telegram
                    </li>
                    <li class="text-gray-700">
                        Send the <span class="font-mono bg-gray-100 px-2 py-1 rounded">/start</span> command to get started
                    </li>
                    <li class="text-gray-700">
                        Use <span class="font-mono bg-gray-100 px-2 py-1 rounded">/help</span> to see all available commands
                    </li>
                    <li class="text-gray-700">
                        Access this web app anytime using the <span class="font-mono bg-gray-100 px-2 py-1 rounded">/webapp</span> command
                    </li>
                </ol>
            </div>
        </section>

        <!-- CTA Button -->
        <section class="text-center">
            <a href="https://t.me/YourBotUsername" 
               class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition-colors duration-300">
                <i class="fab fa-telegram mr-2"></i>
                Start Chat with Bot
            </a>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> Telegram Bot Web App. All rights reserved.</p>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="assets/js/app.js"></script>
</body>
</html>