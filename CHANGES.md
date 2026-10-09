# Changes

## 0.28.6 (beta)

- Error pages: instead of Moodle's red box, a card in the colours of the brand says in plain words what happened (page not found, access denied, content not available, session expired, other error), keeps Moodle's message and leads to the dashboard, or to the login page. Moodle's « page not found » page gets the same card.
- User tours: their steps in the colours of the theme, in light and dark mode, with the element shown outlined in the brand colour.
- Printed pages and their PDF: the logo and name of the site, or of the IOMAD company, over a line of the brand colour, then the title of the page (which Boost leaves out) and its content, without the menus, panels and buttons of the screen. Dark mode is now for screens only: printed pages stay light.

## 0.28.5 (beta)

- Corner style: the choices are named for what they do, « Slightly rounded (almost square corners) », « Moderately rounded » and « Very rounded », instead of « Sharp », « Soft » and « Round » (« Net », « Doux », « Arrondi » in French, where « Net » could be read as clearly rounded). A help text gives the size of the corners, in the settings of the site and in the form of the IOMAD companies.
- IOMAD: a company can use a font of its own, uploaded in its form (name, normal and bold files, woff2 or woff), or the font uploaded for the site, besides the 8 bundled fonts. Without a normal file, the font of the site is kept.

## 0.28.4 (beta)

- IOMAD: a company can set in its form (Edit company › Appearance) more of the settings of the site, each « As the site » by default:
  - identity: accent colour (with a colour picker) and corner style; on Moodle 4.5 the corners compiled into Bootstrap 4 keep those of the site;
  - e-mails in the colours of the brand, by the company of the recipient;
  - navigation: breadcrumb, quick search, activity pages, blocks and dashboard on phones;
  - pages: course catalogue, progress of the sections, My courses by role;
  - login page: layout, headline and supporting text.
- IOMAD login page of a company (its own address or its link login/index.php?id=…&code=…): it now takes the colours, logo, font, name and footer of the company, as its pages do once logged in, instead of those of the site.

## 0.28.3 (beta)

- Display preferences panel (« Aa ») on phones and small tablets: aligned on its button, which is not at the right of the screen there, it went out of the screen on the left. It now opens under the header with the same margin on both sides, and stops above the navigation bar at the bottom of the screen. Unchanged on computers.

## 0.28.2 (beta)

- Edit mode switch on phones: Moodle hides its label for lack of room, which left a switch without a word. A pencil, Moodle's icon to edit, now stands before it, in the brand colour once the edit mode is on; tapping it toggles the switch, and screen readers still read « Edit mode ». The header keeps fitting 360 pixels.
- Quick search button of the header (« Search Ctrl K »): it took the whole height of the header in a grey box that made it look disabled. It is now a search field at the height of the other controls of the header, on the surface with a light border, in light and dark mode and in the brand-coloured header.

## 0.28.1 (beta)

- Activity chooser, in the colours of the theme, in light and dark mode, on Moodle 4.5 (tabs and cards) and 5.x (categories and list):
  - the names of the activities are in the colour of the text, instead of a grey that could not be read in dark mode;
  - the active tab or category takes the brand colour instead of Moodle's blue, and the others are no longer white in dark mode;
  - the activity under the pointer or reached with the keyboard is outlined with the brand, the chosen one tinted with it;
  - the details of an activity and the footer of the window are no longer white in dark mode.
- Tabs on phones: Moodle turns them into buttons on a grey strip, the active one in its blue and the others white, also in dark mode. They take the colours of the theme, the active one the brand colour.
- Dark mode: the links of the dialogue windows (« More help »…) are readable, and the close button of the windows of Moodle 4.5 no longer disappears.
- Activity chooser of Moodle 4.5: the icon of the details of an activity follows the « Activity icons » setting, in the brand colour when it is chosen, light in dark mode otherwise.
- H5P icon: it follows the « Activity icons » setting as the other activities, instead of staying blue (Moodle leaves the logos of brands in their colours), in the activity chooser, on the course page and on the page of the activity. With the brand colour it takes it; with Moodle's colours it takes the one of the interactive contents, as the lessons and the IMS packages.
- Text editor (TinyMCE): the active buttons and menus, the chosen items, the frame of the text and the focus take the brand colour instead of TinyMCE's blue. The editor stays white in dark mode, so it takes the light version of the brand colour, of the company with IOMAD.
- Checked: on Moodle 4.5 and 5.1, about sixty pages (course, activities, calendar, messaging, profile, grades, reports, settings, forms, menus and drawers open), on computer and phone, light and dark, under the pointer and with the keyboard, no longer show Moodle's blue. The information messages and the colour of the user events of the calendar keep their own colours.

## 0.28.0 (beta)

