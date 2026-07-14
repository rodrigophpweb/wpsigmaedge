# Design System — Industrial Precision (Sigma Edge)

## Brand & Style

A personalidade da marca é autoritária, técnica e confiável, refletindo um serviço de calibração e instrumentação industrial. A identidade visual fica na interseção entre **Corporate Modern** e **Industrial Functionalism**: evita decoração desnecessária em favor de clareza estrutural, usando layout sistemático para transmitir precisão e expertise.

A UI deve evocar confiabilidade e estabilidade de "alta disponibilidade". Isso é obtido com uma paleta azul controlada, whitespace generoso e acentos geométricos com propósito. Elementos distintivos:

- **Precision Accents:** padrões de "duplo chevron" (setas) para indicar movimento, progresso e fluxo direcional.
- **Asymmetric Framing:** cantos chanfrados (diagonais) sutis em grandes containers de seção e botões, remetendo a desenhos técnicos ou peças usinadas.
- **Industrial Depth:** uso pesado de fotografia industrial de alta qualidade como camadas de fundo, suavizada por overlays azul-escuro para manter legibilidade do texto.

## Cores

Paleta enraizada em "Industrial Blues", estabelecendo uma atmosfera profissional e fria (porém confiável).

- **Espectro primário:** `#005291` é o principal driver da marca; `#004884` dá profundidade a gradientes e headers. Um terciário mais escuro `#001B3D` é reservado para footers de alto contraste e botões de ação primária.
- **Sistema neutro:** fundo em off-white frio (`#F9F9FF`) para reduzir cansaço visual. Superfícies secundárias e bordas usam `#D7DAE3` para divisões estruturais suaves.
- **Acentos semânticos:** estados de sucesso (ex.: chips de status de produto) usam um verde técnico (`#28A745`) legível sobre fundos claros.

### Tokens completos (Material-style)

| Token | Valor |
|---|---|
| surface | `#f7f9ff` |
| surface-dim | `#d6dae2` |
| surface-bright | `#f7f9ff` |
| surface-container-lowest | `#ffffff` |
| surface-container-low | `#eff4fc` |
| surface-container | `#eaeef6` |
| surface-container-high | `#e4e8f0` |
| surface-container-highest | `#dee3eb` |
| on-surface | `#171c22` |
| on-surface-variant | `#424750` |
| inverse-surface | `#2c3137` |
| inverse-on-surface | `#edf1f9` |
| outline | `#727781` |
| outline-variant | `#c2c7d2` |
| surface-tint | `#1f60a0` |
| primary | `#003b6a` |
| on-primary | `#ffffff` |
| primary-container | `#005291` |
| on-primary-container | `#9bc6ff` |
| inverse-primary | `#a2c9ff` |
| secondary | `#2a609d` |
| on-secondary | `#ffffff` |
| secondary-container | `#8bbbfe` |
| on-secondary-container | `#054a86` |
| tertiary | `#233a5d` |
| on-tertiary | `#ffffff` |
| tertiary-container | `#3b5175` |
| on-tertiary-container | `#aec4ef` |
| error | `#ba1a1a` |
| on-error | `#ffffff` |
| error-container | `#ffdad6` |
| on-error-container | `#93000a` |
| primary-fixed | `#d3e4ff` |
| primary-fixed-dim | `#a2c9ff` |
| on-primary-fixed | `#001c38` |
| on-primary-fixed-variant | `#004881` |
| secondary-fixed | `#d4e3ff` |
| secondary-fixed-dim | `#a4c9ff` |
| on-secondary-fixed | `#001c39` |
| on-secondary-fixed-variant | `#004883` |
| tertiary-fixed | `#d6e3ff` |
| tertiary-fixed-dim | `#b1c7f2` |
| on-tertiary-fixed | `#001b3d` |
| on-tertiary-fixed-variant | `#31476b` |
| background | `#f7f9ff` |
| on-background | `#171c22` |
| surface-variant | `#dee3eb` |

## Tipografia

Fonte exclusiva: **Hanken Grotesk**, para um visual moderno e geométrico, altamente legível em contextos técnicos.

- **Hierarquia:** headlines favorecem pesos mais pesados (700–800) para se destacar contra fotografia industrial.
- **Espaçamento:** displays maiores usam letter-spacing negativo (-0.02em) para sensação mais compacta e impactante.
- **Legibilidade:** texto de corpo com line-height generoso (1.6) para descrições longas de serviços/posts técnicos.
- **Escala:** em mobile, tamanhos de display devem reduzir agressivamente para evitar quebras de palavra estranhas.

