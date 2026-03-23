<footer class="mt-auto py-6 border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <flux:text size="sm" class="text-zinc-500">
            Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
        </flux:text>
        <div class="flex items-center gap-6">
            <flux:link href="#" size="sm" class="text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors">Privacy Policy</flux:link>
            <flux:link href="#" size="sm" class="text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors">Terms &amp; Conditions</flux:link>
        </div>
    </div>
</footer>
