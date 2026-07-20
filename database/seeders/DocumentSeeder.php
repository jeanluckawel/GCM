<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $documents = [

            [
                'title' => 'Contrat de travail',
                'document_type' => 'Contrat',
                'file_name' => 'contrat_travail.pdf',
                'file_type' => 'pdf',
            ],

            [
                'title' => 'Carte d identité',
                'document_type' => 'Identité',
                'file_name' => 'carte_identite.jpg',
                'file_type' => 'jpg',
            ],

            [
                'title' => 'Photo d identité',
                'document_type' => 'Photo',
                'file_name' => 'photo_agent.png',
                'file_type' => 'png',
            ],

            [
                'title' => 'Diplôme académique',
                'document_type' => 'Diplôme',
                'file_name' => 'diplome.pdf',
                'file_type' => 'pdf',
            ],

            [
                'title' => 'Historique salarial',
                'document_type' => 'Salaire',
                'file_name' => 'historique_salaire.xlsx',
                'file_type' => 'xlsx',
            ],

            [
                'title' => 'Attestation de formation',
                'document_type' => 'Formation',
                'file_name' => 'formation.xlsx',
                'file_type' => 'xlsx',
            ],

            [
                'title' => 'Certificat médical',
                'document_type' => 'Médical',
                'file_name' => 'certificat_medical.pdf',
                'file_type' => 'pdf',
            ],

            [
                'title' => 'Décision de promotion',
                'document_type' => 'Carrière',
                'file_name' => 'promotion.pdf',
                'file_type' => 'pdf',
            ],

        ];


        Folder::all()->each(function ($folder) use ($documents) {

            // Chaque agent reçoit entre 3 et 7 documents
            $folderDocuments = collect($documents)
                ->random(rand(3, 7));


            foreach ($folderDocuments as $document) {

                Document::create([

                    'folder_id' => $folder->id,

                    'title' => $document['title'],

                    'document_type' => $document['document_type'],

                    'file_name' => $document['file_name'],

                    'file_path' => 'documents/' . $document['file_name'],

                    'file_type' => $document['file_type'],

                    'file_size' => rand(50000, 2000000),

                ]);

            }

        });
    }
}
