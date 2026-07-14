# Sigma Edge - WordPress Theme

Tema WordPress customizado para Sigma Edge com foco em performance, semântica HTML e design system industrial.

## 🚀 Início Rápido com Docker

### Pré-requisitos
- Docker Desktop instalado
- Docker Compose

### Subir o ambiente

```bash
# Subir containers
docker-compose up -d

# Verificar status
docker-compose ps

# Ver logs
docker-compose logs -f wordpress
```

### Acessar o projeto

- **WordPress**: http://localhost:8080
- **PHPMyAdmin**: http://localhost:8081
  - Usuário: `sigma_edge_user`
  - Senha: `sigma_edge_pass`

### Primeira instalação

1. Acesse http://localhost:8080
2. Escolha idioma: **Português do Brasil**
3. Configure o WordPress:
   - Título do site: `Sigma Edge`
   - Usuário: `admin` (ou seu preferido)
   - Senha: (escolha uma forte)
   - Email: seu email
4. Faça login no painel
5. Vá em **Aparência > Temas**
6. Ative o tema **Sigma Edge**

### Instalar ACF Pro

O tema usa Advanced Custom Fields Pro. Você precisa:

1. Baixar o plugin ACF Pro
2. Instalar via **Plugins > Adicionar novo > Enviar plugin**
3. Ativar o plugin

Todos os campos ACF serão registrados automaticamente via código.

### Comandos úteis

```bash
# Parar containers
docker-compose stop

# Parar e remover containers
docker-compose down

# Parar e remover TUDO (incluindo volumes)
docker-compose down -v

# Reconstruir containers
docker-compose up -d --build

# Acessar bash do WordPress
docker-compose exec wordpress bash

# Acessar bash do MySQL
docker-compose exec db bash
```

## 📁 Estrutura do Tema

```
wpsigmaedge/
├── assets/
│   ├── css/
│   │   ├── components/    # CSS dos componentes
│   │   └── pages/         # CSS das páginas
│   └── js/
│       └── main.js        # JavaScript principal
├── inc/
│   ├── custom-post-type.php  # CPTs Product/Service
│   ├── customize.php         # Options Pages + Enqueue
│   └── meta-boxes.php        # ACF Field Groups
├── template-parts/           # Componentes reutilizáveis
├── template-pages/           # Page Templates
├── functions.php
├── style.css
└── docker-compose.yml

```

## 🎨 Design System

- **Cores**:
  - Primary: `#003b6a` / `hsl(207 100% 21%)`
  - Secondary: `#005291` / `hsl(207 100% 28%)`
  - Dark: `#001B3D` / `hsl(215 100% 12%)`
  - Background: `#f7f9ff` / `hsl(215 100% 98%)`

- **Tipografia**:
  - Família: Hanken Grotesk (400, 500, 600, 700, 800)
  - Escala fluida com `clamp()`

## 🧩 Custom Post Types

- **Product** (`product`)
  - Taxonomia: `product_category`
  - Campos: availability, technical_sheet
  
- **Service** (`service`)
  - Taxonomia: `service_category`

## 🔧 ACF Field Groups

Todos registrados via código em `inc/meta-boxes.php`:

- Hero Banner
- Services Section
- Product Catalog
- Differences Section
- Blog Section
- Differences Two
- Address Section
- Product Custom Fields
- Footer Options

## 📝 CSS Architecture

- **Grid-first**: CSS Grid para layouts
- **Flexbox**: Apenas para componentes internos
- **Container Queries**: Responsividade primária
- **CSS Nesting**: Sintaxe nativa
- **Logical Properties**: `inline-size`, `block-size`, `padding-block`, `padding-inline`

## 🌐 Navegação

Áreas de menu registradas:
- `primary` - Menu Principal
- `footer-menu-1` - Footer Menu 1
- `footer-menu-2` - Footer Menu 2
- `footer-legal` - Menu Legal (Privacidade/Termos)

## 🔒 Segurança

- Todos os formulários com `wp_nonce_field()`
- Sanitização de inputs (`sanitize_text_field`, `sanitize_email`, etc.)
- Validação server-side

## 📧 Formulários

- **Newsletter**: Handler em `inc/customize.php`
- **Contato**: Handler em `inc/customize.php`

Ambos enviam email para `admin_email` do WordPress.

## 🐛 Debug

O Docker já vem configurado com:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);
```

Logs em: `wp-content/debug.log`

## 📦 Backup e Migração

### Backup do banco
```bash
docker-compose exec db mysqldump -u sigma_edge_user -psigma_edge_pass sigma_edge_db > backup.sql
```

### Restaurar banco
```bash
docker-compose exec -T db mysql -u sigma_edge_user -psigma_edge_pass sigma_edge_db < backup.sql
```

## 🤝 Contribuição

1. Siga as diretrizes em `.github/instructions/`
2. HTML sempre semântico
3. CSS Grid-first
4. Container Queries > Media Queries
5. Vanilla JS, sem frameworks

## 📄 Licença

Proprietary - Sigma Edge © 2026
