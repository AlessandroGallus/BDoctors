<?php

use App\Specialization;
use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'Allergologia ed Immunologia Clinica',
            'Anatomia Patologica',
            'Anestesia e Rianimazione e Terapia Intensiva e del dolore',
            'Audiologia e foniatria',
            'Cardiochirurgia',
            'Chirurgia Generale',
            'Chirurgia Maxillo-Facciale',
            'Chirurgia Pediatrica',
            'Chirurgia Plastica, Ricostruttiva ed Estetica',
            'Chirurgia Toracica',
            'Chirurgia Vascolare',
            'Dermatologia e Venereologia',
            'Ematologia',
            'Endocrinologia e Malattie del Metabolismo',
            'Farmacologia e Tossicologia clinica',
            'Fisica Medica',
            'Genetica Medica',
            'Geriatria ',
            'Ginecologia ed Ostetricia',
            'Igiene e Medicina Preventiva',
            "Malattie dell’Apparato Cardiovascolare",
            "Malattie dell'Apparato Digerente",
            "Malattie dell'Apparato Respiratorio",
            "Malattie Infettive e Tropicali",
            "Medicina d’Emergenza-Urgenza",
            "Medicina del Lavoro",
            "Medicina dello Sport e dell'esercizio fisico",
            "Medicina di Comunità e delle cure primarie -non attivata-",
            "Medicina Fisica e Riabilitativa",
            "Medicina Interna",
            "Medicina Legale",
            "Medicina Nucleare",
            "Medicina Termale",
            "Microbiologia e Virologia",
            "Nefrologia",
            "Neurochirurgia",
            "Neurologia ",
            "Neuropsichiatria infantile",
            "Oftalmologia ",
            "Oncologia Medica",
            "Ortopedia e Traumatologia",
            "Otorinolaringoiatria",
            "Patologia clinica e Biochimica clinica",
            "Pediatria ",
            "Psichiatria ",
            "Radiodiagnostica ",
            "Radioterapia ",
            "Reumatologia ",
            "Statistica Sanitaria e Biometria",
            "Urologia",
        ];
        $i=0;
        while ($i < count($arr)){
            $new_spec = new Specialization();
            $new_spec->name= $arr[$i];
            $new_spec->description= "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit inventore quia, aperiam voluptatem exercitationem iste. Ut maxime veniam temporibus similique repudiandae ducimus neque cupiditate est tempora totam, sed explicabo? Quam.";
            $new_spec->save();
            $i ++;
        }

    }
}
