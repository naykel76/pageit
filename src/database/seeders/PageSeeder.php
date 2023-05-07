<?php

namespace Naykel\Pageit\Database\seeders;

use Naykel\Pageit\Models\PageBlock;
use Illuminate\Database\Seeder;
use Naykel\Pageit\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $page1 = Page::create([
            'id' => '327',
            'title' => 'My First Page',
            'config' => [
                'advanced_code' => false,
                'type' => 'normal'
            ]
        ]);

        $builder1 = Page::create([
            'id' => '427',
            'title' => 'My First Page Builder',
            'config' => [
                'advanced_code' => false,
                'type' => 'builder'
            ]
        ]);

        $builder1->blocks()->createMany([
            [
                'id' => 800,
                'title' => 'This is my first editor',
                'type' => 'editor',
                'body' => 'This is my first editor body',
            ],
            [
                'title' => 'This is my second editor',
                'type' => 'editor',
                'body' => 'This is my second editor body',
            ],
            [
                'id' => 900,
                'title' => 'My First Accordion Section',
                'type' => 'accordion',
                'body' => json_encode(
                    [
                        ['title' => 'Accordion Title 1', 'body' => 'Accordion 1 body'],
                        ['title' => 'Accordion Title 2', 'body' => 'Accordion 2 body']
                    ],
                ),
            ],
            [
                'title' => 'Text Editor Block',
                'type' => 'textarea',
                'body' => 'This is the text area body',
            ],

        ]);

        // PageBlock::create([
        //     'title' => 'My First Accordion Section',
        //     'type' => 'accordion',
        //     'body' => json_encode(
        //         [
        //             ['title' => 'Accordion Title 1', 'body' => 'Accordion 1 body'],
        //             ['title' => 'Accordion Title 2', 'body' => 'Accordion 2 body']
        //         ],
        //     ),
        // ]);
        // PageBlock::create([
        //     'title' => 'My second editor',
        //     'type' => 'editor',
        //     'body' => 'My second editor body',
        // ]);
        // PageBlock::create([
        //     'title' => 'My First Accordion Section',
        //     'type' => 'accordion',
        //     'body' => json_encode(
        //         [
        //             ['title' => 'Accordion Title 1', 'body' => 'Accordion 1 body'],
        //             ['title' => 'Accordion Title 2', 'body' => 'Accordion 2 body']
        //         ],
        //     ),
        // ]);
        // $page = Page::create([
        //     'id' => '427',
        //     'title' => 'Banner With Lead Text and Headlines',
        //     'config' => [
        //         'advanced_code' => true
        //     ],
        //     'layout' => 'banner',
        //     'image' => 'mushroom001-710x400.jpg',
        //     // 'lead_text' => 'The lead paragraph text should clearly and concisely describe what the user will expect from the page contents.',
        //     'headline' => '<ul> <li> Experience the difference, unlock your potential </li> <li> Your one-stop shop for all things awesome </li> <li> Discover the world of possibilities </li> </ul> <div>You can also add some normal text if you wish, however you will quickly run out of room!</div>',
        //     'body' => '<h2>Heading 2 - Subtitle</h2><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit culpa id ab atque officiis illum eius! Ab illo aut tempore eos quo placeat, obcaecati odit in autem modi officiis quidem.</p><p class="fw7">Without a clear visual hierarchy, all the content on the page seems equally important, making it overwhelming.</p><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi accusantium consequuntur minima quas, sit accusamus, dolorum esse impedit incidunt est voluptatem quis sed, aliquam placeat dicta! Incidunt assumenda accusantium dolor laborum eligendi reprehenderit eum nobis nemo quis sint voluptates delectus explicabo dicta, enim id neque. Assumenda omnis odio doloribus obcaecati!</p><h2>Heading 2 - Subtitle</h2><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et iusto ipsa amet eius provident dolorem natus rerum excepturi at numquam tempora aliquid accusamus, quibusdam porro sapiente esse enim. Labore cumque fuga, aspernatur, nesciunt id distinctio tenetur harum, hic aliquam sit corrupti mollitia officia? Incidunt distinctio molestiae unde cupiditate mollitia sequi dignissimos, aut sed? Consequuntur iste sunt maiores eum quam esse similique consectetur ipsa dolorum ipsum enim voluptas perspiciatis, voluptates a iure quas asperiores animi impedit alias deleniti repellat praesentium. Non!</p>',
        // ]);

        // // CATEGORY 2
        // // ======================================================

        // Page::create([
        //     'title' => 'Page one, category 2 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-2'
        // ]);

        // Page::create([
        //     'title' => 'Page two, category 2 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-2'
        // ]);

        // // SUB CATEGORIES EXAMPLE 2
        // // ======================================================
        // Page::create([
        //     'title' => 'Page three, category 2, sub-category 1 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-2/sub-category-1'
        // ]);
        // Page::create([
        //     'title' => 'Page four, category 2, sub-category 1 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-2/sub-category-1'
        // ]);
        // Page::create([
        //     'title' => 'Page five, category 2, sub-category 2 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-2/sub-category-2'
        // ]);
        // Page::create([
        //     'title' => 'Page six, category 2, sub-category 2 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-2/sub-category-2'
        // ]);


        // // CATEGORIES EXAMPLE 1 INTENTIONALY OUT OF ORDER
        // // ======================================================
        // Page::create([
        //     'title' => 'Category 1',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1',
        //     'is_category' => true,
        //     'published_at' => now(),
        // ]);
        // Page::create([
        //     'title' => 'Page two, category 1 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1'
        // ]);
        // Page::create([
        //     'title' => 'Page one, category 1 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1'
        // ]);
        // // CATEGORY 1, SUB-CATEGORIES 1 & 2
        // // ======================================================
        // $subCategory2 = Page::create([
        //     'title' => 'Sub-Category 2',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1/sub-category-2',
        //     'is_category' => true,
        //     'published_at' => now(),
        // ]);
        // $subCategory1 = Page::create([
        //     'title' => 'Sub-Category 1',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1/sub-category-1',
        //     'is_category' => true,
        //     'published_at' => now(),
        // ]);
        // Page::create([
        //     'title' => 'Page three, category 1, sub-category 1 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1/sub-category-1',
        // ]);
        // Page::create([
        //     'title' => 'Page four, category 1, sub-category 1 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1/sub-category-1',
        // ]);
        // Page::create([
        //     'title' => 'Page five, category 1, sub-category 2 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1/sub-category-2'
        // ]);
        // Page::create([
        //     'title' => 'Page six, category 1, sub-category 2 ',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-1/sub-category-2'
        // ]);
        // $category2 = Page::create([
        //     'title' => 'Category 2',
        //     'layout' => 'default',
        //     'route_prefix' => 'category-2',
        //     'is_category' => true,
        //     'published_at' => now(),
        // ]);

    }
}