- Messaging, on its page and in its drawer:
  - the messages are bubbles, mine in a tint of the brand on the right, the others' neutral on the left;
  - the days are small titles between two lines;
  - the conversation under the pointer or reached with the keyboard takes a tint of the brand instead of the brand colour;
  - the field to write is rounded and the send button takes the brand colour.
  On phones, the list of the conversations and the conversation open are shown one under the other, the conversation first, instead of two narrow columns side by side.
- Choice: each answer is a card that can be clicked as a whole, the chosen one marked with the brand, as the answers of the quizzes and lessons. The chart of the results keeps a readable size.
- Charts: the charts of the pages of Épure (results of a choice and others) are drawn in shades of the brand colour, of the user's company with IOMAD, readable on the light and the dark surfaces, instead of Moodle's yellow and purple. A site that sets its own colours for the charts (`$CFG->chart_colorset`) keeps them.
- Profile and preferences: the person is shown in a header on a tint of the brand. The links of the cards become the rows of a menu, with the whole row as the target and an arrow on the right, and « Edit profile » is a small button in the title of its card.
- Database: the entries are compact cards, with the names of the fields as small grey titles and the empty tags hidden. The search and sort options are grouped in a light box, and on phones the author and the dates of an entry stay readable.
- Wiki: the table of contents is a light box marked with the brand, the text keeps a readable width and the « edit » links of the sections are discreet.
- Feedback: each question is a numbered card, and the answers of a multiple choice are rows that can be clicked as a whole, the chosen one marked with the brand.
- Workshop in dark mode: the icons of the tasks (to do, done, failed, information) have light versions, readable on the dark surfaces.
- Accessibility (axe-core, WCAG 2.2 AA, light and dark): the « Clear all » link of the database search is underlined.

## 0.27.1 (beta)

- H5P: the older versions of the course presentation (before 1.26) and of the audio player (before 1.5.24), still installed on many sites, wrote their blue in their own style sheets and did not use the H5P theme colours. The progress bar of the slides, the buttons that open an element (image, text…) and the audio buttons now take the brand colour, of the company with IOMAD.

## 0.27.0 (beta)

- Corners: each level of the course page is a step less rounded than the one holding it. Sections have the large radius, their activities and subsections the medium one, and the activities of a subsection the small one. Chips, counters, badges and the search field follow the corner style too: pills with « Soft » and « Round », rounded rectangles with « Sharp » (they kept fixed corners before).
- Calendar: the events of the month are labels in a tint of the colour of their type (site, course, category, group, user) over two lines, instead of a name cut after a few letters behind a small circle. The day numbers keep the colour of the text in dark mode, and the weekends are tinted. On phones, the names of the previous and next months stay on one line and the dots under the days take the brand colour. The cards of the day and upcoming events are marked with the colour of their type, with a smaller title and the details next to their icons.
- Settings forms, lighter: the help question marks are grey instead of Moodle's teal and take the brand colour under the pointer. Section titles are smaller and their fold button has no grey square. The five lists of a date are narrower. The items chosen in an autocomplete field are labels tinted with the brand, outlined only while the list has the focus.
- Workshop: the phases in the colours of the theme, the current one in a tint of the brand instead of lime green, with task links large enough to tap. Feedback: the titles of the overview are smaller and set apart. Messaging page: a single rounded frame instead of a grey box inside the card. Profile: the titles of the cards are in bold.
- Dark mode: the user report and the gradebook setup no longer show white rows and headers. The light badges and the plugin counters are readable.
- Accessibility (axe-core, WCAG 2.2 AA, light and dark): the class names of the scheduled tasks have enough contrast. So does the highlighted cell of the quiz results, now in a tint of the brand instead of light blue. The check box next to a field of the same group (« Enable » of the word limit) is a target of 24 pixels.

## 0.26.0 (beta)

