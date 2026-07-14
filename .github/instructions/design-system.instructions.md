---
name: Industrial Precision
colors:
  surface: '#f7f9ff'
  surface-dim: '#d6dae2'
  surface-bright: '#f7f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4fc'
  surface-container: '#eaeef6'
  surface-container-high: '#e4e8f0'
  surface-container-highest: '#dee3eb'
  on-surface: '#171c22'
  on-surface-variant: '#424750'
  inverse-surface: '#2c3137'
  inverse-on-surface: '#edf1f9'
  outline: '#727781'
  outline-variant: '#c2c7d2'
  surface-tint: '#1f60a0'
  primary: '#003b6a'
  on-primary: '#ffffff'
  primary-container: '#005291'
  on-primary-container: '#9bc6ff'
  inverse-primary: '#a2c9ff'
  secondary: '#2a609d'
  on-secondary: '#ffffff'
  secondary-container: '#8bbbfe'
  on-secondary-container: '#054a86'
  tertiary: '#233a5d'
  on-tertiary: '#ffffff'
  tertiary-container: '#3b5175'
  on-tertiary-container: '#aec4ef'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d3e4ff'
  primary-fixed-dim: '#a2c9ff'
  on-primary-fixed: '#001c38'
  on-primary-fixed-variant: '#004881'
  secondary-fixed: '#d4e3ff'
  secondary-fixed-dim: '#a4c9ff'
  on-secondary-fixed: '#001c39'
  on-secondary-fixed-variant: '#004883'
  tertiary-fixed: '#d6e3ff'
  tertiary-fixed-dim: '#b1c7f2'
  on-tertiary-fixed: '#001b3d'
  on-tertiary-fixed-variant: '#31476b'
  background: '#f7f9ff'
  on-background: '#171c22'
  surface-variant: '#dee3eb'
typography:
  display-lg:
    fontFamily: Hanken Grotesk
    fontSize: 48px
    fontWeight: '800'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Hanken Grotesk
    fontSize: 32px
    fontWeight: '800'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Hanken Grotesk
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.3'
  headline-sm:
    fontFamily: Hanken Grotesk
    fontSize: 24px
    fontWeight: '700'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Hanken Grotesk
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Hanken Grotesk
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-bold:
    fontFamily: Hanken Grotesk
    fontSize: 14px
    fontWeight: '700'
    lineHeight: '1.2'
  caption:
    fontFamily: Hanken Grotesk
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1.4'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  section-padding-desktop: 80px
  section-padding-mobile: 40px
  gutter: 24px
  container-max: 1280px
---

## Brand & Style

The brand personality is authoritative, technical, and dependable, reflecting an industrial calibration and instrument service. The visual identity sits at the intersection of **Corporate Modern** and **Industrial Functionalism**. It avoids unnecessary decoration in favor of structural clarity, using a systematic layout to convey precision and expertise.

The UI should evoke a sense of reliability and "high-uptime" stability. This is achieved through a controlled blue-scale palette, generous whitespace, and purposeful geometric accents. Key distinctive elements include:
*   **Precision Accents:** Use of double-chevron "arrow" patterns to denote motion, progress, and directional flow.
*   **Asymmetric Framing:** Subtle use of chamfered (diagonal) corners on large section containers and buttons to mimic technical drawings or machined parts.
*   **Industrial Depth:** Heavy use of high-quality industrial photography as background layers, softened by deep blue overlays to maintain text legibility.

## Colors

The palette is rooted in "Industrial Blues," establishing a professional and cold (yet trustworthy) atmosphere. 

*   **Primary Spectrum:** `#005291` serves as the main brand driver, while `#004884` provides depth for gradients and headers. A deeper tertiary `#001B3D` is reserved for high-contrast footers and primary action buttons to ensure maximum focus.
*   **Neutral System:** The background uses a slightly cool off-white (`#F9F9FF`) to reduce eye strain compared to pure white. Secondary surfaces and borders use `#D7DAE3` to create soft structural divisions.
*   **Semantic Accents:** Success states (like product status chips) should utilize a technical green (`#28A745`) that remains legible against light backgrounds.

