<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/deploy-app', function () {
    $output = "";

    if (request()->has('action')) {
        $action = request()->query('action');
        try {
            switch ($action) {
                case 'migrate':
                    Artisan::call('migrate', ['--force' => true]);
                    $output = "Migrations Run:\n" . Artisan::output();
                    break;
                case 'seed':
                    Artisan::call('db:seed', ['--force' => true]);
                    $output = "Seeding Complete:\n" . Artisan::output();
                    break;
                case 'clear':
                    Artisan::call('optimize:clear');
                    Artisan::call('view:clear');
                    Artisan::call('route:clear');
                    Artisan::call('config:clear');
                    $output = "Comprehensive Cache Cleared:\n" . Artisan::output();
                    break;
                case 'link':
                    $output = "Storage Link: Handled automatically via .htaccess rewrite rule. No symlink needed.";
                    break;
                case 'debug':
                    $config = config('filesystems.disks.public');
                    $output = "APP_URL: " . env('APP_URL') . "\n";
                    $output .= "FILESYSTEM_DISK: " . env('FILESYSTEM_DISK') . "\n";
                    $output .= "Default Disk: " . config('filesystems.default') . "\n";
                    $output .= "Public Disk Root: " . $config['root'] . "\n";
                    $output .= "Public Disk URL: " . $config['url'] . "\n";
                    $output .= "Base Path: " . base_path() . "\n";
                    break;
            }
        } catch (\Exception $e) {
            $output = "Error: " . $e->getMessage();
        }
    }

    $outputHtml = "";
    if ($output) {
        $safeOutput = htmlspecialchars($output);
        $outputHtml = "
        <div class='mt-6'>
            <h2 class='font-semibold text-gray-700 mb-2 border-b pb-1'>Output:</h2>
            <pre class='bg-gray-800 text-green-400 p-4 rounded overflow-x-auto text-sm font-mono'>{$safeOutput}</pre>
        </div>";
    }

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Sky Motors Deployment Tool</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .font-mono { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
    </style>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
        <h1 class="text-3xl font-extrabold mb-6 text-gray-900 border-b pb-4">Deployment Control Panel</h1>
        
        <div class="space-y-6">
            <div class="flex flex-wrap gap-3">
                <a href="?action=migrate" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-sm text-sm">Run Migrations</a>
                <a href="?action=seed" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-emerald-700 transition shadow-sm text-sm">Run Seeds</a>
                <a href="?action=link" class="bg-purple-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-purple-700 transition shadow-sm text-sm">Link Storage</a>
                <a href="?action=clear" class="bg-rose-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-rose-700 transition shadow-sm text-sm">Clear Cache</a>
                <a href="?action=debug" class="bg-gray-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-gray-700 transition shadow-sm text-sm">Debug Info</a>
            </div>

            $outputHtml
        </div>

        <div class="mt-10 text-xs text-gray-400 border-t pt-6 bg-gray-50 -mx-8 -mb-8 px-8 pb-8 rounded-b-2xl">
            <p class="font-bold text-gray-500 uppercase tracking-widest mb-2">Instructions:</p>
            <ul class="list-disc ml-5 space-y-1">
                <li>Use <strong>Clear Cache</strong> after any configuration or .env changes.</li>
                <li><strong>Debug Info</strong> displays current filesystem paths and URLs.</li>
                <li>Ensure images are uploaded to the <code>/uploads</code> directory.</li>
            </ul>
            <p class="mt-4 text-rose-500 font-semibold italic">Warning: This tool should be disabled or deleted for production security.</p>
        </div>
    </div>
</body>
</html>
HTML;
})->name('deploy.tool');