| Estilo | Fonte | Tamanho | Peso | Line-height | Letter-spacing |
|---|---|---|---|---|---|
| display-lg | Hanken Grotesk | 48px | 800 | 1.1 | -0.02em |
| display-lg-mobile | Hanken Grotesk | 32px | 800 | 1.2 | — |
| headline-md | Hanken Grotesk | 32px | 700 | 1.3 | — |
| headline-sm | Hanken Grotesk | 24px | 700 | 1.4 | — |
| body-lg | Hanken Grotesk | 18px | 400 | 1.6 | — |
| body-md | Hanken Grotesk | 16px | 400 | 1.6 | — |
| label-bold | Hanken Grotesk | 14px | 700 | 1.2 | — |
| caption | Hanken Grotesk | 12px | 500 | 1.4 | — |

## Layout & Espaçamento

Modelo de **Fixed Grid** no desktop, centralizando conteúdo em container de 1280px.

- **Grid:** 12 colunas no desktop, 2 colunas no tablet, 1 coluna no mobile.
- **Ritmo:** toda a espacial deriva de uma unidade base de 8px. Padding interno de card: 24px (3 unidades). Espaçamento vertical de seção: 80px desktop / 40px mobile (10/5 unidades).
- **Containers especiais:** heros e banners frequentemente têm um canto "recortado"/chanfrado no bottom-right ou top-left, reforçando a estética técnica.

| Token | Valor |
|---|---|
| spacing.base | 8px |
| spacing.section-padding-desktop | 80px |
| spacing.section-padding-mobile | 40px |
| spacing.gutter | 24px |
| spacing.container-max | 1280px |
| rounded.sm | 0.25rem |
| rounded.DEFAULT | 0.5rem |
| rounded.md | 0.75rem |
| rounded.lg | 1rem |
| rounded.xl | 1.5rem |
| rounded.full | 9999px |

## Elevação & Profundidade

Hierarquia estabelecida por **Tonal Layering** e **outlines de baixo contraste**, não por sombras agressivas.

- **Superfícies:** nível primário é o background (`#F9F9FF`). Nível secundário são containers brancos (`#FFFFFF`) com borda suave de 1px em `#D7DAE3`.
- **Sombras:** quando usadas (botões flutuantes de "Solicitar Orçamento" ou cards ativos), devem ser extremamente difusas: `0 10px 30px rgba(0, 27, 61, 0.08)`.
- **Overlays industriais:** para seções com imagem de fundo, usar gradiente linear: `linear-gradient(135deg, rgba(0,82,145,0.95) 0%, rgba(0,27,61,0.95) 100%)`.

## Formas

Padrão de **cantos arredondados** (8px) para elementos funcionais (cards, inputs, botões).

- **Raio padrão:** 8px (`0.5rem`).
- **Raio grande:** 24px (`1.5rem`) para containers de seção com fundo chanfrado.
- **Efeito chanfro:** formas decorativas de fundo com corte de 45° (tipicamente 40–60px) para o visual técnico assinatura "Edge".

## Componentes

### Botões
- **Primary:** fundo `#001B3D`, texto `#FFFFFF`, raio 8px. Hover: fundo vira `#005291`.
- **Secondary/Outline:** borda 2px `#005291`, texto `#005291`. Hover: preenche com `#005291` e texto vira branco.
- **Ghost:** fundo transparente, texto na cor primária, usado para links "Saiba Mais".

### Campos de input
- **Padrão:** fundo branco, borda 1px `#D7DAE3`, raio 8px.
- **Foco:** borda 2px `#005291` com glow externo azul suave.
- **Labels:** token `label-bold`, posicionado acima do campo.

### Cards
- **Service Cards:** fundo branco, borda 1px, raio 8px. Ícone de "duplo chevron" no canto superior direito como watermark sutil.
- **Product Cards:** placeholder de imagem cinza claro (`#D7DAE3`) com canto superior-esquerdo chanfrado a 45°.

### Elementos decorativos
- **Duplo chevron:** sequência de 5–8 chevrons (`»»»»»`). Usar `#D7DAE3` em fundos claros e branco semi-transparente (`rgba(255,255,255,0.2)`) em fundos azuis.
- **Status chips:** formato pill arredondado, fonte pequena, alto contraste (ex.: fundo verde + texto branco para "Em Estoque").
