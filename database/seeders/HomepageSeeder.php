<?php

namespace Database\Seeders;

use App\Models\Homepage;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Homepage::updateOrCreate(
            ['id' => 1],
            [
                // SEO
                'seo_title' => 'Mattias Kieler | Laravel + Nuxt-specialist til ydeevnestærke webprodukter',
                'seo_description' => 'Marketingsider, SaaS-platforme og interne værktøjer, der føles øjeblikkelige takket være Nuxt statisk generering, solide Laravel-backends og pragmatisk ingeniørarbejde.',
                'seo_og_image' => '/og-image.jpg',
                'seo_person_name' => 'Mattias Kieler',
                'seo_person_job_title' => 'Fractional CTO og senior fullstack-udvikler',
                'seo_person_email' => 'hello@mkieler.dev',
                'seo_service_name' => 'Mattias Kieler Konsulentydelser',
                'seo_service_area_served' => 'Fjernarbejde',
                'seo_service_type' => 'Freelance fullstack-webudvikling',

                // Hero
                'hero_eyebrow' => 'Fullstack-udvikling | Web & Software | Freelance & fuldtid',
                'hero_headline' => 'Fra produktidé til robust og skalerbar web eller software-løsning',
                'hero_supporting_text' => 'Uanset om du har brug for en freelancepartner eller en senior udvikler, der kan eje et projekt fra ende til ende, leverer jeg produktionsklar software og webapplikationer, som er skalerbare og performante.',
                'hero_bulletpoints' => [
                    ['title' => 'End to end ansvar', 'description' => 'Fra problemidentifikation til deployment', 'icon' => 'i-lucide-rocket'],
                    ['title' => 'Performance', 'description' => 'Performance-budgetter indarbejdet i hvert build og release.', 'icon' => 'i-lucide-gauge'],
                    ['title' => 'Sikkerhed', 'description' => 'Sikre fundamenter med autentifikation, audits og observability.', 'icon' => 'i-lucide-shield-check'],
                ],

                // Experience
                'experience_headline' => 'Dybdegående fullstack udviklings-erfaring, med fokus på forretningslogik og skalerbare løsninger',
                'experience_summary' => '10+ års udvikler erfaring, både frontend og backend, med komplekse integrationer og data-tunge dashboards for både startups og enterprise-organisationer.',
                'experience_narrative' => 'Jeg har arbejdet med mange forskellige virksomheder, fra små startups til store enterprise-organisationer. Min styrke ligger i at forstå forretningslogikken og omsætte den til skalerbare, vedligeholdelsesvenlige løsninger, der leverer værdi hurtigt.',
                'experience_primary_metric' => '10+ år med produktionsklar software',
                'experience_focus_areas' => [
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
                'experience_skills' => [
                    'Laravel', 'PHP', '.NET', 'C#', 'Nuxt.js', 'Vue.js', 'React.js', 'Next.js',
                    'Flutter', 'Dart', 'JavaScript', 'TypeScript', 'Tailwind CSS', 'Docker',
                    'CI/CD', 'Ploi', 'Azure AD / SSO', 'Symfony', 'Doctrine ORM', 'Og meget mere...',
                ],
                'experience_idea_to_system' => [
                    'Alt starter med en idé. Mit arbejde er at gøre den til virkelighed – på en måde, der holder.',
                    'Mellem forretning og teknologi finder jeg balancen, hvor arkitektur bliver til værdi.',
                    'Når alt fungerer gnidningsfrit, mærker man det ikke. Og det er præcis sådan, det skal være.',
                ],

                // About
                'about_headline' => 'MEN.. HVEM ER JEG?',
                'about_title' => 'Jeg hedder Mattias, jeg er en familiefar med passion for udvikling.',
                'about_paragraphs' => [
                    'Med en dyb passion for at analysere komplekse forretningsprocesser arbejder jeg på at finde innovative måder at optimere dem gennem skræddersyede softwareløsninger. Rejsen inden for udvikling startede som en nysgerrighed og har udviklet sig til en livslang dedikation til at skabe værdi gennem teknologi.',
                    'Jeg tror på, at teknologi skal gøre hverdagen lettere ved at løse selv de mindste problemer man står overfor hver dag. Når jeg ikke sidder foran computeren, bruger jeg tid sammen med mine to børn og partner, eller dyrker sport for at nulstille hvorefter der er plads til at reflektere over nye idéer.',
                    'Jeg er drevet af en konstant søgen efter at forstå, hvordan ting fungerer, og hvordan de kan gøres bedre. Det, der motiverer mig mest, er at skabe løsninger, der ikke kun forbedrer arbejdet for andre, men også gør det sjovere og mere tilfredsstillende for dem at løse de opgaver, de står overfor.',
                ],
                'about_image_src' => '~/assets/img/mig.png',
                'about_image_alt' => 'Mattias Kieler',

                // ThisSite
                'this_site_headline' => 'Kan du lide denne side?',
                'this_site_title' => 'Denne side er bygget med Nuxt og Static Site Generation (SSG)',
                'this_site_description' => 'Det betyder, at siderne bliver genereret i ren HTML og CSS og cachet globalt for lav TTFB og stærke Core Web Vitals. Google elsker hurtige sider hvorfor det er yderst vigtigt for SEO. Undersøgelser viser, at 53% af alle besøgende forlader et site, hvis det tager mere end 3 sekunder at indlæse. Det er også godt for miljøet, da statiske sider bruger langt mindre energi end dynamiske sider. Derudover er det også mere sikkert, da der ikke er nogen server-side kode, der kan blive kompromitteret.',
                'this_site_pagespeed_url' => 'https://pagespeed.web.dev/analysis/https-mkieler-com/zeen17155o?form_factor=mobile',

                // CTA
                'cta_title' => 'Klar til at tage dit projekt til næste niveau?',
                'cta_description' => 'Uanset om du har brug for en freelancepartner eller en senior udvikler, der kan eje et projekt fra ende til ende, leverer jeg produktionsklar software og webapplikationer, som er skalerbare og performante.',
            ]
        );
    }
}
