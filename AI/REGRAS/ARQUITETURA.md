# Regras De Arquitetura

## Regras vigentes
- Toda rota deve ser criada junto de um controller de entrada com método `__invoke`, seguindo o padrão de single action controller.
- Todo caso de uso deve ser implementado através de uma classe `Action`, com único método público `execute()`.
- Todo fluxo de caso de uso deve ter `Input` e `Output` definidos.
- Toda regra de negócio e execução deve estar centralizada em classes `Action`.
- Controller deve apenas validar entrada e orquestrar o fluxo.
- O projeto segue `Action Pattern`, então o uso de `Service` deve ser evitado na maior parte dos casos.
- `Service` só deve ser introduzido quando houver uma justificativa clara de reutilização técnica que não represente caso de uso de negócio.
- Comandos operacionais do backend devem ser executados dentro do container da aplicação `laravel.test`, preferencialmente via Laravel Sail.

## Regras pendentes de definição
- Limites de responsabilidade entre `Action`, `DTO`, `Model` e `Controller`.
- Convenção para nomes de endpoints, actions e requests.
- Estratégia para versionamento de API.
