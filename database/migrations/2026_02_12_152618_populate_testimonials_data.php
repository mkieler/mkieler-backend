<?php

use App\Models\Author;
use App\Models\Testimonial;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $testimonials = $this->getTestimonials();

        foreach ($testimonials as $index => $data) {
            $author = Author::updateOrCreate(
                ['name' => $data['author']['name'], 'company' => $data['author']['company']],
                $data['author']
            );

            Testimonial::updateOrCreate(
                ['author_id' => $author->id],
                [
                    'author_id' => $author->id,
                    'quote' => $data['quote'],
                    'sort_order' => $index + 1,
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $testimonials = $this->getTestimonials();

        foreach ($testimonials as $data) {
            $author = Author::where('name', $data['author']['name'])
                ->where('company', $data['author']['company'])
                ->first();

            if ($author) {
                Testimonial::where('author_id', $author->id)->delete();
                $author->delete();
            }
        }
    }

    /**
     * Get all testimonials data.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getTestimonials(): array
    {
        return [
            [
                'quote' => 'Mattias leverede produktionsklare features hver sprint og holdt vores performance-budgetter på plads. Nuxt SSG-tilgangen betød, at marketing kunne starte kampagner uden at vente på udviklingsteamet.',
                'author' => [
                    'name' => 'Jonas Schmidt',
                    'job_title' => 'CTO',
                    'company' => 'Northwind Analytics',
                ],
            ],
            [
                'quote' => 'Fra API-design til lancering er Mattias en del af vores bureauhold og løfter barren. Kunderne mærker både detaljegraden og hastigheden i den færdige oplevelse.',
                'author' => [
                    'name' => 'Sofie Larsen',
                    'job_title' => 'Managing Partner',
                    'company' => 'Studio Lambda',
                ],
            ],
            [
                'quote' => 'Vi havde brug for en udvikler, der kunne tage ejerskab over hele stakken. Mattias leverede en skalerbar løsning, der stadig kører fejlfrit to år senere.',
                'author' => [
                    'name' => 'Mikkel Andersen',
                    'job_title' => 'Produktchef',
                    'company' => 'Streamline Logistics',
                ],
            ],
            [
                'quote' => 'Mattias forstår forretningen bag koden. Han stillede de rigtige spørgsmål og byggede præcis det, vi havde brug for – uden overkomplicering.',
                'author' => [
                    'name' => 'Line Vestergaard',
                    'job_title' => 'CEO',
                    'company' => 'GreenTech Solutions',
                ],
            ],
            [
                'quote' => 'Vores legacy-system var en flaskehals. Mattias migrerede det til Laravel på rekordtid, og nu kan vi shippe features ugentligt i stedet for kvartalsvis.',
                'author' => [
                    'name' => 'Henrik Mølgaard',
                    'job_title' => 'Lead Developer',
                    'company' => 'FinanceFlow',
                ],
            ],
            [
                'quote' => 'Samarbejdet med Mattias føltes som at have en in-house senior udvikler. Han var proaktiv, kommunikerede tydeligt og leverede altid til tiden.',
                'author' => [
                    'name' => 'Camilla Kjær',
                    'job_title' => 'Digital Director',
                    'company' => 'Nordic Media Group',
                ],
            ],
            [
                'quote' => 'Mattias hjalp os med at bygge en partnerportal med Azure AD-integration. Sikkerhed og brugeroplevelse gik hånd i hånd fra dag ét.',
                'author' => [
                    'name' => 'Thomas Riis',
                    'job_title' => 'IT-chef',
                    'company' => 'BuildCorp Danmark',
                ],
            ],
            [
                'quote' => "Vi gik fra idé til MVP på seks uger. Mattias' erfaring med Laravel og Nuxt betød, at vi kunne validere vores koncept hurtigere end forventet.",
                'author' => [
                    'name' => 'Maria Bech',
                    'job_title' => 'Founder',
                    'company' => 'HealthTrack',
                ],
            ],
            [
                'quote' => 'Performance var kritisk for vores e-commerce platform. Mattias optimerede vores Nuxt-setup, og vi så en 40% forbedring i Core Web Vitals.',
                'author' => [
                    'name' => 'Peter Skov',
                    'job_title' => 'E-commerce Manager',
                    'company' => 'Nordic Retail',
                ],
            ],
            [
                'quote' => 'Mattias er den sjældne udvikler, der både kan dykke ned i kompleks backend-logik og levere en poleret frontend. En sand fullstack-profil.',
                'author' => [
                    'name' => 'Anne-Mette Holm',
                    'job_title' => 'VP Engineering',
                    'company' => 'TechScale',
                ],
            ],
        ];
    }
};
