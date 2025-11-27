# HYVÄ – QUICK REFERENCE

> Hyvä Docs: [https://docs.hyva.io/hyva-themes/getting-started/index.html](https://docs.hyva.io/hyva-themes/getting-started/index.html)
> Hyvä UI: [https://docs.hyva.io/hyva-ui-library](https://docs.hyva.io/hyva-ui-library)
> Hyvä Widgets: [https://docs.hyva.io/hyva-widgets](https://docs.hyva.io/hyva-widgets)

## Theme Development (Hyva)
- Theme files are in `app/design/frontend/`
- Override Hyva templates only when necessary
- Use Alpine.js for interactive components
- Style with Tailwind CSS utility classes
- After template changes: clear cache and reload
- After Tailwind config changes: run `npm run build`

### Common Issues & Solutions

**Styles Not Updating (Hyva)**
- Rebuild Tailwind: `npm run build` (or `npm run dev` for watch mode)
- Clear browser cache
- Check Tailwind config syntax

---

## 1. Core Concepts

* Hyvä replaces Magento’s Luma stack with **Blade-like PHP templates**, **Tailwind CSS**, and **Alpine.js**.
* No RequireJS, Knockout, UI Components, or layout JS mixing.
* Frontend is built from:

    * `templates/*.phtml`
    * `web/tailwind` (Tailwind config)
    * `web/js/*.js` (optional)
    * Alpine.js directives inside templates
* Layouts still use **Magento XML**, but templates are drastically simpler.

Docs:
[https://docs.hyva.io/hyva-themes/getting-started/overview.html](https://docs.hyva.io/hyva-themes/getting-started/overview.html)

---

## 2. Folder Structure (Typical Hyvä Child Theme)

```
app/design/frontend/<Vendor>/<Theme>/
  ├── templates/
  ├── Magento_*/templates/
  ├── web/
  │   ├── css/
  │   ├── tailwind/
  │   │   ├── tailwind.config.js
  │   │   ├── hyva.config.json
  │   └── js/
  └── theme.xml
```

Docs:
[https://docs.hyva.io/hyva-themes/building-your-theme/index.html](https://docs.hyva.io/hyva-themes/building-your-theme/index.html)

---

## 3. Tailwind Usage

* All styling is done using **Tailwind classes in templates**.
* You can add custom CSS in `web/css/source/_extend.less` or as Tailwind layers.
* After modifying Tailwind configs, run:

```bash
yarn dev           # dev mode watch
yarn build         # production build
```

Docs:
[https://docs.hyva.io/hyva-themes/tailwindcss/index.html](https://docs.hyva.io/hyva-themes/tailwindcss/index.html)

---

## 4. Alpine.js Usage

* Use Alpine for dynamic UI behavior:

```html
<div x-data="{ open: false }">
  <button @click="open = !open">Toggle</button>
  <div x-show="open">Content</div>
</div>
```

Docs:
[https://docs.hyva.io/hyva-themes/alpinejs/index.html](https://docs.hyva.io/hyva-themes/alpinejs/index.html)

---

## 5. Template Overrides

* Override templates by copying them from:
  `/vendor/hyva-themes/magento2-default-theme/Magento_Module/templates/*`
  into your child theme:

```
app/design/frontend/<Vendor>/<Theme>/Magento_<Module>/templates/<file>.phtml
```

* For UI changes, prefer modifying templates over layout XML unless necessary.

Docs:
[https://docs.hyva.io/hyva-themes/customizing-templates/index.html](https://docs.hyva.io/hyva-themes/customizing-templates/index.html)

---

## 6. Layout XML Rules (Hyvä-Compatible)

* Standard Magento layout XML still works:

```xml
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column">
    <body>
        <referenceBlock name="product.info.main">
            <action method="setTemplate">
                <argument name="template" xsi:type="string">Vendor_Theme::product/view.phtml</argument>
            </action>
        </referenceBlock>
    </body>
</page>
```

Docs:
[https://docs.hyva.io/hyva-themes/layout/xml.html](https://docs.hyva.io/hyva-themes/layout/xml.html)

---

## 7. Common Coding Tasks

### Add JS behavior to a component

Use Alpine inside template or globally in `web/js`:

```js
// web/js/custom.js
document.addEventListener('alpine:init', () => {
  Alpine.data('counter', () => ({
    count: 0,
    inc() { this.count++ }
  }))
})
```

Activate:

```html
<div x-data="counter()">
  <span x-text="count"></span>
  <button @click="inc()">+</button>
</div>
```

### Add Tailwind utilities

Edit `tailwind.config.js` or `hyva.config.json`.

Docs:
[https://docs.hyva.io/hyva-themes/tailwindcss/configuration.html](https://docs.hyva.io/hyva-themes/tailwindcss/configuration.html)

### Override Hyvä classes using Tailwind layers

```css
@layer components {
  .btn-primary {
    @apply bg-blue-600 text-white px-4 py-2 rounded;
  }
}
```

---

## 8. Compatibility Modules (3rd-Party Extensions)

* Some Magento extensions need Hyvä compatibility modules.
* These override templates / JS to remove Knockout dependencies.
* Place in:
  `app/design/frontend/<Vendor>/<Theme>/Hyva_Compat*/`

Docs:
[https://docs.hyva.io/hyva-themes/compatibility-modules/index.html](https://docs.hyva.io/hyva-themes/compatibility-modules/index.html)

---

## 9. Debugging Tips

* Use the browser inspector: Tailwind classes appear directly in markup.
* Use `bin/magento dev:di:compile` + `npm run dev` after structural/template changes.
* Disable legacy JS bundling/minification (should already be off for Hyvä).
  Docs:
  [https://docs.hyva.io/hyva-themes/getting-started/installation.html#disable-optimizations](https://docs.hyva.io/hyva-themes/getting-started/installation.html#disable-optimizations)

---

## 10. Useful Links

* Hyvä Themes Docs
  [https://docs.hyva.io/hyva-themes](https://docs.hyva.io/hyva-themes)
* Tailwind Docs
  [https://tailwindcss.com/docs](https://tailwindcss.com/docs)
* Alpine.js Docs
  [https://alpinejs.dev](https://alpinejs.dev)
* Hyvä UI Components
  [https://docs.hyva.io/hyva-ui-library](https://docs.hyva.io/hyva-ui-library)
* Hyvä Widgets
  [https://docs.hyva.io/hyva-widgets](https://docs.hyva.io/hyva-widgets)
