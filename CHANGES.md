# Changes

## 0.23.0 (beta)

- Colours of the activity icons: in the brand colour (the default) or in Moodle's colours by kind of activity, for the site and, with IOMAD, for each company.
- H5P in the colours of the brand (of the company with IOMAD): buttons, chosen answers, score and progress bars, for the recent content types (H5P theme variables) and the older ones; the green and red of the answers are kept.
- Quizzes: question on a light tint of the brand, feedback in a neutral box, clearer quiz navigation. Lessons: answers as cards one under the other, progress bar in the brand colour. Radio buttons and check boxes in the brand colour. The summary of a quiz attempt is readable in dark mode, and the progress bar of the lessons has a name for screen readers.

## 0.22.4 (beta)

- Header: on computers too, the quick search replaces Moodle's search button (two magnifying glasses side by side). When Moodle's global search is enabled, the results of the quick search end with « Search … in the whole site », which opens it.

## 0.22.3 (beta)

- IOMAD: the pages take the theme of the company being worked on, for administrators too. An administrator who selects a company in IOMAD sees the pages as its users see them, in its theme (from the page where the company is chosen); without a company, the theme of the site. A theme that IOMAD sets from the address of a company is kept.

## 0.22.2 (beta)

- IOMAD: a company can choose Épure whatever the theme of the site. When the site uses another theme (Iomad, for example), the company form now shows the Épure settings as soon as Épure is chosen for the company, with their own styles.
- A change of theme of an IOMAD company applies at once to its users already logged in: IOMAD writes the new theme on them, but Moodle kept the former one in their session until they logged in again, so they kept seeing Épure (dashboards, course pages…).
- Phones: the quick search button is a round icon like the others, and replaces Moodle's search in the header (two magnifying glasses side by side); a long company name is cut instead of pushing the user menu out.
- Mobile navigation bar: labels on up to two lines instead of being cut (« Tableau de bord », « Mes formations »), and « Messages » as a short label.
- Another theme stays as it is without Épure. In the IOMAD company form, choosing another theme for the company shows IOMAD's form exactly as IOMAD shows it (order, fields, note), without any Épure field; choosing Épure again restores the steps. The Épure settings of the company are kept for a return to Épure.
- The words of the IOMAD companies (vocabulary) only apply to the users who see the pages with Épure: with another theme (for the site, the company or the session), the words of the language pack are kept.
- The e-mails in the colours of the brand are not sent to the users of a company that uses another theme: they get the e-mails of Moodle.

## 0.22.0 (beta)

- Theme settings in a clearer order: **Brand identity** (the logos first, then the brand colour, which proposes their colours, and the header colour), **Typography and display** (font, corners, dark mode), **Pages and navigation** (what the theme adds to Moodle's pages, grouped by Navigation, Pages, Vocabulary, E-mails), then the login page, footer, accessibility and advanced tabs. The values already saved are kept. A logo just uploaded proposes its colours before it is saved.
- « Moodle is working » indicator also on the pages of Moodle's maintenance layout: validation of a plugin ZIP file, plugins check and upgrade. While the upgrade runs, a message stays in a corner of the page until it is complete.
- IOMAD company form: the Appearance part is arranged in numbered steps, organised as the tabs of the theme settings (theme, brand identity with the logos then the colours, typography and display, pages and navigation, footer, vocabulary, advanced settings), each in its own card. IOMAD's own fields (theme, logos, favicon, custom CSS and menu) are moved into these steps: the logos now come before the colours, which are proposed from the logo.
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
