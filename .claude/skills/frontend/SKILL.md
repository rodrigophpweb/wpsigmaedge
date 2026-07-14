---
name: frontend
description: Diretrizes de front-end do tema WordPress Sigma Edge — HTML semântico, CSS Grid/Flexbox, responsividade intrínseca, container queries, tipografia fluida, acessibilidade, performance e convenções de WordPress deste tema. Use ao escrever ou revisar HTML, CSS ou template-parts deste projeto. Para tokens de cor/tipografia/identidade visual, veja references/design-system.md.
---

# Manifesto

- HTML semântico acima de tudo.
- CSS3 nativo como primeira opção.
- CSS Grid como principal ferramenta de layout.
- Flexbox para componentes (quando necessário).
- Priorizar Container Queries antes de Media Queries.
- Evitar frameworks como Tailwind e Bootstrap.
- JavaScript Vanilla primeiro.
- HTMX para requisições XHR quando apropriado.
- Código limpo, organizado e fácil de manter.
- Performance e simplicidade acima de modismos.

> Não projete para dispositivos. Projete para o conteúdo e para o espaço disponível.

## HTML

- Utilizar HTML semântico.
- Evitar divs desnecessárias.
- Estruturar documentos pensando em acessibilidade.
- O HTML representa conteúdo, nunca aparência.

## CSS

- CSS resolve layout.
- Preferir recursos nativos.
- Utilizar Grid antes de Flexbox quando o problema for layout.
- Componentizar estilos.
- Evitar dependências desnecessárias.
- Usar CSS Nesting.

Fluxo recomendado ao construir uma seção/componente: conteúdo → estrutura HTML → CSS Grid → Flexbox (quando necessário) → espaçamento fluido → tipografia → refinamentos.

### Grid

Priorizar:

```css
grid-template-columns:
  repeat(auto-fit, minmax(min(100%, 18rem), 1fr));
```

Usar `auto-fit`, `auto-fill`, `repeat()`, `minmax()` e `gap` fluido.

### Flexbox

Usar para alinhamento e componentes: barras de navegação, grupos de botões, alinhamentos horizontal/vertical.

### Responsividade Intrínseca

- Projetar para o conteúdo, não para dispositivos.
- Priorizar Grid, Flexbox, `minmax()`, `repeat()`, `auto-fit`, `auto-fill`, `clamp()`, unidades relativas e Container Queries.
- Evitar breakpoints baseados em dispositivos; breakpoints só quando o conteúdo exigir.
- Componentes devem ser independentes do layout da página.
- Evitar larguras e alturas fixas.
- Media queries são exceção, não regra.

### Container Queries

Sempre considerar antes de Media Queries:

```css
.card { container-type: inline-size; }

@container (width > 32rem) {
  .card__content {
    grid-template-columns: 10rem 1fr;
  }
}
```

### Tipografia

- `html { font-size: 100%; }`
- Utilizar `rem`.
- Preferir `clamp()`.
- Evitar `px` para fontes.
- Respeitar zoom do navegador.
- Acessibilidade vence estética.

## Performance

- Menos JavaScript.
- Menos dependências.
- CSS enxuto.
- Evitar bibliotecas quando o navegador resolve.

## Acessibilidade

- HTML semântico.
- Contraste adequado.
- Navegação por teclado.
- Zoom deve funcionar.
- Legibilidade acima da estética.

## WordPress (específico deste tema)

- Temas próprios.
- Evitar Page Builders quando possível.
- Custom Post Types conforme necessário.
- ACF quando necessário.
- Separação de responsabilidades (não misturar lógica de dados com apresentação).
- Cada página carrega apenas o seu CSS específico (ver `sigma_edge_enqueue_assets()` em `inc/customize.php`, que já condiciona por `is_front_page()`, `is_page()`, `is_single()`, `is_search()`/`is_archive()`).
- Nada de repetição de código — reaproveitar `template-parts/` existentes antes de criar um novo.

## Estilo de código

- Código legível.
- Nomes consistentes.
- Componentização.
- Comentários apenas quando agregam contexto.

## Checklist de revisão

Antes de considerar um componente pronto, revisar:

- [ ] HTML semântico
- [ ] Grid considerado antes de Flexbox
- [ ] Flex apenas quando necessário
- [ ] Container Query considerada antes de media query
- [ ] Sem larguras fixas desnecessárias
- [ ] `rem`/`clamp()` para tipografia
- [ ] Performance (JS/CSS mínimos)
- [ ] Acessibilidade (semântica, contraste, teclado, zoom)
