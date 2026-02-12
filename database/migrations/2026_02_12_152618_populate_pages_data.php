<?php

use App\Models\Author;
use App\Models\Component;
use App\Models\Page;
use App\Models\SeoMetadata;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $author = $this->seedAuthor();
        $this->seedHomePage($author);
        $this->seedServicesPage($author);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $pages = Page::whereIn('slug', ['home', 'services'])->get();

        foreach ($pages as $page) {
            $page->components()->each(function (Component $component) {
                $component->data()->delete();
                $component->delete();
            });

            SeoMetadata::where('seoable_type', Page::class)
                ->where('seoable_id', $page->id)
                ->delete();

            $page->delete();
        }

        Author::where('email', 'hello@mkieler.dev')->delete();
    }

    /**
     * Seed the default author.
     */
    private function seedAuthor(): Author
    {
        return Author::updateOrCreate(
            ['email' => 'hello@mkieler.dev'],
            [
                'name' => 'Mattias Kieler',
                'job_title' => 'Fractional CTO og senior fullstack-udvikler',
                'image' => '~/assets/img/mig.png',
                'bio' => 'Med en dyb passion for at analysere komplekse forretningsprocesser arbejder jeg på at finde innovative måder at optimere dem gennem skræddersyede softwareløsninger.',
            ]
        );
    }

    /**
     * Seed the homepage.
     */
    private function seedHomePage(Author $author): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'name' => 'Forside',
                'author_id' => $author->id,
            ]
        );

        // SEO Metadata
        SeoMetadata::updateOrCreate(
            ['seoable_type' => Page::class, 'seoable_id' => $page->id],
            [
                'title' => 'Mattias Kieler | Laravel + Nuxt-specialist til ydeevnestærke webprodukter',
                'description' => 'Marketingsider, SaaS-platforme og interne værktøjer, der føles øjeblikkelige takket være Nuxt statisk generering, solide Laravel-backends og pragmatisk ingeniørarbejde.',
                'og_title' => 'Mattias Kieler | Laravel + Nuxt-specialist',
                'og_description' => 'Marketingsider, SaaS-platforme og interne værktøjer med Nuxt og Laravel.',
                'og_image' => '/og-image.jpg',
            ]
        );

        // Components
        $this->seedHomePageComponents($page);
    }

    /**
     * Seed homepage components.
     */
    private function seedHomePageComponents(Page $page): void
    {
        // Delete existing components for this page
        $page->components()->each(function (Component $component) {
            $component->data()->delete();
            $component->delete();
        });

        // Hero component
        $this->createComponent($page, 'FrontpageHero', [
            'eyebrow' => 'Fullstack-udvikling | Web & Software | Freelance & fuldtid',
            'headline' => 'Fra produktidé til robust og skalerbar web eller software-løsning',
            'supporting_text' => 'Uanset om du har brug for en freelancepartner eller en senior udvikler, der kan eje et projekt fra ende til ende, leverer jeg produktionsklar software og webapplikationer, som er skalerbare og performante.',
        ], [
            'bulletpoint' => [
                ['title' => 'End to end ansvar', 'description' => 'Fra problemidentifikation til deployment', 'icon' => 'i-lucide-rocket'],
                ['title' => 'Performance', 'description' => 'Performance-budgetter indarbejdet i hvert build og release.', 'icon' => 'i-lucide-gauge'],
                ['title' => 'Sikkerhed', 'description' => 'Sikre fundamenter med autentifikation, audits og observability.', 'icon' => 'i-lucide-shield-check'],
            ],
        ]);

        // Experience component
        $this->createComponent($page, 'FrontpageExperience', [
            'headline' => 'Dybdegående fullstack udviklings-erfaring, med fokus på forretningslogik og skalerbare løsninger',
            'summary' => '10+ års udvikler erfaring, både frontend og backend, med komplekse integrationer og data-tunge dashboards for både startups og enterprise-organisationer.',
            'narrative' => 'Jeg har arbejdet med mange forskellige virksomheder, fra små startups til store enterprise-organisationer. Min styrke ligger i at forstå forretningslogikken og omsætte den til skalerbare, vedligeholdelsesvenlige løsninger, der leverer værdi hurtigt.',
            'primary_metric' => '10+ år med produktionsklar software',
        ], [], [
            'focus_area' => [
                'Anvendelse af "best practice code patterns" for vedligeholdelsesvenlig kode',
                'Arkitekturer der passer virksomhedens behov',
                'Modulær tilgang for gøre kodebasen let og skalerbar',
                'Automatiserede tests og CI/CD for pålidelig levering',
                'Performance-optimering og Core Web Vitals',
                'Sikkerhed og databeskyttelse som standard',
                'Solide backends med førende frameworks som Laravel og .NET',
                'Brugervenlige UI/UX-designs med reaktive frameworks',
                'Integration med tredjeparts services og APIer',
            ],
            'skill' => [
                'Laravel', 'PHP', '.NET', 'C#', 'Nuxt.js', 'Vue.js', 'React.js', 'Next.js',
                'Flutter', 'Dart', 'JavaScript', 'TypeScript', 'Tailwind CSS', 'Docker',
                'CI/CD', 'Ploi', 'Azure AD / SSO', 'Symfony', 'Doctrine ORM', 'Og meget mere...',
            ],
            'quote' => [
                'Alt starter med en idé. Mit arbejde er at gøre den til virkelighed – på en måde, der holder.',
                'Mellem forretning og teknologi finder jeg balancen, hvor arkitektur bliver til værdi.',
                'Når alt fungerer gnidningsfrit, mærker man det ikke. Og det er præcis sådan, det skal være.',
            ],
        ]);

        // About component
        $this->createComponent($page, 'FrontpageAbout', [
            'headline' => 'MEN.. HVEM ER JEG?',
            'title' => 'Jeg hedder Mattias, jeg er en familiefar med passion for udvikling.',
            'image_src' => '~/assets/img/mig.png',
            'image_alt' => 'Mattias Kieler',
        ], [], [
            'paragraph' => [
                'Med en dyb passion for at analysere komplekse forretningsprocesser arbejder jeg på at finde innovative måder at optimere dem gennem skræddersyede softwareløsninger. Rejsen inden for udvikling startede som en nysgerrighed og har udviklet sig til en livslang dedikation til at skabe værdi gennem teknologi.',
                'Jeg tror på, at teknologi skal gøre hverdagen lettere ved at løse selv de mindste problemer man står overfor hver dag. Når jeg ikke sidder foran computeren, bruger jeg tid sammen med mine to børn og partner, eller dyrker sport for at nulstille hvorefter der er plads til at reflektere over nye idéer.',
                'Jeg er drevet af en konstant søgen efter at forstå, hvordan ting fungerer, og hvordan de kan gøres bedre. Det, der motiverer mig mest, er at skabe løsninger, der ikke kun forbedrer arbejdet for andre, men også gør det sjovere og mere tilfredsstillende for dem at løse de opgaver, de står overfor.',
            ],
        ]);

        // This Site component
        $this->createComponent($page, 'FrontpageThisSite', [
            'headline' => 'Kan du lide denne side?',
            'title' => 'Denne side er bygget med Nuxt og Static Site Generation (SSG)',
            'description' => 'Det betyder, at siderne bliver genereret i ren HTML og CSS og cachet globalt for lav TTFB og stærke Core Web Vitals. Google elsker hurtige sider hvorfor det er yderst vigtigt for SEO. Undersøgelser viser, at 53% af alle besøgende forlader et site, hvis det tager mere end 3 sekunder at indlæse. Det er også godt for miljøet, da statiske sider bruger langt mindre energi end dynamiske sider. Derudover er det også mere sikkert, da der ikke er nogen server-side kode, der kan blive kompromitteret.',
            'pagespeed_url' => 'https://pagespeed.web.dev/analysis/https-mkieler-com/zeen17155o?form_factor=mobile',
        ]);

        // CTA component
        $this->createComponent($page, 'FrontpageCta', [
            'title' => 'Klar til at tage dit projekt til næste niveau?',
            'description' => 'Uanset om du har brug for en freelancepartner eller en senior udvikler, der kan eje et projekt fra ende til ende, leverer jeg produktionsklar software og webapplikationer, som er skalerbare og performante.',
            'button_label' => 'Kontakt mig',
            'button_url' => '/contact',
        ]);
    }

    /**
     * Seed the services page.
     */
    private function seedServicesPage(Author $author): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'services'],
            [
                'name' => 'Services',
                'author_id' => $author->id,
            ]
        );

        // SEO Metadata
        SeoMetadata::updateOrCreate(
            ['seoable_type' => Page::class, 'seoable_id' => $page->id],
            [
                'title' => 'Webudvikling Services | Mattias Kieler',
                'description' => 'Professionelle webudviklingsydelser: webudvikling, web apps, e-commerce, API-udvikling, WordPress og teknisk konsulentydelser. Se alle mine services og find den rette løsning.',
                'og_title' => 'Webudvikling Services | Mattias Kieler',
                'og_description' => 'Professionel webudvikling, web applikationer, e-commerce og teknisk konsulentydelser. Find den rette løsning til din virksomhed.',
                'og_image' => null,
            ]
        );

        // Components
        $this->seedServicesPageComponents($page);
    }

    /**
     * Seed services page components.
     */
    private function seedServicesPageComponents(Page $page): void
    {
        // Delete existing components for this page
        $page->components()->each(function (Component $component) {
            $component->data()->delete();
            $component->delete();
        });

        // Page intro component
        $this->createComponent($page, 'ServicesPageIntro', [
            'title' => 'Services',
            'headline' => 'Services',
            'description' => "Fra simple websites til komplekse web applikationer - jeg tilbyder en bred vifte af webudviklingsydelser tilpasset dine behov.\n\nUanset om du har brug for en ny webløsning fra bunden, en modernisering af eksisterende systemer, eller teknisk rådgivning til dit team, kan jeg hjælpe. Med over 10 års erfaring inden for fullstack-udvikling har jeg arbejdet med alt fra startups til enterprise-virksomheder.\n\nAlle projekter starter med en grundig forståelse af dine forretningsmål. Teknologi er et middel, ikke et mål - og den rigtige løsning afhænger af dine specifikke behov, budget og ambitioner.",
        ]);

        // CTA component
        $this->createComponent($page, 'ServicesCta', [
            'title' => 'Kan du ikke finde det du leder efter?',
            'description' => 'Jeg påtager mig også projekter der falder uden for ovenstående kategorier. Lad os tage en snak om dine behov.',
            'button_label' => 'Kontakt mig',
            'button_url' => '/contact',
        ]);
    }

    /**
     * Create a component with data.
     *
     * @param  array<string, string>  $singleFields
     * @param  array<string, array<int, array<string, string>>>  $repeaterFields
     * @param  array<string, array<int, string>>  $multipleFields
     */
    private function createComponent(
        Page $page,
        string $name,
        array $singleFields = [],
        array $repeaterFields = [],
        array $multipleFields = []
    ): Component {
        $component = Component::create([
            'page_id' => $page->id,
            'name' => $name,
        ]);

        // Single fields
        foreach ($singleFields as $key => $value) {
            $component->data()->create(['key' => $key, 'value' => $value]);
        }

        // Repeater fields (stored as JSON per item)
        foreach ($repeaterFields as $key => $items) {
            foreach ($items as $item) {
                $component->data()->create(['key' => $key, 'value' => json_encode($item)]);
            }
        }

        // Multiple fields (multiple values with same key)
        foreach ($multipleFields as $key => $values) {
            foreach ($values as $value) {
                $component->data()->create(['key' => $key, 'value' => $value]);
            }
        }

        return $component;
    }
};
