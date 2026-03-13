<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Post::query()->exists()) {
            return;
        }

        $categories = Category::query()->get()->keyBy('slug');
        $authors = User::query()->get()->values();

        $posts = [
            [
                'title' => 'How to Build a Better Writing Habit',
                'category_slug' => 'web-design',
                'body' => '<p>Writing consistently is less about inspiration and more about rhythm. Start with a small, repeatable schedule you can actually keep, even if it is only fifteen minutes a day.</p><p>Once the habit feels natural, make it easier to continue by keeping one running list of ideas, rough outlines, and half-finished drafts. Momentum grows when you remove the friction of starting from zero.</p>',
            ],
            [
                'title' => 'Why Clear UI Copy Matters More Than You Think',
                'category_slug' => 'web-design',
                'body' => '<p>People do not experience an interface as a collection of components. They experience it as a sequence of decisions, and words shape every one of those decisions.</p><p>Labels, helper text, and error messages should reduce uncertainty. Good UI copy gives the user confidence, sets expectations, and keeps the product feeling calm.</p>',
            ],
            [
                'title' => 'A Practical Intro to Laravel Routing',
                'category_slug' => 'web-programming',
                'body' => '<p>Laravel routing stays approachable because the framework keeps common tasks close to the surface. You can define public pages, authenticated areas, and grouped middleware without scattering logic everywhere.</p><p>As a project grows, route files become easier to manage when each route points toward a focused controller action with a single responsibility.</p>',
            ],
            [
                'title' => 'Three Habits That Make Debugging Faster',
                'category_slug' => 'web-programming',
                'body' => '<p>First, make the bug reproducible with the fewest moving parts possible. Second, confirm what the system is actually doing with logs or focused tests. Third, change one thing at a time so you always know what fixed it.</p><p>Fast debugging is not about guessing quickly. It is about narrowing the problem with discipline.</p>',
            ],
            [
                'title' => 'What Makes AI Features Feel Useful',
                'category_slug' => 'ai',
                'body' => '<p>The best AI features do not try to replace the whole user journey. They remove the slowest or most repetitive step and leave the person in control.</p><p>That usually means better suggestions, cleaner drafts, smarter search, or faster categorization. Useful AI feels like momentum, not magic.</p>',
            ],
            [
                'title' => 'Designing for Trust in AI Products',
                'category_slug' => 'ai',
                'body' => '<p>Trust comes from clear boundaries. Users should know what the model can do, what data it is using, and what they still need to verify themselves.</p><p>Interfaces that explain uncertainty, show sources when possible, and make revision easy tend to feel far more reliable than interfaces that act overly confident.</p>',
            ],
        ];

        foreach ($posts as $index => $post) {
            $author = $authors[$index % $authors->count()];
            $category = $categories->get($post['category_slug']);

            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'body' => $post['body'],
                'author_id' => $author->id,
                'category_id' => $category->id,
            ]);
        }
    }
}
