# Changes

## 0.22.0 (beta)

- Theme settings in a clearer order: **Brand identity** (the logos first, then the brand colour, which proposes their colours, and the header colour), **Typography and display** (font, corners, dark mode), **Pages and navigation** (what the theme adds to Moodle's pages, grouped by Navigation, Pages, Vocabulary, E-mails), then the login page, footer, accessibility and advanced tabs. The values already saved are kept. A logo just uploaded proposes its colours before it is saved.
- « Moodle is working » indicator also on the pages of Moodle's maintenance layout: validation of a plugin ZIP file, plugins check and upgrade. While the upgrade runs, a message stays in a corner of the page until it is complete.
- IOMAD company form: the Appearance part is arranged in numbered steps, in the order of the work (theme, logos, colours and font, pages, footer, vocabulary, advanced settings), each in its own card. IOMAD's own fields (theme, logos, favicon, custom CSS and menu) are moved into these steps: the logos now come before the colours, which are proposed from the logo.
- Supports Moodle 5.2 and 5.3 (PHP 8.3 and 8.4). Continuous integration on Moodle 4.5 to 5.3 with PostgreSQL (17 for Moodle 5.3), and on Moodle 4.5 and 5.3 with MariaDB 11.4. No change in the theme code was needed.

## 0.21.0 (beta)

- Accessibility pre-audit (axe-core, WCAG 2.2 A/AA) on 240 pages of Moodle 4.5, Moodle 5.1 and IOMAD 4.5, by role, in light and dark mode, on desktop and phone; every issue found is fixed. Report (in French): [wiki](https://github.com/ericfalcon/moodle-theme-iomad/wiki/Pré-audit-d’accessibilité).
- Keyboard focus outline of the theme takes precedence over the pale rings of Bootstrap and Moodle (buttons, menus, fields); white in the brand-coloured header.
- Targets of at least 24 × 24 px for the sorting and hiding of table columns, the initials of the lists of users, the links of the administration search, the action menus and the help icons of table headers.
- Dark mode for the grader report, the grading table of assignments and the "More" menu of the course tabs.
- Theme settings tabs: valid structure for assistive technologies.
- Messages page: no longer hidden from screen readers (a Moodle issue), and named region.
- Quick search button: AA contrast in a brand-coloured company header.
- English documentation (theme README) and French documentation (GitHub wiki).
- Maturity: beta.

## 0.20.0

- E-mails in the colours of the brand: logo, brand band, footer and a link to the notification preferences; per recipient's company with IOMAD.

## 0.19.0

- Quick search (Ctrl+K / ⌘K): menu pages, my courses, activities of my courses, catalogue, administration pages.

## 0.18.0

- Mobile navigation bar: dashboard, my courses, catalogue, messages (unread count), profile; per company with IOMAD.
- IOMAD: category column on the "Manage IOMAD course settings" page.

## 0.17.0

- Course catalogue: subcategories as chips, courses as cards, search results as cards; course introduction on the enrolment page.

## 0.16.0

- Activity pages: previous and next activities as cards, strip with course, position and progress, reading mode, more visible "Mark as done".

## 0.15.0

- "Moodle is working…" indicator during installation and upgrade steps.

## 0.14.x

- Footer on every page, per company with IOMAD; key figures of the site; dark mode fixes.

## 0.13.0

- IOMAD: key figures of the company on the IOMAD dashboard.

## 0.12.0

- Dark mode: never, automatic or always, for the site, per IOMAD company and per user.

## 0.11.0

- Learner overview on the dashboard: course to resume, courses in progress, deadlines, completed courses and certificates.

## 0.10.0

- Course page: banner with image, progress, next activity, deadline and "Continue" button; figures and direct links for teachers; progress of each section.

## 0.9.0

- Accessibility: display preferences (Aa button), skip link, focus, targets, accessibility statement (RGAA), axe-core audit in continuous integration.
- IOMAD: direct access to the course categories of the company.

## 0.7.0

- My courses by role: "I teach" and "I take" sections with suited cards.

## 0.6.0

- IOMAD: appearance and vocabulary of each company in its form.

## 0.5.0

- IOMAD dashboard layout: company header, tabs, actions grouped by intent.

## 0.4.0

- Vocabulary per IOMAD company (company, department).

## 0.3.0

- Platform vocabulary (course, student, teacher), applied to the whole of Moodle.

## 0.2.x

- Logo colours in the settings, modern login page, colour and logo per IOMAD company.

## 0.1.0

- First version: Boost child theme, accessible palette computed from the brand colour, bundled fonts.
