<x-layout :title="$title">
  <section class="relative overflow-hidden rounded-[2rem] bg-slate-950 text-white">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.28),_transparent_32%),radial-gradient(circle_at_bottom_right,_rgba(251,191,36,0.2),_transparent_28%)]">
    </div>
    <div class="absolute -left-12 top-10 h-32 w-32 rounded-full border border-white/10"></div>
    <div class="absolute right-8 top-8 h-20 w-20 rounded-3xl bg-white/5 backdrop-blur-sm"></div>

    <div class="relative grid gap-10 px-6 py-10 lg:grid-cols-[1.25fr_0.9fr] lg:px-10 lg:py-14">
      <div class="max-w-3xl">
        <p class="mb-4 inline-flex items-center rounded-full border border-sky-400/30 bg-sky-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-sky-200">
          Fresh ideas for design, development, and AI
        </p>
        <h2 class="max-w-2xl text-4xl font-black leading-tight tracking-tight text-white md:text-5xl">
          A simple blog that now feels like a real home base.
        </h2>
        <p class="mt-5 max-w-2xl text-base leading-7 text-slate-300 md:text-lg">
          Explore practical notes on web design, Laravel, and AI. Start with the latest posts, browse by category, or
          jump into the dashboard if you want to publish something new.
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
          <a href="/posts"
            class="inline-flex items-center justify-center rounded-full bg-sky-400 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-sky-300">
            Explore the blog
          </a>
          @auth
            <a href="/dashboard"
              class="inline-flex items-center justify-center rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/5">
              Open dashboard
            </a>
          @else
            <a href="/register"
              class="inline-flex items-center justify-center rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/5">
              Create an account
            </a>
          @endauth
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-3">
          <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
            <p class="text-3xl font-bold">{{ $stats['posts'] }}</p>
            <p class="mt-1 text-sm text-slate-300">Published posts</p>
          </div>
          <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
            <p class="text-3xl font-bold">{{ $stats['categories'] }}</p>
            <p class="mt-1 text-sm text-slate-300">Core categories</p>
          </div>
          <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
            <p class="text-3xl font-bold">{{ $stats['writers'] }}</p>
            <p class="mt-1 text-sm text-slate-300">Active writers</p>
          </div>
        </div>
      </div>

      <div class="grid gap-4 self-start">
        <div class="rounded-[1.75rem] border border-white/10 bg-white/10 p-5 backdrop-blur-sm">
          <p class="text-sm font-semibold uppercase tracking-[0.18em] text-sky-200">What you will find</p>
          <div class="mt-5 space-y-4">
            <div class="rounded-2xl bg-slate-900/70 p-4">
              <p class="text-sm font-semibold text-white">Design thinking</p>
              <p class="mt-1 text-sm text-slate-300">Clearer UI decisions, better copy, and more useful structure.</p>
            </div>
            <div class="rounded-2xl bg-slate-900/70 p-4">
              <p class="text-sm font-semibold text-white">Laravel workflow</p>
              <p class="mt-1 text-sm text-slate-300">Routing, debugging, and practical patterns for everyday work.</p>
            </div>
            <div class="rounded-2xl bg-slate-900/70 p-4">
              <p class="text-sm font-semibold text-white">AI product notes</p>
              <p class="mt-1 text-sm text-slate-300">Ways to build AI features that feel useful, calm, and trustworthy.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-8 grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
    <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
      <div class="flex items-center justify-between gap-3">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.18em] text-sky-700">Categories</p>
          <h3 class="mt-2 text-2xl font-bold text-slate-900">Browse by topic</h3>
        </div>
        <a href="/posts" class="text-sm font-semibold text-sky-700 hover:text-sky-900">View all posts</a>
      </div>

      <div class="mt-6 grid gap-4">
        @foreach ($categories as $category)
          <a href="/posts?category={{ $category->slug }}"
            class="group rounded-2xl border border-slate-200 p-4 transition hover:-translate-y-0.5 hover:border-sky-300 hover:shadow-md">
            <div class="flex items-center justify-between gap-3">
              <div class="flex items-center gap-3">
                <span class="h-3 w-3 rounded-full {{ $category->color }}"></span>
                <div>
                  <p class="font-semibold text-slate-900">{{ $category->name }}</p>
                  <p class="text-sm text-slate-500">{{ $category->posts_count }} posts available</p>
                </div>
              </div>
              <span class="text-sm font-semibold text-slate-400 transition group-hover:text-sky-700">Explore</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>

    <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
      <div class="flex items-center justify-between gap-3">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">Latest posts</p>
          <h3 class="mt-2 text-2xl font-bold text-slate-900">Start with something worth reading</h3>
        </div>
      </div>

      <div class="mt-6 space-y-4">
        @forelse ($featuredPosts as $post)
          <article class="rounded-2xl bg-slate-50 p-5 transition hover:bg-slate-100">
            <div class="flex items-center gap-3 text-sm text-slate-500">
              <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium {{ $post->category->color }}">
                {{ $post->category->name }}
              </span>
              <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <h4 class="mt-3 text-xl font-bold text-slate-900">
              <a href="/posts/{{ $post->slug }}" class="hover:text-sky-700">{{ $post->title }}</a>
            </h4>
            <p class="mt-2 text-sm leading-6 text-slate-600">
              {{ Str::limit(strip_tags($post->body), 150) }}
            </p>
            <div class="mt-4 flex items-center justify-between gap-3">
              <span class="text-sm font-medium text-slate-700">{{ $post->author->name }}</span>
              <a href="/posts/{{ $post->slug }}" class="text-sm font-semibold text-sky-700 hover:text-sky-900">
                Read article
              </a>
            </div>
          </article>
        @empty
          <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-slate-500">
            No posts yet. Add your first article from the dashboard.
          </div>
        @endforelse
      </div>
    </div>
  </section>
</x-layout>
