<?php

use App\Models\SeoMetadata;
use App\Models\Service;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $services = $this->getServices();

        foreach ($services as $index => $serviceData) {
            $processes = $serviceData['processes'] ?? [];
            $faqs = $serviceData['faqs'] ?? [];

            // Extract SEO data
            $seoData = [
                'title' => $serviceData['seo_title'] ?? $serviceData['title'],
                'description' => $serviceData['seo_description'] ?? $serviceData['description'],
                'og_title' => $serviceData['seo_og_title'] ?? null,
                'og_description' => $serviceData['seo_og_description'] ?? null,
            ];
            unset(
                $serviceData['processes'],
                $serviceData['faqs'],
                $serviceData['seo_title'],
                $serviceData['seo_description'],
                $serviceData['seo_og_title'],
                $serviceData['seo_og_description']
            );

            $serviceData['sort_order'] = $index + 1;

            $service = Service::updateOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData
            );

            // Create/update SEO metadata
            SeoMetadata::updateOrCreate(
                ['seoable_type' => Service::class, 'seoable_id' => $service->id],
                $seoData
            );

            // Sync processes
            $service->processes()->delete();
            foreach ($processes as $process) {
                $service->processes()->create($process);
            }

            // Sync FAQs
            $service->faqs()->delete();
            foreach ($faqs as $faqIndex => $faq) {
                $service->faqs()->create(array_merge($faq, ['sort_order' => $faqIndex + 1]));
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Service::query()->each(function (Service $service) {
            $service->processes()->delete();
            $service->faqs()->delete();
            SeoMetadata::where('seoable_type', Service::class)
                ->where('seoable_id', $service->id)
                ->delete();
            $service->delete();
        });
    }

    /**
     * Get all services data.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getServices(): array
    {
        return [
            [
                'slug' => 'webudvikling',
                'title' => 'Websites',
                'headline' => 'Websites udviklet med SSG-teknologier for hurtig indlæsning og bedre SEO.',
                'description' => 'Bygget med Next.js eller Nuxt.js for at udnytte statisk site-generering. Perfekt til marketinglandingssider, blogs og dokumentation.',
                'featured' => true,
                'long_description' => "Jeg udvikler komplette webløsninger fra bunden med fokus på hastighed, sikkerhed og brugeroplevelse. Med Laravel som backend og Nuxt som frontend får du en moderne, vedligeholdelsesvenlig løsning der kan vokse med din virksomhed.\n\nModerne webudvikling handler om mere end bare at få et website op at køre. Det handler om at skabe en digital oplevelse der konverterer besøgende til kunder, performer på alle enheder, og er nem at vedligeholde på lang sigt.\n\nJeg bruger en tech stack der er battle-tested af nogle af verdens største virksomheder: Laravel til robust backend-logik og Nuxt/Vue til hurtige, interaktive brugerflader. Kombinationen giver dig det bedste fra begge verdener - enterprise-grade stabilitet med startup-agtig hastighed.",
                'features' => ['Responsivt design der fungerer perfekt på mobil, tablet og desktop', 'SEO-optimeret arkitektur med server-side rendering', 'Lynhurtig indlæsningstid med static site generation', 'Sikker autentificering med Laravel Sanctum eller Passport', 'Integration med tredjepartstjenester (betalinger, CRM, email)', 'Strukturerede data for bedre Google-visning'],
                'technologies' => ['Laravel', 'Nuxt', 'Vue.js', 'TypeScript', 'Tailwind CSS', 'PostgreSQL'],
                'benefits' => ['Skræddersyet løsning der matcher dine forretningsbehov præcist', 'Skalerbar arkitektur der vokser med din virksomhed', 'Løbende support og vedligeholdelse efter lancering', 'Dokumenteret kode der er nem at overtage'],
                'icon' => 'i-lucide-code',
                'related_services' => ['frontend', 'backend', 'webapp'],
                'use_cases' => ['Virksomhedswebsites med CMS til nem redigering', 'Landingssider til marketingkampagner', 'Kundeportaler med login og personligt indhold', 'Booking- og reservationssystemer', 'Medlemssites med abonnement'],
                'seo_title' => 'Webudvikling med Laravel & Nuxt | Mattias Kieler',
                'seo_description' => 'Professionel webudvikling med Laravel og Nuxt. Få en hurtig, sikker og skalerbar webløsning skræddersyet til din virksomhed. Freelance webudvikler med 10+ års erfaring.',
                'seo_og_title' => 'Webudvikling med Laravel & Nuxt',
                'seo_og_description' => 'Skræddersyede webløsninger bygget med moderne teknologier for optimal performance og skalerbarhed.',
                'processes' => [
                    ['step' => 1, 'title' => 'Kravspecifikation', 'description' => 'Vi gennemgår dine behov, målgruppe og forretningsmål for at definere projektets scope.'],
                    ['step' => 2, 'title' => 'Design & prototyping', 'description' => 'Wireframes og designmockups sikrer vi er enige om udseende og brugerflow før udvikling starter.'],
                    ['step' => 3, 'title' => 'Udvikling', 'description' => 'Iterativ udvikling med regelmæssige demo-sessioner så du kan følge med og give feedback.'],
                    ['step' => 4, 'title' => 'Test & QA', 'description' => 'Grundig test på tværs af browsere og enheder før lancering.'],
                    ['step' => 5, 'title' => 'Lancering & support', 'description' => 'Smidig go-live med overvågning og hurtig support i opstartsfasen.'],
                ],
                'faqs' => [
                    ['question' => 'Hvor lang tid tager det at bygge et website?', 'answer' => 'Et simpelt website kan være klar på 2-4 uger, mens større projekter typisk tager 2-3 måneder. Vi aftaler en realistisk tidsplan baseret på dine specifikke behov.'],
                    ['question' => 'Kan jeg selv redigere indholdet bagefter?', 'answer' => 'Ja, jeg bygger altid med et brugervenligt CMS så du nemt kan opdatere tekster, billeder og andet indhold uden teknisk viden.'],
                    ['question' => 'Hvad koster webudvikling?', 'answer' => 'Prisen afhænger af projektets kompleksitet. Et simpelt website starter typisk fra 25.000 kr, mens større løsninger kan koste 100.000+ kr. Kontakt mig for et konkret tilbud.'],
                ],
            ],
            [
                'slug' => 'webapp',
                'title' => 'Web Applikation',
                'headline' => 'Web applikationer er ideelle til SaaS-platforme og komplekse dashboards med tunge integrationer.',
                'description' => 'Perfekt til SaaS-platforme, sikre portaler, dashboards og produkter med tunge integrationer. Hurtig prototyping med Laravel Breeze eller skræddersyede APIer.',
                'featured' => true,
                'long_description' => "Web applikationer er software der kører i browseren og giver brugere mulighed for at udføre komplekse opgaver - fra at administrere kunder til at analysere data i real-time.\n\nI modsætning til traditionelle websites er web applikationer interaktive værktøjer der ofte erstatter desktop-software eller manuelle processer. Tænk på systemer som Trello, Slack eller dit online regnskabsprogram - det er alle web applikationer.\n\nJeg specialiserer mig i at bygge SaaS-produkter (Software as a Service), interne værktøjer og kundeportaler. Med Laravel og Nuxt som fundament kan jeg levere applikationer der håndterer tusindvis af samtidige brugere, komplekse workflows og real-time data.",
                'features' => ['Multi-tenant arkitektur til SaaS med isolerede kundedata', 'Real-time opdateringer med WebSockets', 'Rollebaseret adgangskontrol (RBAC)', 'Avancerede dashboards med interaktive grafer og rapporter', 'API-først design for nem integration', 'Offline-funktionalitet med service workers'],
                'technologies' => ['Laravel', 'Nuxt', 'Vue.js', 'WebSockets', 'Redis', 'PostgreSQL', 'Inertia.js'],
                'benefits' => ['Skalerbar til tusindvis af brugere uden performance-tab', 'Sikker datahåndtering med encryption og audit logs', 'Nem integration med eksisterende systemer via API', 'Reducerede driftsomkostninger ved at automatisere manuelle processer'],
                'icon' => 'i-lucide-layout-dashboard',
                'related_services' => ['api-udvikling', 'backend', 'webudvikling'],
                'use_cases' => ['SaaS-produkter med abonnementsmodel', 'CRM-systemer tilpasset din branche', 'Projekt- og opgavestyring', 'Booking- og kalendersystemer', 'Business intelligence dashboards', 'Kundeportaler med selvbetjening'],
                'seo_title' => 'Web Applikationer & SaaS Udvikling | Mattias Kieler',
                'seo_description' => 'Udvikling af skræddersyede web applikationer, SaaS-platforme og kundeportaler. Skalerbare løsninger med Laravel og Nuxt. Kontakt for en uforpligtende snak.',
                'seo_og_title' => 'Web Applikationer & SaaS Udvikling',
                'seo_og_description' => 'Kraftfulde web applikationer til din virksomhed. SaaS-platforme, dashboards og kundeportaler.',
                'processes' => [
                    ['step' => 1, 'title' => 'Discovery', 'description' => 'Dybdegående analyse af din forretningsproces og brugernes behov.'],
                    ['step' => 2, 'title' => 'Systemdesign', 'description' => 'Arkitektur, datamodel og tekniske beslutninger dokumenteres.'],
                    ['step' => 3, 'title' => 'MVP udvikling', 'description' => 'Minimum viable product med kernefunktionalitet leveres først.'],
                    ['step' => 4, 'title' => 'Iteration', 'description' => 'Baseret på brugerfeedback udvides og forbedres applikationen.'],
                    ['step' => 5, 'title' => 'Skalering', 'description' => 'Optimering og infrastruktur tilpasses når brugertal vokser.'],
                ],
                'faqs' => [
                    ['question' => 'Hvad er forskellen på et website og en web applikation?', 'answer' => 'Et website præsenterer primært information, mens en web applikation er et interaktivt værktøj hvor brugere kan udføre opgaver, gemme data og interagere med systemet.'],
                    ['question' => 'Kan en web app erstatte min desktop-software?', 'answer' => 'I de fleste tilfælde ja. Web apps har den fordel at de virker på alle enheder og altid er opdaterede. Mange virksomheder migrerer fra desktop til web.'],
                    ['question' => 'Hvordan håndteres sikkerhed i en web applikation?', 'answer' => 'Jeg implementerer industry-standard sikkerhed: krypterede forbindelser (HTTPS), sikker autentificering, input-validering, og beskyttelse mod OWASP Top 10 sårbarheder.'],
                ],
            ],
            [
                'slug' => 'webshop',
                'title' => 'Webshop & E-commerce',
                'headline' => 'E-commerce løsninger der konverterer besøgende til kunder',
                'description' => 'Online butikker med fokus på brugeroplevelse, hastighed og konverteringsoptimering. Fra custom-byggede shops til WooCommerce og Shopify.',
                'featured' => true,
                'long_description' => "En webshop er mere end bare et produktkatalog online. Det er en salgsmotor der skal overbevise besøgende om at købe - og gøre det nemt for dem at gennemføre købet.\n\nJeg bygger webshops der ikke bare ser godt ud, men også performer. Med fokus på Core Web Vitals, checkout-optimering og integration med de rigtige betalingsgateways får du en butik der sælger.\n\nUanset om du vil have en custom-bygget løsning med Laravel, en WooCommerce-baseret shop, eller en headless Shopify-integration, hjælper jeg dig med at vælge den rigtige platform til dine behov og budget.",
                'features' => ['Hurtig checkout-proces med færrest mulige trin', 'Integration med Stripe, Quickpay, MobilePay og andre gateways', 'Automatisk lagerstyring og ordrehåndtering', 'Produktkatalog med varianter, attributter og filtrering', 'Kundekonti med ordrehistorik og ønskelister', 'Abandoned cart emails og remarketing-integration'],
                'technologies' => ['Laravel', 'Nuxt', 'Stripe', 'Shopify', 'WooCommerce', 'Quickpay'],
                'benefits' => ['Højere konverteringsrate gennem optimeret brugeroplevelse', 'Lavere cart abandonment med streamlined checkout', 'Skalerbar til Black Friday og andre spidsbelastninger', 'Automatiserede processer sparer tid på ordrehåndtering'],
                'icon' => 'i-lucide-shopping-cart',
                'related_services' => ['webudvikling', 'wordpress', 'frontend'],
                'use_cases' => ['B2C webshops med fysiske produkter', 'B2B shops med kundespecifikke priser', 'Digitale produkter og downloads', 'Abonnementsbaseret salg (subscription boxes)', 'Markedspladser med flere sælgere'],
                'seo_title' => 'Webshop Udvikling & E-commerce | Mattias Kieler',
                'seo_description' => 'Professionel webshop udvikling med fokus på konvertering. WooCommerce, Shopify og custom e-commerce løsninger. Få en webshop der sælger.',
                'seo_og_title' => 'Webshop & E-commerce Udvikling',
                'seo_og_description' => 'E-commerce løsninger der konverterer. Online butikker med fokus på brugeroplevelse og hastighed.',
                'processes' => [
                    ['step' => 1, 'title' => 'Platform-valg', 'description' => 'Vi vælger den rigtige e-commerce platform baseret på dine behov, produkter og budget.'],
                    ['step' => 2, 'title' => 'Design', 'description' => 'Brugervenligt design med fokus på konvertering og din brandidentitet.'],
                    ['step' => 3, 'title' => 'Opsætning', 'description' => 'Produktkatalog, betalingsgateway og shipping konfigureres.'],
                    ['step' => 4, 'title' => 'Integration', 'description' => 'Forbindelse til regnskab, lager og marketingværktøjer.'],
                    ['step' => 5, 'title' => 'Lancering & optimering', 'description' => 'Go-live med tracking og løbende A/B-test af konverteringselementer.'],
                ],
                'faqs' => [
                    ['question' => 'Skal jeg vælge WooCommerce, Shopify eller custom?', 'answer' => 'Det afhænger af dine behov. WooCommerce er godt til mellemstore shops med mange produkter. Shopify er ideelt til hurtig start. Custom giver mest fleksibilitet til unikke krav.'],
                    ['question' => 'Hvordan håndteres betaling sikkert?', 'answer' => 'Jeg integrerer kun med PCI-compliant betalingsgateways som Stripe og Quickpay, hvor kortoplysninger aldrig rører din server.'],
                    ['question' => 'Kan webshoppen integreres med mit ERP/lager?', 'answer' => "Ja, de fleste ERP-systemer har API'er der kan integreres. Jeg har erfaring med Economic, Dinero, NAV og andre."],
                ],
            ],
            [
                'slug' => 'wordpress',
                'title' => 'WordPress Udvikling',
                'headline' => 'Professionel WordPress udvikling og custom themes',
                'description' => 'Custom themes, plugin-udvikling, WooCommerce og headless WordPress løsninger. Få mest muligt ud af verdens mest populære CMS.',
                'featured' => false,
                'long_description' => "WordPress driver over 40% af alle websites på internettet. Det er et modent, fleksibelt CMS med et enormt økosystem af plugins og themes - og det er ofte det rigtige valg for virksomheder der vil have nem indholdsstyring.\n\nJeg udvikler custom WordPress-løsninger der går langt ud over standard themes. Fra skræddersyede themes der matcher din brandidentitet præcist, til custom plugins der løser specifikke forretningsbehov.\n\nFor virksomheder der vil have det bedste fra begge verdener, tilbyder jeg også headless WordPress-løsninger, hvor WordPress fungerer som CMS bag en lynhurtig Nuxt-frontend.",
                'features' => ['Custom theme udvikling med moderne best practices', 'Plugin-udvikling til specifikke behov', 'Headless WordPress med Nuxt eller Next.js frontend', 'WooCommerce opsætning og tilpasning', 'Performance-optimering af eksisterende WordPress-sites', 'Sikkerhedshærdning og malware-fjernelse'],
                'technologies' => ['WordPress', 'PHP', 'WooCommerce', 'ACF Pro', 'Nuxt', 'REST API', 'GraphQL'],
                'benefits' => ['Kendt CMS som redaktører allerede kender', 'Stort plugin-økosystem til næsten enhver funktion', 'Nem indholdsstyring uden teknisk viden', 'Lavere vedligeholdelsesomkostninger end custom CMS'],
                'icon' => 'i-simple-icons-wordpress',
                'related_services' => ['webudvikling', 'webshop', 'frontend'],
                'use_cases' => ['Virksomhedswebsites med nyheder og blog', 'Medlemssites med beskyttet indhold', 'Online magasiner og medier', 'Porteføljesites for kreative', 'WooCommerce webshops', 'Multisite-netværk for franchise eller koncerner'],
                'seo_title' => 'WordPress Udvikling & Custom Themes | Mattias Kieler',
                'seo_description' => 'Professionel WordPress udvikling med custom themes og plugins. Headless WordPress, WooCommerce og performance-optimering. Freelance WordPress-ekspert.',
                'seo_og_title' => 'WordPress Udvikling & Custom Themes',
                'seo_og_description' => 'Custom themes, plugins og headless WordPress løsninger. Få mest muligt ud af verdens mest populære CMS.',
                'processes' => [
                    ['step' => 1, 'title' => 'Analyse', 'description' => 'Gennemgang af behov og valg af tilgang (theme, plugin, headless).'],
                    ['step' => 2, 'title' => 'Design', 'description' => 'Wireframes og mockups for custom theme eller tilpasninger.'],
                    ['step' => 3, 'title' => 'Udvikling', 'description' => 'Kode udvikles med WordPress best practices og coding standards.'],
                    ['step' => 4, 'title' => 'Content setup', 'description' => 'Custom post types, felter og taxonomier opsættes.'],
                    ['step' => 5, 'title' => 'Lancering', 'description' => 'Migrering, test og go-live med performance-check.'],
                ],
                'faqs' => [
                    ['question' => 'Er WordPress sikkert?', 'answer' => 'WordPress core er sikkert, men plugins og themes kan introducere sårbarheder. Jeg implementerer sikkerhedslag og holder alt opdateret for at minimere risici.'],
                    ['question' => 'Kan WordPress håndtere meget trafik?', 'answer' => 'Ja, med korrekt caching og hosting kan WordPress håndtere millioner af sidevisninger. Store medier som TechCrunch og BBC America bruger WordPress.'],
                    ['question' => 'Hvad er headless WordPress?', 'answer' => "Headless betyder at WordPress kun bruges som CMS (backend), mens frontenden bygges med hurtigere teknologier som Nuxt. Du får WordPress' brugervenlighed med moderne frontend-performance."],
                ],
            ],
            [
                'slug' => 'api-udvikling',
                'title' => 'API Udvikling',
                'headline' => "Robuste API'er der driver dine applikationer",
                'description' => "REST og GraphQL API'er med fokus på sikkerhed, dokumentation og performance. Fundamentet for moderne applikationer og integrationer.",
                'featured' => false,
                'long_description' => "Et API (Application Programming Interface) er den usynlige infrastruktur der forbinder dine systemer og muliggør dataudveksling mellem applikationer. Det er fundamentet for alt fra mobile apps til tredjepartsintegrationer.\n\nJeg udvikler veldokumenterede, sikre og performante API'er der gør det nemt at integrere med andre systemer. Uanset om du har brug for et REST API til din mobile app eller et GraphQL API til komplekse dataforespørgsler, leverer jeg løsninger der holder.\n\nGod API-design handler om mere end bare at returnere data. Det handler om konsistens, versionering, fejlhåndtering og dokumentation der gør det nemt for andre udviklere at integrere.",
                'features' => ['REST API design med OpenAPI/Swagger dokumentation', "GraphQL API'er med type-safety og introspection", 'OAuth2 og JWT-baseret autentificering', 'Rate limiting og caching for høj performance', 'Automatisk genereret dokumentation', 'Versionering og backwards compatibility'],
                'technologies' => ['Laravel', 'GraphQL', 'OpenAPI', 'Redis', 'PostgreSQL', 'JWT', 'OAuth2'],
                'benefits' => ['Nem integration for interne og eksterne udviklere', 'Skalerbar arkitektur der håndterer høj trafik', 'God developer experience med klar dokumentation', 'Fremtidssikret med versionering'],
                'icon' => 'i-lucide-plug',
                'related_services' => ['backend', 'webapp', 'mobil-app'],
                'use_cases' => ['Backend til mobile apps (iOS/Android)', 'Integration mellem interne systemer', 'Tredjeparts-integrationer for partnere', 'Microservices-arkitektur', "Headless CMS API'er", 'IoT device kommunikation'],
                'seo_title' => 'API Udvikling - REST & GraphQL | Mattias Kieler',
                'seo_description' => "Professionel API udvikling med REST og GraphQL. Sikre, veldokumenterede API'er med Laravel. Få et solidt fundament til dine applikationer.",
                'seo_og_title' => 'API Udvikling - REST & GraphQL',
                'seo_og_description' => "Robuste API'er til dine applikationer. REST og GraphQL med fokus på sikkerhed og dokumentation.",
                'processes' => [
                    ['step' => 1, 'title' => 'API design', 'description' => 'Definition af endpoints, datastrukturer og autentificeringsflow.'],
                    ['step' => 2, 'title' => 'Dokumentation først', 'description' => 'OpenAPI spec skrives før implementering for klar kontrakt.'],
                    ['step' => 3, 'title' => 'Implementering', 'description' => 'API bygges med tests og validering.'],
                    ['step' => 4, 'title' => 'Sikkerhed', 'description' => 'Autentificering, authorization og rate limiting implementeres.'],
                    ['step' => 5, 'title' => 'Deployment', 'description' => 'API deployes med monitoring og fejl-alerting.'],
                ],
                'faqs' => [
                    ['question' => 'Hvad er forskellen på REST og GraphQL?', 'answer' => 'REST har faste endpoints med foruddefinerede data. GraphQL lader klienten specificere præcis hvilke data der skal returneres. GraphQL er ofte bedre til komplekse, sammenhængende data.'],
                    ['question' => "Hvordan dokumenteres API'et?", 'answer' => 'Jeg bruger OpenAPI/Swagger til REST og GraphQL introspection til GraphQL. Det giver interaktiv dokumentation hvor udviklere kan teste endpoints direkte.'],
                    ['question' => "Hvordan sikres API'et mod misbrug?", 'answer' => 'Med autentificering (JWT/OAuth2), rate limiting, input-validering og monitoring. Jeg implementerer også CORS-policies og IP-whitelisting ved behov.'],
                ],
            ],
            [
                'slug' => 'frontend',
                'title' => 'Frontend Udvikling',
                'headline' => 'Moderne frontend udvikling med Vue og Nuxt',
                'description' => 'Responsive, hurtige og tilgængelige brugergrænseflader. Fra interaktive dashboards til pixel-perfect marketing sites.',
                'featured' => false,
                'long_description' => "Frontend er det første brugerne møder. Det er den synlige del af din applikation - knapperne de klikker på, formularerne de udfylder, og animationerne der gør oplevelsen levende.\n\nJeg bygger brugergrænseflader der er hurtige, tilgængelige og fungerer på alle enheder. Med fokus på Core Web Vitals og brugeroplevelse skaber jeg frontends der ikke bare ser godt ud, men også performer.\n\nMin primære stack er Vue.js og Nuxt, men jeg arbejder også med React og Next.js. Uanset framework er fokus det samme: ren kode, god performance og en brugeroplevelse der føles naturlig.",
                'features' => ['Komponent-baseret arkitektur med genbrugelige UI-elementer', 'Server-side rendering (SSR) for hurtig first paint og SEO', 'Static site generation (SSG) for maksimal hastighed', 'Smooth animationer og micro-interactions', 'Tilgængelighed (WCAG 2.1) for alle brugere', 'Progressive Web App (PWA) funktionalitet'],
                'technologies' => ['Vue.js', 'Nuxt', 'React', 'Next.js', 'TypeScript', 'Tailwind CSS', 'Framer Motion'],
                'benefits' => ['Lynhurtig indlæsningstid der reducerer bounce rate', 'God SEO gennem server-side rendering', 'Moderne brugeroplevelse der matcher brugernes forventninger', 'Vedligeholdelsesvenlig kode med komponent-arkitektur'],
                'icon' => 'i-lucide-palette',
                'related_services' => ['webudvikling', 'webapp', 'backend'],
                'use_cases' => ['Marketing websites og landingssider', 'Admin dashboards og backoffice', 'E-commerce produktsider', 'Interactive data visualizations', 'Progressive Web Apps', 'Design system implementering'],
                'seo_title' => 'Frontend Udvikling - Vue, Nuxt & React | Mattias Kieler',
                'seo_description' => 'Professionel frontend udvikling med Vue.js, Nuxt og React. Hurtige, tilgængelige brugergrænseflader med fokus på performance og brugeroplevelse.',
                'seo_og_title' => 'Frontend Udvikling - Vue, Nuxt & React',
                'seo_og_description' => 'Moderne frontend udvikling med fokus på hastighed og brugeroplevelse. Vue, Nuxt, React og TypeScript.',
                'processes' => [
                    ['step' => 1, 'title' => 'Design review', 'description' => 'Gennemgang af designs med fokus på interaktioner og edge cases.'],
                    ['step' => 2, 'title' => 'Komponent-planlægning', 'description' => 'Identifikation af genbrugelige komponenter og design system.'],
                    ['step' => 3, 'title' => 'Implementering', 'description' => 'Komponent-by-komponent udvikling med Storybook.'],
                    ['step' => 4, 'title' => 'Integration', 'description' => 'Forbindelse til backend API og state management.'],
                    ['step' => 5, 'title' => 'Performance', 'description' => 'Optimering af bundle size, lazy loading og Core Web Vitals.'],
                ],
                'faqs' => [
                    ['question' => 'Vue eller React - hvad er bedst?', 'answer' => 'Begge er fremragende frameworks. Vue er ofte lettere at lære og har bedre dokumentation. React har større økosystem. Jeg vælger baseret på projektets behov og teamets erfaring.'],
                    ['question' => 'Hvad er Core Web Vitals?', 'answer' => "Google's målinger for brugeroplevelse: Largest Contentful Paint (indlæsning), First Input Delay (interaktivitet) og Cumulative Layout Shift (visuel stabilitet). Gode scores forbedrer SEO."],
                    ['question' => 'Kan du arbejde med vores eksisterende design?', 'answer' => 'Ja, jeg kan implementere designs fra Figma, Sketch, Adobe XD eller andre værktøjer. Jeg samarbejder gerne med dit designteam.'],
                ],
            ],
            [
                'slug' => 'backend',
                'title' => 'Backend Udvikling',
                'headline' => 'Solide backend systemer med Laravel og PHP',
                'description' => 'Skalerbare og sikre backend systemer der håndterer forretningslogik, data og integrationer. Fundamentet for pålidelige applikationer.',
                'featured' => false,
                'long_description' => "Backend er hjertet i din applikation - den usynlige motor der håndterer forretningslogik, lagrer data sikkert, og sørger for at alt fungerer som det skal.\n\nJeg bygger robuste backend-systemer med Laravel som min primære platform. Laravel er det mest populære PHP framework og bruges af virksomheder som Disney, Twitch og The New York Times.\n\nGod backend-udvikling handler om mere end bare at få tingene til at virke. Det handler om sikkerhed, skalerbarhed, testbarhed og performance under pres. Jeg designer systemer der holder, også når din virksomhed vokser.",
                'features' => ['RESTful API design med clean architecture', 'Database design og query-optimering', 'Køsystemer til asynkrone opgaver', 'Caching strategier med Redis', 'Logging, monitoring og alerting', 'Scheduled tasks og background jobs'],
                'technologies' => ['Laravel', 'PHP', '.NET', 'C#', 'Node.js', 'PostgreSQL', 'MySQL', 'Redis'],
                'benefits' => ['Høj oppetid med fejltolerant arkitektur', 'Skalerbar til millioner af requests', 'Sikker datahåndtering med encryption og auditing', 'Testbar kode der reducerer bugs i produktion'],
                'icon' => 'i-lucide-server',
                'related_services' => ['api-udvikling', 'webapp', 'webudvikling'],
                'use_cases' => ["API'er til web og mobile apps", 'Datapipelines og ETL-processer', 'Integrationslag mellem systemer', 'Admin-backends og CMS', 'Background processing og scheduled jobs', 'Microservices og event-driven arkitektur'],
                'seo_title' => 'Backend Udvikling med Laravel & PHP | Mattias Kieler',
                'seo_description' => 'Professionel backend udvikling med Laravel og PHP. Skalerbare, sikre systemer der håndterer forretningslogik og data. Erfaren freelance backend-udvikler.',
                'seo_og_title' => 'Backend Udvikling med Laravel & PHP',
                'seo_og_description' => 'Solide backend løsninger med Laravel. Skalerbare og sikre systemer til din virksomhed.',
                'processes' => [
                    ['step' => 1, 'title' => 'Datamodellering', 'description' => 'Design af database schema og relationer.'],
                    ['step' => 2, 'title' => 'Arkitektur', 'description' => 'Valg af patterns og strukturering af kodebase.'],
                    ['step' => 3, 'title' => 'Implementering', 'description' => 'TDD-drevet udvikling med høj testdækning.'],
                    ['step' => 4, 'title' => 'Optimering', 'description' => 'Query optimization, caching og performance tuning.'],
                    ['step' => 5, 'title' => 'Deployment', 'description' => 'CI/CD pipeline, monitoring og dokumentation.'],
                ],
                'faqs' => [
                    ['question' => 'Hvorfor Laravel fremfor andre frameworks?', 'answer' => 'Laravel har den bedste balance mellem developer experience og enterprise-features. Det er veldokumenteret, har et stort community, og håndterer alt fra små sites til store SaaS-platforme.'],
                    ['question' => 'Hvad med Node.js eller .NET?', 'answer' => 'Jeg arbejder også med Node.js og .NET når projektet kræver det. Node er godt til real-time apps, .NET til enterprise-miljøer med Microsoft-stack.'],
                    ['question' => 'Hvordan sikres database-performance?', 'answer' => 'Gennem proper indexering, query optimization, caching med Redis, og database-specific tuning. Jeg bruger tools som Laravel Telescope til at identificere flaskehalse.'],
                ],
            ],
            [
                'slug' => 'mobil-app',
                'title' => 'Mobil Applikationer',
                'headline' => 'Mobil applikationer udviklet med Flutter eller React Native for enestående ydeevne og brugeroplevelse.',
                'description' => 'Flutter, udviklet af Google, og React Native, udviklet af Meta, er ideelle til at bygge moderne mobilapps. Bygget én gang og deployer til både iOS og Android.',
                'featured' => true,
                'long_description' => "En mobil app giver dig direkte adgang til dine brugeres lommer. Med push-notifikationer, offline-funktionalitet og native device-features kan du skabe oplevelser der ikke er mulige på web.\n\nMed Flutter og React Native bygger jeg apps der kører på både iOS og Android fra én kodebase. Du får native-lignende performance uden at betale for to separate udviklingsteams.\n\nCross-platform betyder ikke kompromis på kvalitet. Moderne frameworks leverer 60fps animationer, adgang til kamera, GPS, biometri og alle de native features dine brugere forventer.",
                'features' => ['Én kodebase til iOS og Android', 'Native performance med 60fps animationer', 'Offline-first med lokal data sync', 'Push notifikationer og deep linking', 'Biometrisk login (Face ID, fingeraftryk)', 'App Store og Play Store deployment'],
                'technologies' => ['Flutter', 'Dart', 'React Native', 'Firebase', 'Expo', 'SQLite'],
                'benefits' => ['Hurtigere time-to-market end native udvikling', 'Lavere udviklingsomkostninger med én kodebase', 'Konsistent brugeroplevelse på tværs af platforme', 'Nemmere vedligeholdelse med shared codebase'],
                'icon' => 'i-lucide-smartphone',
                'related_services' => ['api-udvikling', 'backend', 'webapp'],
                'use_cases' => ['B2C apps med brugerengagement', 'Field service apps til medarbejdere', 'E-commerce companion apps', 'Fitness og health tracking', 'Social og community apps', 'IoT device control'],
                'seo_title' => 'Mobil App Udvikling - Flutter & React Native | Mattias Kieler',
                'seo_description' => 'Cross-platform app udvikling med Flutter og React Native. iOS og Android apps fra én kodebase. Erfaren freelance app-udvikler i Danmark.',
                'seo_og_title' => 'Mobil App Udvikling - Flutter & React Native',
                'seo_og_description' => 'Native-lignende apps til iOS og Android med Flutter og React Native. Hurtigere time-to-market.',
                'processes' => [
                    ['step' => 1, 'title' => 'Koncept & UX', 'description' => 'Brugerflows og wireframes for mobil kontekst.'],
                    ['step' => 2, 'title' => 'Platform valg', 'description' => 'Flutter vs React Native baseret på projektets behov.'],
                    ['step' => 3, 'title' => 'MVP udvikling', 'description' => 'Kernefunktionalitet implementeres og testes på device.'],
                    ['step' => 4, 'title' => 'Beta test', 'description' => 'TestFlight og Play Console beta-distribution.'],
                    ['step' => 5, 'title' => 'App Store launch', 'description' => 'Submission, review-proces og udgivelse.'],
                ],
                'faqs' => [
                    ['question' => 'Flutter eller React Native?', 'answer' => 'Flutter har bedre performance og mere konsistent UI. React Native er godt hvis dit team allerede kender React. Jeg anbefaler Flutter til de fleste projekter.'],
                    ['question' => 'Hvor lang tid tager app store godkendelse?', 'answer' => 'Apple tager typisk 1-3 dage, Google et par timer til en dag. Første submission kan tage længere. Jeg hjælper med at undgå afvisninger.'],
                    ['question' => 'Skal jeg have en app eller bare en PWA?', 'answer' => 'PWA er godt til simple use cases. En native app giver bedre performance, push notifications og App Store tilstedeværelse der bygger troværdighed.'],
                ],
            ],
            [
                'slug' => 'cross-platform-apps',
                'title' => 'Cross Platform Apps',
                'headline' => 'Applikationer der kan køre på tværs af platforme som Windows, Linux, macOS, iOS og Android.',
                'description' => 'Bygget med .NET (MAUI eller Blazor), Flutter eller React Native. Ideel til applikationer der skal køre på tværs af platforme.',
                'featured' => true,
                'long_description' => "Cross-platform udvikling giver dig mulighed for at nå brugere på alle enheder med én kodebase. Uanset om dine brugere sidder på Windows, macOS, Linux eller mobile enheder, kan de få adgang til din applikation.\n\nMed teknologier som .NET MAUI, Blazor, Flutter og React Native bygger jeg applikationer der føles native på hver platform, mens du kun betaler for én udviklingsindsats.\n\nDenne tilgang er særligt velegnet til interne værktøjer i større virksomheder, hvor medarbejdere bruger forskellige enheder og operativsystemer.",
                'features' => ['Én kodebase til alle platforme', 'Native performance på hver platform', 'Konsistent brugeroplevelse på tværs af enheder', 'Reducerede udviklingsomkostninger', 'Hurtigere time-to-market', 'Nemmere vedligeholdelse'],
                'technologies' => ['.NET', 'MAUI', 'Blazor', 'Azure', 'Flutter', 'Dart', 'React Native'],
                'benefits' => ['Når alle brugere uanset platform', 'Lavere udviklingsomkostninger end separate native apps', 'Hurtigere opdateringer på tværs af platforme', 'Ideel til enterprise-miljøer med mixed devices'],
                'icon' => 'i-lucide-monitor-smartphone',
                'related_services' => ['mobil-app', 'backend', 'webapp'],
                'use_cases' => ['Interne virksomhedsværktøjer', 'Field service applikationer', 'Produktivitetsapps til teams', 'Desktop-to-mobile migration', 'Enterprise software modernisering'],
                'seo_title' => 'Cross Platform App Udvikling | Mattias Kieler',
                'seo_description' => 'Udvikling af cross-platform applikationer til Windows, Linux, macOS, iOS og Android med .NET MAUI, Flutter og React Native.',
                'seo_og_title' => 'Cross Platform App Udvikling',
                'seo_og_description' => 'Applikationer der kører på alle platforme fra én kodebase.',
                'processes' => [
                    ['step' => 1, 'title' => 'Platform analyse', 'description' => 'Identificering af hvilke platforme der skal understøttes og deres krav.'],
                    ['step' => 2, 'title' => 'Teknologivalg', 'description' => '.NET MAUI, Flutter eller React Native baseret på krav og eksisterende stack.'],
                    ['step' => 3, 'title' => 'UI/UX design', 'description' => 'Design der føles native på hver platform.'],
                    ['step' => 4, 'title' => 'Udvikling', 'description' => 'Fælles kodebase med platform-specifikke tilpasninger.'],
                    ['step' => 5, 'title' => 'Test & deployment', 'description' => 'Test på alle platforme og distribution via relevante kanaler.'],
                ],
                'faqs' => [
                    ['question' => 'Hvilken teknologi er bedst til cross-platform?', 'answer' => '.NET MAUI er ideel hvis du allerede bruger Microsoft-stack. Flutter giver bedst performance og UI. React Native er godt for teams med JavaScript-erfaring.'],
                    ['question' => 'Er cross-platform lige så godt som native?', 'answer' => 'Moderne cross-platform frameworks leverer næsten native performance. For de fleste business apps er forskellen ubetydelig.'],
                    ['question' => 'Kan jeg inkludere desktop og mobil i samme app?', 'answer' => 'Ja, med .NET MAUI og Flutter kan du bygge én app der kører på Windows, macOS, Linux, iOS og Android.'],
                ],
            ],
            [
                'slug' => 'konsulent',
                'title' => 'Teknisk Konsulent',
                'headline' => 'Strategisk teknisk rådgivning og fractional CTO',
                'description' => 'Arkitektur, code reviews, teknologivalg og team mentoring. Få erfaren teknisk ledelse uden fuldtids-omkostninger.',
                'featured' => true,
                'long_description' => "Ikke alle virksomheder har brug for en fuldtids CTO, men alle har brug for solide tekniske beslutninger. Som teknisk konsulent eller fractional CTO hjælper jeg med at træffe de rigtige valg på de rigtige tidspunkter.\n\nFra arkitektur og teknologivalg til code reviews og team mentoring - jeg bringer erfaring fra mange projekter og brancher ind i din virksomhed.\n\nTypiske engagementer inkluderer teknisk due diligence før investeringer, arkitektur-reviews af eksisterende systemer, hjælp med at skalere udviklingsteams, og rådgivning om modernisering af legacy-systemer.",
                'features' => ['Arkitektur og systemdesign reviews', 'Teknologivalg og roadmap-planlægning', 'Code review og kvalitetssikring', 'Team mentoring og best practices', 'Due diligence på teknisk gæld', 'Vendor selection og outsourcing rådgivning'],
                'technologies' => ['Arkitektur', 'DevOps', 'CI/CD', 'Agile', 'Scrum', 'Cloud (AWS/GCP/Azure)'],
                'benefits' => ['Undgå dyre fejlbeslutninger tidligt', 'Bedre teknisk kvalitet i leverancer', 'Hurtigere onboarding af nye udviklere', 'Objektiv vurdering uden intern bias'],
                'icon' => 'i-lucide-lightbulb',
                'related_services' => ['webudvikling', 'backend', 'api-udvikling'],
                'use_cases' => ['Teknisk due diligence før investering/acquisition', 'Arkitektur-review af legacy-systemer', 'Skalering af udviklingsorganisation', 'Cloud migration strategi', 'Fractional CTO for startups', 'Vendor og contractor management'],
                'seo_title' => 'Teknisk Konsulent & Fractional CTO | Mattias Kieler',
                'seo_description' => 'Erfaren teknisk konsulent og fractional CTO. Arkitektur, code reviews, teknologivalg og team mentoring. Få strategisk teknisk ledelse.',
                'seo_og_title' => 'Teknisk Konsulent & Fractional CTO',
                'seo_og_description' => 'Strategisk teknisk rådgivning. Arkitektur, code reviews og teknologivalg fra erfaren CTO.',
                'processes' => [
                    ['step' => 1, 'title' => 'Discovery', 'description' => 'Forståelse af din forretning, udfordringer og mål.'],
                    ['step' => 2, 'title' => 'Analyse', 'description' => 'Gennemgang af eksisterende systemer, kode og processer.'],
                    ['step' => 3, 'title' => 'Anbefalinger', 'description' => 'Konkrete, prioriterede anbefalinger med cost/benefit.'],
                    ['step' => 4, 'title' => 'Implementering', 'description' => 'Hands-on hjælp eller supervision af udførelsen.'],
                    ['step' => 5, 'title' => 'Opfølgning', 'description' => 'Løbende sparring og justering efter behov.'],
                ],
                'faqs' => [
                    ['question' => 'Hvad er en fractional CTO?', 'answer' => 'En fractional CTO er en deltids teknisk leder der giver dig CTO-ekspertise uden fuldtids-omkostninger. Typisk 1-2 dage om ugen, skalerbart efter behov.'],
                    ['question' => 'Hvordan foregår et typisk engagement?', 'answer' => 'Vi starter med et discovery-møde, derefter en analyse-fase, og så løbende rådgivning. Engagementer kan være projektbaserede eller løbende retainer.'],
                    ['question' => 'Kan du hjælpe med at vurdere vores udviklere/leverandører?', 'answer' => 'Ja, jeg laver code reviews og tekniske assessments. Jeg kan også hjælpe med at definere interviewprocesser og tekniske tests.'],
                ],
            ],
            [
                'slug' => 'hosting',
                'title' => 'Managed Hosting',
                'headline' => 'Bekymringsfri managed hosting til din webløsning',
                'description' => 'Slut med at bekymre dig om servere, opdateringer og sikkerhed. Jeg tager mig af alt det tekniske så du kan fokusere på din forretning.',
                'featured' => false,
                'long_description' => "Med managed hosting tager jeg mig af alt det tekniske - fra serveropsætning til daglige backups og sikkerhedsopdateringer - så du kan fokusere på det, du er bedst til: at drive din forretning.\n\nMange virksomheder undervurderer kompleksiteten i at drive en webserver sikkert og effektivt. Det kræver konstant opmærksomhed på sikkerhedsopdateringer, performance-optimering og overvågning. Med managed hosting får du enterprise-grade infrastruktur uden enterprise-priser eller teknisk hovedpine.\n\nJeg tilbyder hosting-løsninger der er skræddersyet til Laravel og Nuxt applikationer. Det betyder optimeret performance, korrekt konfiguration og hurtig support når du har brug for det.",
                'features' => ['Automatiske opdateringer uden nedetid', 'Daglige backups med 30 dages retention', "Gratis SSL-certifikater via Let's Encrypt", 'Proaktiv 24/7 overvågning med alerts', 'Direkte support uden ventetid', 'Skalerbar infrastruktur der vokser med dig'],
                'technologies' => ['Linux', 'Nginx', 'PHP', 'Node.js', 'PostgreSQL', 'Redis', 'Docker'],
                'benefits' => ['Fokuser på din forretning, ikke på servere', 'Enterprise-grade sikkerhed uden kompleksitet', 'Hurtig dansk support når du har brug for det', 'Ingen overraskelser - fast månedlig pris'],
                'icon' => 'i-lucide-server-cog',
                'related_services' => ['webudvikling', 'webapp', 'backend'],
                'use_cases' => ['Laravel applikationer med høje performance-krav', 'Nuxt/Vue sites med SSR eller SSG', 'WordPress sites der kræver stabilitet', 'E-commerce shops med behov for høj oppetid', 'SaaS-platforme med skalerbare behov'],
                'seo_title' => 'Managed Hosting til Laravel & Nuxt | Mattias Kieler',
                'seo_description' => 'Bekymringsfri managed hosting til din Laravel eller Nuxt applikation. Automatiske opdateringer, daglige backups, SSL, 24/7 monitoring og hurtig dansk support.',
                'seo_og_title' => 'Managed Hosting til Laravel & Nuxt',
                'seo_og_description' => 'Bekymringsfri managed hosting med automatiske opdateringer, daglige backups og dansk support.',
                'processes' => [
                    ['step' => 1, 'title' => 'Behovsanalyse', 'description' => 'Vi gennemgår dine krav til performance, sikkerhed og skalerbarhed.'],
                    ['step' => 2, 'title' => 'Serveropsætning', 'description' => 'Jeg opsætter og konfigurerer serveren optimeret til din applikation.'],
                    ['step' => 3, 'title' => 'Migrering', 'description' => 'Din eksisterende løsning migreres med minimal eller ingen nedetid.'],
                    ['step' => 4, 'title' => 'Monitoring', 'description' => 'Overvågning og alerting opsættes for proaktiv fejlhåndtering.'],
                    ['step' => 5, 'title' => 'Løbende drift', 'description' => 'Jeg håndterer opdateringer, backups og support løbende.'],
                ],
                'faqs' => [
                    ['question' => 'Hvad er forskellen på managed hosting og alm. webhotel?', 'answer' => 'Med managed hosting får du en dedikeret server der er optimeret til din applikation, proaktiv overvågning, og direkte support fra mig. Et webhotel er delt med hundredvis af andre og har begrænset support.'],
                    ['question' => 'Kan jeg flytte min eksisterende løsning?', 'answer' => 'Ja, jeg hjælper med at migrere din eksisterende applikation. Migreringen planlægges så nedetid minimeres eller helt undgås.'],
                    ['question' => 'Hvad sker der hvis serveren går ned?', 'answer' => 'Jeg modtager automatisk alerts og reagerer hurtigt. De fleste problemer løses før du bemærker dem. Ved større issues kontakter jeg dig proaktivt.'],
                ],
            ],
        ];
    }
};