## Typography

The design system exclusively uses **Hanken Grotesk** to maintain a modern, geometric feel that remains highly readable in technical contexts.

*   **Hierarchy:** Headlines should favor heavier weights (700-800) to stand out against industrial photography. 
*   **Spacing:** Larger displays utilize negative letter spacing (-0.02em) to feel tighter and more impactful. 
*   **Readability:** Body text is set with a generous 1.6 line-height to ensure that long descriptions of services or technical post content are easily digestible.
*   **Scale:** On mobile, display sizes must scale down aggressively to prevent awkward word breaks in narrow viewports.

## Layout & Spacing

The layout follows a **Fixed Grid** model on desktop, centering content within a 1280px container to maintain visual control over the industrial framing elements.

*   **Grid:** A 12-column grid is used for desktop, transitioning to 2 columns for tablet and 1 column for mobile.
*   **Rhythm:** All spacing is derived from a base unit of 8px. Internal card padding should be 24px (3 units), while section vertical spacing should be 80px (10 units) to provide "breathing room" between dense content blocks.
*   **Special Containers:** Major hero sections and banners often feature a "cut-out" or chamfered corner on the bottom-right or top-left, reinforcing the technical aesthetic.

## Elevation & Depth

Hierarchy is established through **Tonal Layering** and **Low-Contrast Outlines** rather than aggressive shadows.

*   **Surfaces:** The primary level is the background (`#F9F9FF`). The secondary level is represented by white containers (`#FFFFFF`) with a very soft, 1px border in `#D7DAE3`.
*   **Shadows:** When used (primarily for floating "Request Quote" buttons or active cards), shadows should be extremely diffused: `0 10px 30px rgba(0, 27, 61, 0.08)`.
*   **Industrial Overlays:** For sections containing background images, use a linear gradient overlay: `linear-gradient(135deg, rgba(0,82,145,0.95) 0%, rgba(0,27,61,0.95) 100%)`. This ensures consistent depth across the site.

## Shapes

The design system utilizes a **Rounded** (8px) corner radius as the standard for all functional elements (cards, inputs, buttons).

*   **Standard Radius:** 8px (`0.5rem`). This softens the industrial look enough to feel modern and accessible.
*   **Large Radius:** For major section containers that use the chamfered-style backgrounds, use 24px (`1.5rem`) for any rounded corners to maintain proportionality.
*   **Chamfer Effect:** Decorative background shapes should feature a 45-degree cut-off corner (typically 40px to 60px in size) to create the signature technical "Edge" look.

## Components

### Buttons
*   **Primary:** Background `#001B3D`, Text `#FFFFFF`, 8px radius. On hover, background shifts to `#005291`.
*   **Secondary/Outline:** Border 2px `#005291`, Text `#005291`. On hover, fills with `#005291` and text becomes white.
*   **Ghost:** Transparent background, primary color text, used for "Learn More" links.

### Input Fields
*   **Standard:** White background, 1px border `#D7DAE3`, 8px radius. 
*   **Focus State:** Border becomes 2px `#005291` with a soft blue outer glow.
*   **Labels:** Use `label-bold` tokens, placed above the field.

### Cards
*   **Service Cards:** White background, 1px border, 8px radius. Include the "double-chevron" icon in the top right as a subtle watermark or accent.
*   **Product Cards:** Feature a light grey image placeholder (`#D7DAE3`) with a 45-degree chamfered top-left corner.

### Decorative Elements
*   **Double Chevrons:** A sequence of 5-8 chevrons (`»»»»»`). Use `#D7DAE3` for light backgrounds and a semi-transparent white (`rgba(255,255,255,0.2)`) for blue backgrounds.
*   **Status Chips:** Rounded-pill shape, small font size, high contrast (e.g., Green background with white text for "In Stock").