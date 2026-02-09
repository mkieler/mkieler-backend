<?php

namespace Database\Seeders;

use App\Models\ServicesPage;
use Illuminate\Database\Seeder;

class ServicesPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServicesPage::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Services',
                'headline' => 'Services',
                'description' => "Fra simple websites til komplekse web applikationer - jeg tilbyder en bred vifte af webudviklingsydelser tilpasset dine behov.\n\nUanset om du har brug for en ny webløsning fra bunden, en modernisering af eksisterende systemer, eller teknisk rådgivning til dit team, kan jeg hjælpe. Med over 10 års erfaring inden for fullstack-udvikling har jeg arbejdet med alt fra startups til enterprise-virksomheder.\n\nAlle projekter starter med en grundig forståelse af dine forretningsmål. Teknologi er et middel, ikke et mål - og den rigtige løsning afhænger af dine specifikke behov, budget og ambitioner.",
                'seo_title' => 'Webudvikling Services | Mattias Kieler',
                'seo_description' => 'Professionelle webudviklingsydelser: webudvikling, web apps, e-commerce, API-udvikling, WordPress og teknisk konsulentydelser. Se alle mine services og find den rette løsning.',
                'seo_og_title' => 'Webudvikling Services | Mattias Kieler',
                'seo_og_description' => 'Professionel webudvikling, web applikationer, e-commerce og teknisk konsulentydelser. Find den rette løsning til din virksomhed.',
                'cta_text' => 'Kan du ikke finde det du leder efter? Jeg påtager mig også projekter der falder uden for ovenstående kategorier. Lad os tage en snak om dine behov.',
                'cta_button_label' => 'Kontakt mig',
            ]
        );
    }
}
