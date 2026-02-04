# Plano de Refatoração – Kado

## Objetivo

Organizar a base de código do Kado para:
- reduzir acoplamento,
- aumentar previsibilidade,
- manter velocidade de desenvolvimento,
- preparar o projeto para novas features (como fontes de renda / accounts).

Sem reescrita total, sem overengineering, sem perder produtividade.

---

## Princípio Central

> **Controllers não contêm regra de negócio.**  
> Toda regra de negócio deve viver em uma `Action`.

Controller = orquestrador  
Action = cérebro

---

## Fluxos de Usuário (Contrato do Produto)

Esses fluxos não podem quebrar em nenhuma refatoração.

### Core
- [ ] Cadastro de usuário
- [ ] Login
- [ ] Criar despesa
- [ ] Editar despesa
- [ ] Excluir despesa
- [ ] Marcar como paga
- [ ] Listar despesas
- [ ] Visualizar resumo financeiro (dashboard)

### Organização
- [ ] Criar categoria
- [ ] Listar categorias
- [ ] Vincular despesa a categoria

### Qualidade de Vida
- [ ] Exportar CSV
- [ ] Importar CSV (se mantido)
- [ ] Logout

---

## Estrutura-Alvo

Estrutura pragmática, sem DDD pesado.

app/
 ├── Actions/
 │    ├── Expense/
 │    │     ├── CreateExpense.php
 │    │     ├── UpdateExpense.php
 │    │     ├── DeleteExpense.php
 │    │     └── MarkExpenseAsPaid.php
 │    │
 │    ├── Category/
 │    │     └── CreateCategory.php
 │    │
 │    └── Auth/
 │          └── RegisterUser.php
 │
 ├── Http/
 │    └── Controllers/
 │         └── (somente orquestra)
 │
 ├── Models/
 ├── Services/
# Plano de Refatoração – Kado

## Objetivo

Organizar a base de código do Kado para:
- reduzir acoplamento,
- aumentar previsibilidade,
- manter velocidade de desenvolvimento,
- preparar o projeto para novas features (como fontes de renda / accounts).

Sem reescrita total, sem overengineering, sem perder produtividade.

---

## Princípio Central

> **Controllers não contêm regra de negócio.**  
> Toda regra de negócio deve viver em uma `Action`.

Controller = orquestrador  
Action = cérebro

---

## Fluxos de Usuário (Contrato do Produto)

Esses fluxos não podem quebrar em nenhuma refatoração.

### Core
- [ ] Cadastro de usuário
- [ ] Login
- [ ] Criar despesa
- [ ] Editar despesa
- [ ] Excluir despesa
- [ ] Marcar como paga
- [ ] Listar despesas
- [ ] Visualizar resumo financeiro (dashboard)  

### Organização
- [ ] Criar categoria
- [ ] Listar categorias
- [ ] Vincular despesa a categoria

### Qualidade de Vida
- [ ] Exportar CSV
- [ ] Importar CSV (se mantido)
- [ ] Logout

---

## Estrutura-Alvo

Estrutura pragmática, sem DDD pesado.

app/
 ├── Actions/
 │    ├── Expense/
 │    │     ├── CreateExpense.php
 │    │     ├── UpdateExpense.php
 │    │     ├── DeleteExpense.php
 │    │     └── MarkExpenseAsPaid.php
 │    │
 │    ├── Category/
 │    │     └── CreateCategory.php
 │    │
 │    └── Auth/
 │          └── RegisterUser.php
 │
 ├── Http/
 │    └── Controllers/
 │         └── (somente orquestra)
 │
 ├── Models/
 ├── Services/
