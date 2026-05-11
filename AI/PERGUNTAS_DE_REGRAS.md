# Perguntas Para Definir Regras De Agentes

Preencha este arquivo conforme as decisões do time. Cada resposta pode virar uma regra permanente em `AI/REGRAS/`.

## Arquitetura
- Existe convenção obrigatória para nomes de rotas, endpoints e classes?
- Existe algum caso excepcional já aceito para uso de `Service` fora do `Action Pattern`?

## Dominio
- Quais módulos do backend são críticos e exigem regras mais rígidas?
- Quais validações de negócio nunca podem ficar apenas no `Request`?
- Existe um padrão para exceções de domínio e mensagens de erro?

## Testes
- O que é obrigatório testar em toda feature nova?
- Quando o time prefere teste de `Feature` e quando prefere `Unit`?
- Há cenários que sempre precisam de teste de regressão?

## Seguranca
- Quais dados não podem aparecer em logs em nenhuma hipótese?
- Existe regra específica para autenticação, autorização e permissões?
- Quais cuidados devem ser obrigatórios em importação de CSV, exportação e upload?

## Banco e migracoes
- Existe política para nome de migrations, rollback e compatibilidade?
- Mudanças de schema exigem seed, backfill ou plano de rollout?

## Observabilidade
- Além das regras de `AI/LOG.md`, existe padrão para contexto, correlação ou nível de severidade dos logs?
- Quais módulos precisam obrigatoriamente de métricas ou logs mais detalhados?

## Codigo PHP
- Existe algum padrão adicional para uso de PHPDoc além das propriedades de entidades?
- Há regras para comentários permitidos e proibidos no código?
