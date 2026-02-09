<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'quote' => 'Mattias leverede produktionsklare features hver sprint og holdt vores performance-budgetter på plads. Nuxt SSG-tilgangen betød, at marketing kunne starte kampagner uden at vente på udviklingsteamet.',
                'author_name' => 'Jonas Schmidt',
                'author_role' => 'CTO',
                'author_company' => 'Northwind Analytics',
            ],
            [
                'quote' => 'Fra API-design til lancering er Mattias en del af vores bureauhold og løfter barren. Kunderne mærker både detaljegraden og hastigheden i den færdige oplevelse.',
                'author_name' => 'Sofie Larsen',
                'author_role' => 'Managing Partner',
                'author_company' => 'Studio Lambda',
            ],
            [
                'quote' => 'Vi havde brug for en udvikler, der kunne tage ejerskab over hele stakken. Mattias leverede en skalerbar løsning, der stadig kører fejlfrit to år senere.',
                'author_name' => 'Mikkel Andersen',
                'author_role' => 'Produktchef',
                'author_company' => 'Streamline Logistics',
            ],
            [
                'quote' => 'Mattias forstår forretningen bag koden. Han stillede de rigtige spørgsmål og byggede præcis det, vi havde brug for – uden overkomplicering.',
                'author_name' => 'Line Vestergaard',
                'author_role' => 'CEO',
                'author_company' => 'GreenTech Solutions',
            ],
            [
                'quote' => 'Vores legacy-system var en flaskehals. Mattias migrerede det til Laravel på rekordtid, og nu kan vi shippe features ugentligt i stedet for kvartalsvis.',
                'author_name' => 'Henrik Mølgaard',
                'author_role' => 'Lead Developer',
                'author_company' => 'FinanceFlow',
            ],
            [
                'quote' => 'Samarbejdet med Mattias føltes som at have en in-house senior udvikler. Han var proaktiv, kommunikerede tydeligt og leverede altid til tiden.',
                'author_name' => 'Camilla Kjær',
                'author_role' => 'Digital Director',
                'author_company' => 'Nordic Media Group',
            ],
            [
                'quote' => 'Mattias hjalp os med at bygge en partnerportal med Azure AD-integration. Sikkerhed og brugeroplevelse gik hånd i hånd fra dag ét.',
                'author_name' => 'Thomas Riis',
                'author_role' => 'IT-chef',
                'author_company' => 'BuildCorp Danmark',
            ],
            [
                'quote' => "Vi gik fra idé til MVP på seks uger. Mattias' erfaring med Laravel og Nuxt betød, at vi kunne validere vores koncept hurtigere end forventet.",
                'author_name' => 'Maria Bech',
                'author_role' => 'Founder',
                'author_company' => 'HealthTrack',
            ],
            [
                'quote' => 'Performance var kritisk for vores e-commerce platform. Mattias optimerede vores Nuxt-setup, og vi så en 40% forbedring i Core Web Vitals.',
                'author_name' => 'Peter Skov',
                'author_role' => 'E-commerce Manager',
                'author_company' => 'Nordic Retail',
            ],
            [
                'quote' => 'Mattias er den sjældne udvikler, der både kan dykke ned i kompleks backend-logik og levere en poleret frontend. En sand fullstack-profil.',
                'author_name' => 'Anne-Mette Holm',
                'author_role' => 'VP Engineering',
                'author_company' => 'TechScale',
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            Testimonial::updateOrCreate(
                ['author_name' => $testimonial['author_name'], 'author_company' => $testimonial['author_company']],
                array_merge($testimonial, ['sort_order' => $index + 1])
            );
        }
    }
}
