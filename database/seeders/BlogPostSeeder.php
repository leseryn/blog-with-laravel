<?php

namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_post')->insert([
            'user_id' => 1,
            'title' => 'An introduction to the analysis of shotgun metagenomic data',
            'summary' => 'Microbes that associate with a macroscopic host organism are no exception',
            'content'=>'Environmental DNA sequencing has revealed the expansive biodiversity of microorganisms and clarified the relationship between host-associated microbial communities and host phenotype. ',
            'created_at' => '2023-01-16 20:11:08.000',
            'published' => '1'
        ]);
        DB::table('blog_post')->insert([
            'user_id' => 1,
            'title' => 'Jumpstart Consortium Human Microbiome Project Data Generation Working Group',
            'summary' => 'Third, amplicon sequencing typically only provides insight into the taxonomic',
            'content'=>'This review describes the analytical strategies and specific tools that can be applied to metagenomic data and the considerations and caveats associated with their use.',
            'created_at' => '2023-01-17 20:11:08.000',
            'published' => '1'
        ]);
        DB::table('blog_post')->insert([
            'user_id' => 1,
            'title' => 'who is there and what are they capable of doing?',
            'summary' => ' the accuracy with which these methods estimate the true functional diversity of a community ',
            'content'=>'Shotgun metagenomic DNA sequencing is a relatively new and powerful environmental sequencing approach that provides insight into community biodiversity and function. But, the analysis of metagenomic sequences is complicated due to the complex structure of the data.',
            'created_at' => '2023-01-18 20:11:08.000',
            'published' => '1'
        ]);
    }
}
