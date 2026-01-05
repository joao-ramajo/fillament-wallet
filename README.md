# Filament Wallet
*Laravel 12, Filament 3, MySQL, Sail, Docker*

Um sistema de **gestão pessoal de finanças**, desenvolvido com **Laravel 12** e **Filament 3**, voltado para controle de **despesas, receitas e projeções financeiras**.
O objetivo é oferecer uma base sólida e escalável para evolução futura — incluindo carteiras, bancos e notificações de vencimento.

O painel foi inteiramente construído com o **Filament Admin**, permitindo um CRUD completo, dashboards com **estatísticas em tempo real** e visualização clara de saldos e valores projetados.

---

## 💻 Tecnologias Utilizadas

* Laravel 12
* PHP 8.3
* Filament v3
* Laravel Sail (Docker + MySQL)

---

## ✨ Funcionalidades

* Cadastro e autenticação de usuários
* Registro de **despesas (expenses)** e **receitas (incomes)**
* Atribuição automática de usuário logado aos registros
* Separação de valores **pagos** e **pendentes**
* Cálculo automático de **saldo atual** e **saldo projetado**
* Dashboard interativo com **estatísticas financeiras**
* Controle de visibilidade de valores (ocultar/exibir valores monetários)

---

## 📊 Estrutura de Dados

* **User** → Usuário autenticado
* **Expense** → Registro de receita ou despesa

  * `type` → `income` | `expense`
  * `status` → `paid` | `pending` | `overdue`
  * `payment_date` → Data de pagamento
  * `amount` → Valor em centavos (convertido automaticamente para reais via accessor)

Relacionamento:

```
User ───< Expense
```

---

## 📈 Painel de Estatísticas (Widgets)

O painel principal exibe **seis indicadores** financeiros atualizados:

| Categoria   | Métrica               | Descrição                               |
| ----------- | --------------------- | --------------------------------------- |
| 💵 Real     | **Total Income**      | Receitas já recebidas                   |
| 💸 Real     | **Total Expenses**    | Despesas já pagas                       |
| 💰 Real     | **Current Balance**   | Saldo atual                             |
| 🔵 Projeção | **Expected Income**   | Receitas pendentes                      |
| 🟠 Projeção | **Expected Expenses** | Despesas futuras                        |
| 🧮 Projeção | **Expected Balance**  | Saldo projetado considerando pendências |

Todos os valores são filtrados automaticamente por usuário autenticado (`user_id`).

---

## ⚙️ Integrações e Processos

* **Ambiente Dockerizado com Sail**
  Inclui containers para `laravel.test`, `mysql` e `phpmyadmin` (porta `8081`).
* **Conversão automática de valores**
  Armazena `amount` em centavos e exibe em reais formatados (`R$ 0,00`).
* **Autenticação via Laravel Sanctum**
  Cada usuário visualiza apenas seus próprios dados.
* **Filament Admin**
  CRUD completo, widgets customizados, `infolists` e componentes responsivos.
* **Testes com Pest**
  Cobertura de fluxos principais (cadastro, criação de despesas, políticas de acesso).

---

## 🧩 Futuras Expansões

* [ ] Implementação de **carteiras (wallets)** e contas bancárias
* [ ] Categorias de despesas e receitas
* [ ] Lembretes automáticos de vencimento
* [ ] Exportação para Excel/CSV
* [ ] Dashboard mensal com gráficos interativos

---
