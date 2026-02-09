<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'slug' => 'koebenhavn',
                'city' => 'København',
                'suffix' => 'i København',
                'headline' => 'Webudvikler i København',
                'description' => 'Professionel webudvikling i København. Jeg hjælper virksomheder i hovedstadsområdet med at bygge moderne, skalerbare webløsninger med Laravel og Nuxt.',
                'long_description' => "Som webudvikler med base i København arbejder jeg med virksomheder i hele hovedstadsområdet - fra startups i det innovative miljø omkring Islands Brygge og Nordhavn til etablerede virksomheder i indre by og på Frederiksberg.\n\nKøbenhavn er Skandinaviens tech-hub med et blomstrende startup-økosystem og en stærk tradition for digital innovation. Jeg forstår de unikke behov hos københavnske virksomheder, hvad enten det drejer sig om fintech, e-commerce, SaaS eller kreative bureauer.\n\nSelvom jeg arbejder remote-first, mødes jeg gerne til workshops, kickoff-møder og strategisessioner i København. Det personlige samarbejde kombineret med effektive digitale arbejdsgange giver det bedste af begge verdener.",
                'nearby_areas' => ['Frederiksberg', 'Amager', 'Vesterbro', 'Nørrebro', 'Østerbro', 'Hellerup', 'Gentofte', 'Gladsaxe', 'Ballerup', 'Hvidovre'],
                'seo_title' => 'Webudvikler i København | Freelance Laravel & Nuxt Specialist',
                'seo_description' => 'Erfaren freelance webudvikler i København. Professionel webudvikling med Laravel og Nuxt til virksomheder i hovedstadsområdet. Kontakt for en uforpligtende snak.',
                'seo_og_title' => 'Webudvikler i København',
                'seo_og_description' => 'Professionel webudvikling i København. Laravel, Nuxt og moderne webteknologier til din virksomhed.',
                'sort_order' => 1,
            ],
            [
                'slug' => 'aarhus',
                'city' => 'Aarhus',
                'suffix' => 'i Aarhus',
                'headline' => 'Webudvikler i Aarhus',
                'description' => 'Erfaren webudvikler i Aarhus. Jeg samarbejder med virksomheder i Østjylland om at skabe performante webapplikationer og digitale løsninger.',
                'long_description' => "Aarhus er Danmarks næststørste by og et kraftcenter for innovation med et stærkt universitetsmiljø og voksende tech-scene. Jeg arbejder med virksomheder i Aarhus og omegn - fra tech-startups i INCUBA og Katrinebjerg til etablerede virksomheder i byens centrum.\n\nMed fokus på remote-first samarbejde kan jeg levere den samme kvalitet til virksomheder i Aarhus som til dem i København. Moderne værktøjer gør afstanden ubetydelig, og jeg kommer gerne til Aarhus for workshops og vigtige møder.\n\nØstjylland har en stærk tradition inden for produktion, handel og kreative industrier. Jeg forstår de særlige digitale behov i disse brancher og kan hjælpe med alt fra produktkonfiguratorer til B2B-platforme og marketing-sites.",
                'nearby_areas' => ['Brabrand', 'Højbjerg', 'Viby', 'Risskov', 'Tranbjerg', 'Skanderborg', 'Silkeborg', 'Randers', 'Horsens'],
                'seo_title' => 'Webudvikler i Aarhus | Freelance Laravel & Nuxt Specialist',
                'seo_description' => 'Freelance webudvikler i Aarhus og Østjylland. Professionel webudvikling med Laravel og Nuxt. Web applikationer, websites og e-commerce løsninger.',
                'seo_og_title' => 'Webudvikler i Aarhus',
                'seo_og_description' => 'Erfaren webudvikler i Aarhus. Moderne webløsninger med Laravel, Nuxt og Vue.js til østjyske virksomheder.',
                'sort_order' => 2,
            ],
            [
                'slug' => 'odense',
                'city' => 'Odense',
                'suffix' => 'i Odense',
                'headline' => 'Webudvikler i Odense',
                'description' => 'Freelance webudvikler i Odense. Jeg tilbyder professionel webudvikling til virksomheder på Fyn med fokus på kvalitet og performance.',
                'long_description' => "Odense og Fyn har oplevet en digital renæssance med voksende tech-miljøer og innovative virksomheder. Som freelance webudvikler samarbejder jeg med virksomheder på tværs af Fyn - fra robotteknologi-startups til etablerede produktionsvirksomheder der vil digitalisere.\n\nFyn har traditionelt været stærk inden for industri og landbrug, men den digitale transformation skaber nye muligheder. Jeg hjælper fynske virksomheder med at bygge digitale løsninger der moderniserer deres forretning - fra kundeportaler til IoT-dashboards og e-commerce.\n\nMed udgangspunkt i remote-samarbejde kan jeg tilbyde samme service og kvalitet til virksomheder i Odense som til dem i de større byer. Fysiske møder aftales efter behov for workshops og strategisessioner.",
                'nearby_areas' => ['Svendborg', 'Nyborg', 'Middelfart', 'Kerteminde', 'Assens', 'Faaborg'],
                'seo_title' => 'Webudvikler i Odense | Freelance Laravel & Nuxt Specialist',
                'seo_description' => 'Freelance webudvikler i Odense og på Fyn. Professionel webudvikling med Laravel og Nuxt. Moderne webløsninger til fynske virksomheder.',
                'seo_og_title' => 'Webudvikler i Odense',
                'seo_og_description' => 'Professionel webudvikling i Odense. Laravel, Nuxt og moderne teknologier til virksomheder på Fyn.',
                'sort_order' => 3,
            ],
            [
                'slug' => 'aalborg',
                'city' => 'Aalborg',
                'suffix' => 'i Aalborg',
                'headline' => 'Webudvikler i Aalborg',
                'description' => 'Webudvikling i Aalborg og Nordjylland. Fra simple websites til komplekse webapplikationer - jeg leverer løsninger der matcher dine behov.',
                'long_description' => "Aalborg er Nordjyllands centrum med et stærkt universitetsmiljø og voksende tech-scene. Aalborg Universitet er kendt for problembaseret læring og har fostret mange succesfulde tech-virksomheder og startups.\n\nJeg samarbejder med virksomheder i hele Nordjylland - fra innovative startups i NOVI Science Park til etablerede virksomheder inden for energi, produktion og logistik. Remote-first tilgangen gør det nemt at arbejde sammen uanset geografisk placering.\n\nNordjylland har unikke styrker inden for energisektoren, maritim industri og fødevarer. Jeg forstår disse branchers digitale behov og kan hjælpe med alt fra interne systemer til kundevendte platforme og datadrevne applikationer.",
                'nearby_areas' => ['Nørresundby', 'Hjørring', 'Frederikshavn', 'Thisted', 'Hobro', 'Brønderslev'],
                'seo_title' => 'Webudvikler i Aalborg | Freelance Laravel & Nuxt Specialist',
                'seo_description' => 'Freelance webudvikler i Aalborg og Nordjylland. Professionel webudvikling med Laravel og Nuxt. Websites, web apps og e-commerce til nordjyske virksomheder.',
                'seo_og_title' => 'Webudvikler i Aalborg',
                'seo_og_description' => 'Webudvikling i Aalborg og Nordjylland. Moderne webløsninger med Laravel og Nuxt til din virksomhed.',
                'sort_order' => 4,
            ],
            [
                'slug' => 'danmark',
                'city' => 'Danmark',
                'suffix' => 'i Danmark',
                'headline' => 'Webudvikler i Danmark',
                'description' => 'Landsdækkende webudvikling med remote-first tilgang. Jeg samarbejder med virksomheder i hele Danmark om at bygge moderne webløsninger.',
                'long_description' => "Som freelance webudvikler arbejder jeg med virksomheder i hele Danmark - fra København til Aalborg, fra Odense til Bornholm. Min remote-first tilgang betyder at geografisk placering aldrig er en begrænsning for et godt samarbejde.\n\nDanmark er et af verdens mest digitaliserede lande med høj teknologisk modenhed og innovative virksomheder. Jeg hjælper danske virksomheder med at udnytte dette potentiale gennem moderne webløsninger der skaber værdi.\n\nUanset om du er en startup i vækst, en mellemstor virksomhed der vil digitalisere, eller en etableret organisation der skal modernisere legacy-systemer, kan jeg levere løsninger der matcher dine ambitioner. Fysiske møder aftales efter behov - jeg kommer gerne til dig for workshops og strategisessioner.",
                'nearby_areas' => ['København', 'Aarhus', 'Odense', 'Aalborg', 'Esbjerg', 'Randers', 'Kolding', 'Horsens', 'Vejle', 'Roskilde', 'Herning'],
                'seo_title' => 'Webudvikler i Danmark | Freelance Laravel & Nuxt Specialist',
                'seo_description' => 'Erfaren freelance webudvikler med kunder i hele Danmark. Professionel webudvikling med Laravel og Nuxt. Remote-first samarbejde med fokus på kvalitet.',
                'seo_og_title' => 'Webudvikler i Danmark',
                'seo_og_description' => 'Landsdækkende webudvikling med remote-first tilgang. Laravel, Nuxt og moderne teknologier.',
                'sort_order' => 5,
            ],
        ];

        foreach ($locations as $location) {
            Location::updateOrCreate(
                ['slug' => $location['slug']],
                $location
            );
        }
    }
}