- Theme settings grouped by subject: **Identity** (logos, colours, e-mails, vocabulary), **Navigation** (main bar, quick search, breadcrumb, user menu), **Courses** (cards, progress, activities), **Accessibility** (display preferences, accessibility statement), **Appearance** (typography, shapes and density, dark mode), **Mobile** (phones, applications), then the login page, footer and advanced tabs. The names of the settings do not change: the values already saved are kept, there is nothing to migrate. The main bar and the user menu link to Moodle's custom menu items and user menu items.
- New settings: a logo for phones, shown in the phone header where Moodle shows no logo; a favicon; an accent colour for the progress bars and the completed sections (empty: the brand colour; an IOMAD company with its own colour keeps it everywhere); the breadcrumb (shown, on large screens only, or hidden); the progress of the sections, which was part of the course banner and now also shows without it; the density (comfortable or compact); the blocks on phones (in their drawer or hidden) and the dashboard on phones (overview and blocks, or overview only).
- Accessibility: the button « Aa » can be turned off, and the display by default of the site can be set for visitors and for users who did not choose theirs: text size, reading font, more text spacing, enhanced contrast, underlined links, reduced motion.
- Installable web app (Mobile tab, off by default): the platform can be added to the home screen of phones and computers from the browser, with its name, short name, brand colour (of the user's company with IOMAD) and icon (uploaded, or the initial of the site on the brand colour). A service worker only keeps a page « You are offline », shown when a page cannot load; nothing else is cached, Moodle's pages always come from the network. Turned off, or when the user no longer sees Épure, the service worker removes itself and its cache.
- Subsections (Moodle 4.5 and later): the activities of a subsection come at the place of the subsection in the course order, for the next activity (banner, My courses, dashboard), the position « Activity n of N » and the previous and next activities, which show « Section › Subsection ». A section counts the activities of its subsections in its progress, and each subsection gets its own progress; the outline of the course introduction counts them in their section. On the course page, subsections are set apart by a tinted background and a band of the brand colour, in light and dark mode.
- Performance: the progress, next activity and next deadline of the courses of a learner, and their next deadlines, are kept 5 minutes in a cache, forgotten at once when an activity or a course is completed, an assignment submitted or a quiz attempt submitted, and when the activities or the completion of the course change. On Moodle 4.5 with 3 courses, the learner overview goes from about 60–80 ms to about 5 ms once cached.
- IOMAD 5.1 moved the completion tracking from local_iomad_track into local_iomad: the frames of the certificates of the companies that left Épure are now also given back on the pages of local/iomad, local/report_users, admin/tool/redocerts and the « My courses » blocks, and in command-line scripts (scheduled tasks).
- Tests: Behat now also runs on IOMAD 4.5, 5.1 and 5.2, without two IOMAD Behat contexts that stop Behat (auth_iomadsaml2's, incompatible on IOMAD 4.5, and tool_iomadpolicy's, which defines again a step of tool_policy). A scenario checks that a learner of a company sees the colour and logo of their company, that a user without company keeps the site colour, and that IOMAD's « My courses » is Épure's page by role, with axe-core. The IOMAD scenarios (tag @theme_epure_iomad) run on IOMAD, the others on Moodle.

## 0.25.0 (beta)

- IOMAD 5.1 and 5.2: IOMAD 5.1 renamed its tables and classes, and Épure did not see IOMAD on it at all. Everything Épure uses of IOMAD now goes through one class, which knows IOMAD before and after 5.1; IOMAD's « My courses » block of 5.1 (block_iomad_mycourses) gets the page by role too. Verified on IOMAD 4.5 and 5.1; the continuous integration tests IOMAD 4.5, 5.1 and 5.2.
- Moodle 5.3: the button of the side drawer of the blocks was drawn over the content, on the left (Moodle 5.3 places the drawers from the width of the content, which Épure set to « none »). The drawers and their buttons are against the edges of the screen again.
- Format « Single activity »: no strip nor previous and next activities, as the activity is the course (« Back to the course » led to the same page).
- With IOMAD, today in the calendars and the chosen company of the selector take the colour of the company.
- Unexpected errors (theme of a company, loading of a theme) are reported in developer debugging mode instead of being silent.
- Code: the styles are split by subject in scss/epure/ (the compiled style sheet is the same).
- Tests: Behat scenarios of the course formats Topics, Weeks with a subsection, Single activity and Social, with axe-core. Performance measured against Boost (wiki, Développement).

## 0.24.0 (beta)

- Activity icons can be hidden, for the site and, with IOMAD, for each company: no icons on the course page, the dashboard blocks, the calendar and the activity pages; the activity chooser of the teachers keeps them.
- Moodle app in the colours of the brand: a setting (Pages and navigation) gives the app the style sheet of the theme, with the brand colour, the header and the font, in light and dark mode; with IOMAD, those of the company of the user. The theme sets Moodle's « CSS » of the mobile appearance and gives it a new address at each change of the appearance, for the apps to download it again.
- Forums (posts as cards, the thread shown by a line), glossaries (index as buttons, entries as cards), assignments (status as a card), SCORM (description and information as boxes, table of contents of the player in the brand colour), books and pages (current chapter, chapter arrows and quotations in the brand colour, text at a readable length).
- The sections and activities of the course page, and the squares of the activity icons, follow the corner style of the theme (Moodle gave them fixed corners).
- IOMAD certificates: in the company form, a frame in the brand colour of the company can be used for its certificates. When the company (or the site) leaves Épure, the frame it had before and its « Use border » setting come back.
- Badges: the badges of the user as cards, the page of a badge with its image on a tint of the brand.
- Reports: the row under the pointer highlighted in the grader report, the completion report and the IOMAD reports; IOMAD's tree of departments as a box of the theme.
- With IOMAD, the pages and initials of the tables, the pills, the active items of the lists and the buttons that expand the sections of the forms take the colour of the company (they kept the colour of the site).
- Accessibility: the links among text of the completion report and of the badges page are underlined, and the downloads of the completion report are large enough targets.

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
