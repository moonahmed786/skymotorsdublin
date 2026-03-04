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
            <h2 class='font-semibold text-gray-700 mb-2'>Output:</h2>
            <pre class='bg-gray-800 text-green-400 p-4 rounded overflow-x-auto text-sm'>{$safeOutput}</pre>
        </div>";
    }

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Sky Motors Deployment Tool</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Deployment Control Panel</h1>
        
        <div class="space-y-4">
            <div class="flex space-x-2">
                <a href="?action=migrate" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">Run Migrations</a>
                <a href="?action=seed" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">Run Seeds</a>
                <a href="?action=link" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 text-sm">Link Storage</a>
                <a href="?action=clear" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">Clear Cache</a>
            </div>

            $outputHtml
        </div>

        <div class="mt-8 text-sm text-gray-500 border-t pt-4">
            <p><strong>Note:</strong> Ensure your .env is correctly configured before running migrations.</p>
            <p class="mt-2 text-red-500 italic">Warning: Remove this file or disable this route after successful deployment!</p>
        </div>
    </div>
</body>
</html>
HTML;
})->name('deploy.tool');
