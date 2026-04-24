# MWALAFYALE — Amateur-to-Premium Audit

**Goal:** Clean minimal + subtle motion (Linear / Vercel aesthetic)
**Scope:** `resources/views/home.blade.php` (1,869 lines, ~103 KB) — entire site in one file
**Stack:** Laravel 13 · Tailwind CSS v4 · Vite · no JS framework · `resources/js/app.js` is empty

---

## The one-line diagnosis

The site isn't amateur because the tools are wrong. It's amateur because roughly a dozen small decisions (fonts, radii, animations, caps, copy length) are each pulling in a different direction, and they're all living in a single 1,869-line Blade file with no componentization.

---

## Findings by category

### 1. Typography

- **Lines 49, 59** — Font stack is `Avenir Next, Segoe UI, sans-serif` (body) + `Trebuchet MS` (headings). Trebuchet MS is a dated, pseudo-serif Windows system font. This contradicts the `@theme` block in `resources/css/app.css` that claims Instrument Sans.
- **Line 371** — `text-5xl font-bold` on h1. Too heavy. Should be `text-4xl font-medium tracking-tight`.
- **Lines 471, 582, 653, 845** — every h1/h2/h3 is `font-bold`. No hierarchy variation.
- **Line 368** — small label gets `tracking-[0.22em]`, but h1/h2 get no letter-spacing. Hierarchy is inverted.

### 2. Color palette & contrast

- **Lines 23–29** — 5 custom colors (`ink`, `panel`, `sand`, `mist`, `accent`, `whatsapp`). Minimal bloat — good baseline.
- **Accent `#c7964d` is overused** — lines 878, 994, 1074 all lean on it for buttons/badges/hovers.
- **Lines 67–70** — radial gradient in `hero-noise` (accent @ 22% opacity + green @ 12%). Over-engineered for "clean."
- **Throughout** — secondary text uses opacity (`text-white/60`, `text-white/70`, `text-white/80`) instead of a defined neutral gray. Inconsistent.

### 3. Spacing & layout

- Consistent `max-w-6xl px-4` container. Good.
- Section padding varies (`py-8`, `py-14`, `md:py-14`) — uneven vertical rhythm.
- **Lines 405–422** — four stat boxes stacked 2x2 on `sm:` feel cramped.
- **Lines 482, 558, 767, 1336** — border-radius chaos: `rounded-[24px]`, `[28px]`, `[30px]`, `[32px]`, `[34px]` across different cards. Linear/Vercel use one value (max 16px).

### 4. Component design

- **Lines 314–315, 381–402, 941–957** — buttons default to generic Tailwind (rounded-2xl + `bg-blue-600` / `bg-green-500`).
- **Line 386** — WhatsApp button `rounded-2xl bg-whatsapp hover:bg-green-500`. Generic.
- **Lines 482–501** — quick-action cards all use `hover:-translate-y-0.5`. Cards visibly jump on hover — dated pattern.
- **Lines 131–146** — video play button `transform: scale(1.18)` on hover. 18% scale inflation. Should be 1.05 max.
- **Line 467** — checkout modal backdrop `bg-slate-950/70` is heavy. Lighter overlay reads more premium.

### 5. Imagery & media

- **Lines 428–436** — profile picture uses `style="object-position: center 15%;"` inline. Move to CSS class.
- **Line 102** — video card shadow `0 14px 40px rgba(16,35,60,0.18)`. Chunky. 8–12px blur is more modern.
- **Line 179** — `text-shadow: 0 2px 8px rgba(0,0,0,0.6)` on video titles. Heavy-handed.
- **Lines 67–70, 125–129** — multiple gradient overlays on video thumbnails. Visual noise.

### 6. Microcopy & content

- **Line 372** — h1 is fine ("Build a part-time business that fits your real life, not just your ambition."). No cheap exclamations.
- **Lines 374–378** — three-paragraph hero body. Linear/Vercel hero copy is ~15 words. Cut hard.
- **Line 378** — "No hype. No confusing funnel. Just a clear place to start, simple payment options, and direct WhatsApp support when you need it. Karibu." — the Swahili close is charming but feels forced in the hero.
- **CTA repetition** — "Chat on WhatsApp", "Chat on WhatsApp Instead", "Chat First", "Ask After Watching". Vary the verbs or consolidate.
- **Lines 407, 483, 566, 603, 806** — `uppercase tracking-[0.22em]` on every section header. Overkill. Reserve UPPERCASE for tiny utility labels only.

### 7. Motion / interactivity

- **Lines 103–106** — `cubic-bezier(0.34, 1.56, 0.64, 1)` overshoot curve. Screams 2019 Framer tutorial. Replace with `ease-out 0.2s`.
- **Line 482** — `hover:-translate-y-0.5` on cards. Visible jump.
- **Line 106** — `translateY(-6px) scale(1.015)` combined. Old Bootstrap vibes.
- **Line 144** — `.play-btn { transform: scale(1.18) }`. Way too much.
- **Lines 1287, 1300** — form inputs have no focus styling beyond browser outline.
- **No scroll-triggered fades, no stagger, no subtle parallax.** The 1,800-line page feels static.

