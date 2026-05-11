# 💰 Fillament Wallet

> Um gerenciador de gastos pessoais simples, eficiente e sem complicações

[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

[🔗 Ver Demo ao Vivo](https://fillament-wallet.salgadinhos-web.blog)

---

## 📖 Sobre o Projeto

**Fillament Wallet** é um gerenciador de gastos pessoais que nasceu da necessidade de ter uma ferramenta **gratuita, simples e confiável** para controle financeiro. Diferente de outros aplicativos disponíveis no mercado, este projeto foca em:

- ✅ **Simplicidade** - Interface limpa sem funcionalidades desnecessárias
- ✅ **Confiabilidade** - Seus dados sob seu controle
- ✅ **Experiência focada** - Sem distrações, apenas o essencial para manter suas finanças em dia

### 🎯 Problema Resolvido

Centraliza o controle de saldo e gerencia expectativas financeiras de forma clara, ajudando você a visualizar rapidamente o impacto de cada despesa ou receita no seu orçamento.

### 💡 Por que outro gerenciador de gastos?

A maioria dos aplicativos de controle financeiro sofrem de:
- Interfaces excessivamente complicadas
- Questões de segurança e privacidade duvidosas
- Recursos "empurrados" que prejudicam a experiência
- Complexidade que desmotiva o uso contínuo

**Fillament Wallet** foi criado para resolver esses problemas, oferecendo apenas o necessário para um controle financeiro efetivo.

---

## ✨ Principais Funcionalidades

| Funcionalidade | Descrição |
|----------------|-----------|
| 📝 **CRUD de Despesas** | Crie, edite, visualize e exclua suas transações financeiras |
| 📊 **Relatórios Gerais** | Visualize resumos e análises dos seus gastos |
| 📥 **Importação de Planilhas** | Importe seus dados de gastos via arquivo Excel/CSV |
| 📤 **Exportação de Dados** | Exporte seus registros para análise externa |
| 💵 **Controle de Saldo** | Acompanhe saldo atual e projeções futuras em tempo real |

---

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído com tecnologias modernas e confiáveis:

- **Laravel 13** - Framework PHP robusto e elegante
- **Vite 7** - Build e assets do backend
- **MySQL** - Banco de dados relacional via Docker
- **Laravel Sail** - Infraestrutura local em containers
- **Pest + PHPStan + Pint + Rector** - Testes, análise estática e padronização

### Arquitetura

- **Tipo**: API Laravel com assets via Vite
- **Padrão**: DDD Lite (Domain-Driven Design simplificado)
- **Stack**: Backend Laravel com frontend web separado no workspace

---

## 🚀 Como Começar

### Pré-requisitos

Antes de iniciar, certifique-se de ter instalado:

- [Docker](https://www.docker.com/get-started) (para Laravel Sail)
- [Composer](https://getcomposer.org/) (gerenciador de dependências PHP)
- [Node.js](https://nodejs.org/) (para instalar e compilar os assets)

### Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/seu-usuario/fillament-wallet.git
cd fillament-wallet/kado-backend
```

2. **Instale as dependências PHP**
```bash
composer install
```

3. **Suba a infraestrutura Docker**
```bash
./vendor/bin/sail up -d
```

4. **Configure o projeto**
```bash
composer setup
```

5. **Inicie o ambiente de desenvolvimento**
```bash
composer dev
```

6. **Acesse a aplicação**
```
http://127.0.0.1:8000
```

> `composer setup` instala dependências PHP/Node, cria `.env` se necessário, gera a `APP_KEY`, roda as migrations e compila os assets.

### Comandos Úteis

```bash
# Subir a infraestrutura Docker do backend
./vendor/bin/sail up -d

# Parar a infraestrutura Docker do backend
./vendor/bin/sail down

# Rodar backend, fila, logs e Vite em desenvolvimento
composer dev

# Executar testes
composer test

# Rodar verificações de qualidade
composer lint:all:check

# Aplicar correções automáticas de estilo/análise
composer lint:fix

# Acessar o container
./vendor/bin/sail shell
```

---

## 💡 Exemplo de Uso

### Caso de Uso Típico

1. **Cadastre uma despesa** (ex: "Compra no supermercado - R$ 150,00")
2. **Visualize o impacto** no seu saldo atual e saldo projetado
3. **Acompanhe** como suas entradas e saídas afetam seu orçamento
4. **Exporte** relatórios quando precisar analisar seus gastos em detalhe

A cada transação registrada, o sistema automaticamente atualiza:
- Saldo atual
- Saldo final projetado
- Relatórios e gráficos

---

## 🎨 Design

O projeto segue um estilo **neo-brutalista**, priorizando:
- Funcionalidade sobre ornamentação
- Contraste e legibilidade
- Elementos visuais diretos e honestos

---

## 🧪 Testes

O projeto conta com testes básicos para garantir a estabilidade das operações principais.

```bash
composer test
```

**Nota**: Como as operações são relativamente simples, a cobertura de testes é focada nos fluxos principais, sem necessidade de testes complexos.

---

## 📈 Status do Projeto

**Status Atual**: ✅ MVP em Produção

O projeto está deployado e funcionando em ambiente de produção (VPS), pronto para uso real.

### 🗺️ Roadmap

Funcionalidades planejadas para as próximas versões:

- [ ] Melhorar exportação de planilhas para melhor usabilidade
- [ ] Implementar envio de relatórios semanais via email
- [ ] Área de sugestões da comunidade
- [ ] Dashboard com gráficos interativos
- [ ] Categorização automática de gastos

---

## 🤝 Contribuições

Contribuições são bem-vindas! Este projeto aceita:

- 💡 **Sugestões de melhorias**
- 🐛 **Relatos de bugs**
- 📝 **Melhorias na documentação**

> **Em breve**: Uma área dedicada para sugestões da comunidade será implementada.

---

## 🔗 Links

- **Demo ao vivo**: [https://fillament-wallet.salgadinhos-web.blog](https://fillament-wallet.salgadinhos-web.blog)
- **Documentação do Laravel**: [https://laravel.com/docs](https://laravel.com/docs)
