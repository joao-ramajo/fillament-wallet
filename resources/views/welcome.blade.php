<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filament Wallet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Cor Primária Azul Suave */
        .bg-primary {
            background-color: #3B82F6;
        }

        .hover\:bg-primary-dark:hover {
            background-color: #2563EB;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center p-6">

        <header class="mb-10">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
                Filament Wallet
            </h1>
        </header>

        <a href="/admin/login"
            class="
                bg-primary
                text-white
                px-10
                py-4
                text-xl
                font-medium
                rounded-lg
                shadow-xl
                hover:bg-primary-dark
                transition
                duration-300
                transform hover:scale-105
           ">
            Acessar Sistema
        </a>

        <footer class="mt-20 text-sm text-gray-500">
            Seu gerenciador financeiro pessoal.
        </footer>
    </div>

</body>

</html>
