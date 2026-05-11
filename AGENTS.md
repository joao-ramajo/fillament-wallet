# Regras Locais Para Agentes

Este arquivo define como agentes devem atuar especificamente dentro de `kado-backend/`.

## Leitura obrigatória antes de editar
- `AI/FLUXO_DE_DESENVOLVIMENTO.md`
- `AI/LOG.md`
- `AI/REGRAS/ARQUITETURA.md`
- `AI/REGRAS/CODIGO_PHP.md`
- `AI/REGRAS/DOMINIO.md`
- `AI/REGRAS/TESTES.md`
- `AI/REGRAS/SEGURANCA.md`

## Princípios operacionais
- Respeitar as convenções do Laravel e a organização atual do backend.
- Não mover ou reescrever fluxos existentes sem necessidade objetiva.
- Toda mudança de comportamento deve considerar impacto em rotas, actions, requests, DTOs e testes.
- Todo comando de backend deve ser executado no container da aplicação, preferencialmente via Laravel Sail.
- Ao criar novas regras permanentes, atualizar os arquivos em `AI/REGRAS/`.

## Fonte das regras
- Regras já estabelecidas do projeto estão nos arquivos da pasta `AI/`.
- Regras ainda não definidas devem ser registradas a partir de `AI/PERGUNTAS_DE_REGRAS.md`.
