# Epic 1 - Foundation Site + Health Check

- [x] Boilerplate Clone - `composer create-project laravel/laravel vdk-demo-car-sales-webapp`
- [x] Install + Configure Dependencies
    - [x] InertiaJS - `composer require inertiajs/inertia-laravel`
    - [x] Vue.js - `npm install @inertiajs/vue3 vue`
    - [x] Vite + Plugins - `npm install -D @vitejs/plugin-vue tailwindcss @tailwindcss/vite`

# Epic 2 - DB & Authentication

- [x] Setup Docker Compose for local MySQL server
- [x] Convert DB Adapter from SQLite to MySQL
- [X] Authentication Routes + Tests
- [X] Listings CUD Routes + Tests

# Epic 3 - Thin-CMS + SPA Components

- [X] Listings CUD
    - [X] Auth Component + Wiring
    - [X] Gated Admin Component(s)

# Epic 4 - Immersive UX Overhaul ✓ COMPLETE

Bold, cinematic, luxury car dealership experience. Dark, immersive design with purposeful animations.

## Feature 1: Layout & Design System ✓
- [x] Create MainLayout.vue with persistent nav + footer
  - Fixed header with backdrop blur, mobile menu
  - Premium footer with minimal styling
- [x] Configure Tailwind theme extensions
  - Colors: charcoal (#0a0a0a), copper accent (#c9a962), pure white
  - Typography: tight letter-spacing, premium feel
  - Animation utilities

## Feature 2: Home Page Transformation ✓
- [x] Build immersive hero section
  - Full viewport height with home-bg.jpg
  - Dark gradient overlay, bold typography
  - "DRIVE THE EXTRAORDINARY" headline
  - Scroll indicator animation
- [x] Quick stats strip with animated counters

## Feature 3: Inventory Gallery ✓
- [x] Create CarCard component
  - Large image, hover zoom + lift effect
  - Price badge, condition tag
  - "View Details" overlay on hover
- [x] Transform Cars/Index to grid gallery
  - Responsive masonry/grid layout
  - Filter bar (Make, Year, Price, Condition)
  - Sort dropdown
  - Staggered fade-in animations on scroll

## Feature 4: Vehicle Detail Showcase ✓
- [x] Redesign Cars/Show with cinematic layout
  - Full-width hero image with gradient overlay
  - Bold vehicle title, prominent price
  - Specs grid with icons
  - Smooth back navigation

## Feature 5: Supporting Pages ✓
- [x] About page - editorial design with hero section
- [x] Login page - dark premium aesthetic
- [x] Create/Edit forms - dark premium styling

## Feature 6: Animation Polish ✓
- [x] Page load entrance animations
- [x] Scroll-triggered reveal animations
- [x] Button hover states (scale + glow)
- [x] CarCard hover effects (zoom + lift)