### 8. Form UX (lead capture, lines 1279–1328)

- Label-first design — good.
- Placeholder copy is generic ("Enter your name", "Enter your email"). Either remove placeholders entirely or make them helpful.
- Only 2 fields (name, email) — minimal, good.
- **Lines 1291, 1304** — error states hidden by default (`hidden`). Consider inline validation hints.
- **Lines 1317–1327** — consent copy is boilerplate. Can be shorter.
- **Line 1312** — submit button uses `bg-accent` (tan). Stands out but doesn't read premium.

### 9. Mobile / responsive

- Breakpoints (`sm`, `md`, `lg`, `xl`) are used correctly. No hardcoded widths.
- **Lines 342–358** — mobile nav duplicates desktop nav. Functional but repetitive.
- **Line 1519** — sticky mobile footer (WhatsApp + Call) uses `backdrop-blur` on `bg-white/95`. Redundant — either solid OR blur, not both.
- **Line 366** — `lg:grid-cols-[1.1fr_0.9fr]` — fractional grids are fine but fussy for "clean."

### 10. Meta & polish (lines 1–17)

- `<title>` present, pipe separator — good.
- Meta description present, ~160 chars — good.
- OG tags complete (og:title, og:description, og:image) — good.
- `<html lang="en">` correct.
- **Missing:** canonical URL tag (`<link rel="canonical" ...>`).
- **Missing:** `<link rel="icon" ...>` — favicon.ico exists in `/public` but isn't linked.
- **Missing:** JSON-LD structured data (Person schema would help SEO for a coach).
- Accessibility basics are actually solid: skip-to-main link (lines 283–288), ARIA labels on video cards, alt text on images, custom focus ring (lines 78–85).
- **Line 433** — `loading="eager"` on hero image. Correct.

---

## Top 10 prioritized fixes

1. **Lines 49, 59** — Replace `Trebuchet MS` / `Avenir Next` with `-apple-system, BlinkMacSystemFont, Inter, "Segoe UI", sans-serif`. Or actually load Instrument Sans via `<link>` tag to match the Tailwind `@theme` config.
2. **Line 371** — Change h1 from `text-5xl font-bold` to `text-4xl font-medium tracking-tight`. Pair with `font-light` body at line 374.
3. **Lines 482, 487, 492, 502, 511, 516** — Delete every `hover:-translate-y-0.5`. Replace with `hover:shadow-md` or `hover:bg-slate-50`.
4. **Lines 103–106** — Replace `cubic-bezier(0.34, 1.56, 0.64, 1)` with `ease-out`, duration `0.2s`.
5. **Lines 482, 558, 767, 1336** — Standardize border-radius to `rounded-2xl` (16 px). Remove all `rounded-[24–34px]` variations.
6. **Lines 407, 483, 566, 603, 806** — Remove `uppercase tracking-[0.22em]` from section headers. Keep UPPERCASE only for tiny utility labels (e.g., "Step 01").
7. **Custom palette (lines 23–29)** — Add `neutral: "#6b7280"`. Replace `text-white/60`, `/70`, `/80` with it.
8. **Line 144** — Reduce play-btn hover from `scale(1.18)` to `scale(1.05)`.
9. **Lines 374–378** — Cut hero body to one line. Move "Karibu" to footer.
10. **Line 5** — Add `<link rel="canonical" href="{{ url('/') }}">` and `<link rel="icon" href="/favicon.ico">`.

---

## Architectural recommendation

Before making cosmetic changes, split `home.blade.php` into Blade components:

```
resources/views/components/
  nav.blade.php
  hero.blade.php
  stat-grid.blade.php
  video-card.blade.php
  lead-form.blade.php
  testimonial.blade.php
  sticky-mobile-bar.blade.php
```

Fixing typography and radii is a 30-minute pass once the file is componentized. Fighting them inside a 1,869-line monolith is a full day. Components are also what lets you iterate on animation feel without scrolling past three other sections every time.

---

## What the current stack is missing for "Linear-tier motion"

You don't need React or Three.js to get there. Two additions are enough:

- **Alpine.js** (`~15 KB`, drops in, no build step) — for scroll-triggered fades, nav open/close, modal state.
- **Motion One** (`~5 KB`, vanilla, no React required) — for choreographed spring animations. Use instead of raw CSS transitions for any element that needs coordinated timing.

If you later want shader backgrounds like the reels you described, a single `<canvas>` + `three.js` can mount into the hero without touching the rest. But the Linear/Vercel aesthetic is achievable with just the two libraries above.
