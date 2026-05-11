# Regras De Seguranca

## Regras base
- Não expor segredos, tokens ou dados sensíveis em código, log ou resposta de erro.
- Toda alteração de autenticação e autorização deve passar por validação explícita.
- Mudanças em persistência devem considerar impacto em integridade dos dados e migrações.

## Regras pendentes de definição
- Política para logs com dados pessoais e financeiros.
- Regras para sanitização de entradas e mensagens de erro.
- Padrão para autorização por rota, action ou policy.
- Requisitos para importação de arquivos e validação de payloads.
