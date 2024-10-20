<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">
        <link rel="canonical" href="">
         @vite('resources/css/app.css')
        <meta name="description"">

        <title>test</title>
        
        
    </head>
    <body>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-green-700 font-roboto">
            @include('_layouts.sidebar')
            
            <div class="flex-1 flex flex-col overflow-hidden">
                @include('_layouts.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-orange-200">
                    <div class="container mx-auto px-6 py-8">
                        @yield('body')
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
