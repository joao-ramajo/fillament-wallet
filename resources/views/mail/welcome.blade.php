<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Filament Wallet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #0A0A0A;
            color: #FFFFFF;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #0A0A0A;
        }

        .header {
            padding: 40px 20px;
            text-align: left;
            position: relative;
            overflow: hidden;
        }

        .decorative-shape {
            position: absolute;
            background-color: #A4FF00;
            opacity: 0.2;
            transform: rotate(-15deg);
        }

        .shape-1 {
            width: 150px;
            height: 150px;
            top: -50px;
            right: -30px;
        }

        .shape-2 {
            width: 100px;
            height: 100px;
            background-color: #00FFD9;
            bottom: -30px;
            left: -20px;
            transform: rotate(25deg);
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 10;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background-color: #A4FF00;
            border: 2px solid #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 24px;
            color: #0A0A0A;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .content {
            padding: 20px;
            position: relative;
        }

        .hero-section {
            background-color: #1A1A1A;
            border: 3px solid #FFFFFF;
            padding: 40px 30px;
            margin-bottom: 30px;
            position: relative;
        }

        .badge {
            display: inline-block;
            background-color: #A4FF00;
            color: #0A0A0A;
            padding: 6px 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 32px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .hero-title .highlight {
            color: #A4FF00;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #CCCCCC;
        }

        .greeting strong {
            color: #FFFFFF;
            font-weight: 700;
        }

        .description {
            font-size: 16px;
            color: #AAAAAA;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .cta-button {
            display: inline-block;
            background-color: #A4FF00;
            color: #0A0A0A;
            padding: 16px 40px;
            text-decoration: none;
            font-weight: 900;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: 2px solid #0A0A0A;
            transition: all 0.2s ease;
        }

        .cta-button:hover {
            background-color: #FFFFFF;
            border-color: #A4FF00;
        }

        .features {
            margin: 30px 0;
        }

        .feature-item {
            background-color: #1A1A1A;
            border-left: 4px solid #00FFD9;
            padding: 20px;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 8px;
            color: #00FFD9;
            letter-spacing: 1px;
        }

        .feature-description {
            font-size: 14px;
            color: #AAAAAA;
            line-height: 1.6;
        }

        .footer {
            padding: 30px 20px;
            text-align: center;
            border-top: 2px solid #1A1A1A;
            margin-top: 40px;
        }

        .footer-text {
            font-size: 12px;
            color: #666666;
            line-height: 1.8;
        }

        .footer-links {
            margin-top: 20px;
        }

        .footer-link {
            color: #A4FF00;
            text-decoration: none;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0 10px;
        }

        .social-icons {
            margin-top: 20px;
        }

        /* Responsivo */
        @media only screen and (max-width: 600px) {
            .hero-title {
                font-size: 24px;
            }

            .hero-section {
                padding: 30px 20px;
            }

            .cta-button {
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="decorative-shape shape-1"></div>
            <div class="decorative-shape shape-2"></div>

            <div class="logo">
                <div class="logo-icon">W</div>
                <div class="logo-text">Filament Wallet</div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="hero-section">
                <div class="badge">Bem-vindo</div>

                <h1 class="hero-title">
                    Controle <span class="highlight">financeiro</span><br>
                    sem complicação
                </h1>

                <p class="greeting">
                    Olá, <strong>{{ $name }}</strong>! 👋
                </p>

                <p class="description">
                    É um prazer ter você conosco! O Filament Wallet é um gerenciador de contas
                    que ajuda você a acompanhar pagamentos, recebimentos e controlar seu saldo
                    de forma clara e eficiente.
                </p>

                <a href="{{ $link }}" class="cta-button">
                    Começar agora →
                </a>
            </div>

            <!-- Features -->
            <div class="features">
                <div class="feature-item">
                    <div class="feature-title">📊 Visualize seu saldo</div>
                    <div class="feature-description">
                        Acompanhe em tempo real seus recebimentos, gastos e saldo final com uma interface clara e
                        intuitiva.
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-title">💰 Registre transações</div>
                    <div class="feature-description">
                        Adicione suas transações facilmente e visualize o impacto real de cada movimento financeiro.
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-title">🎯 Controle total</div>
                    <div class="feature-description">
                        Tenha o controle completo das suas finanças pessoais em um só lugar, sem complicação.
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">
                Este email foi enviado para você porque criou uma conta no Filament Wallet.<br>
                Se você não reconhece esta ação, pode ignorar este email.
            </p>

            <div class="footer-links">
                <a href="#" class="footer-link">Ajuda</a>
                <a href="#" class="footer-link">Recursos</a>
                <a href="#" class="footer-link">Contato</a>
            </div>

            <p class="footer-text" style="margin-top: 20px;">
                © 2026 Filament Wallet. Todos os direitos reservados.
            </p>
        </div>
    </div>
</body>

</html>
