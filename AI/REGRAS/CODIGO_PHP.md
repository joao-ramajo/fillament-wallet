# Regras De Codigo PHP

## Regras vigentes
- Todo arquivo PHP deve declarar `strict_types=1`.
- Se um arquivo PHP ainda não tiver `declare(strict_types=1);`, ele deve ser ajustado ao ser modificado.
- Devem ser removidos docblocks inúteis que apenas repetem o que o código já expressa.
- Entidades devem ter propriedades anotadas com PHPDoc quando isso for necessário para satisfazer o PHPStan e explicitar tipos relevantes.

## Critérios de aplicação
- Não manter comentários decorativos ou docblocks descritivos sem valor técnico.
- Priorizar tipagem nativa da linguagem e usar PHPDoc como complemento, não como substituto desnecessário.
- Ao editar entidades existentes, revisar anotações de propriedades para evitar alertas do PHPStan.
