<x-app-layout>
    <x-slot name="header">
        <!-- breadcrumb -->
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
                <a class=" text-slate-700 opacity-50" href="javascript:;">Pages</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-slate-700 before:content-['/']"
                aria-current="page">Favorite
            </li>
        </ol>
        <h6 class="mb-0 font-bold text-slate-700 capitalize">Favorite</h6>

    </x-slot>

    <div class="py-12">
        {{-- slot di sini --}}
        <div class="flex flex-wrap">
            <div class="flex-none w-full">
                <div
                    class="relative flex flex-col min-w-0 p-4 mx-10 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap p-4 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">

                        <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                            <h4 class="font-bold text-lg">List of Favorites</h4>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Title
                                        </th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Author
                                        </th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Created At
                                        </th>
                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($recipe->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center p-4">
                                                <span class="text-gray-500 text-xs">No favorite recipes found.</span>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($recipe as $data)
                                            <tr class="border-y">
                                                <td
                                                    class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2">
                                                        <div>
                                                            <img src="{{ asset('storage/' . $data->image_path) }}"
                                                                class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"
                                                                alt="recipe" />
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm leading-normal font-semibold">
                                                                {{ $data->title }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 text-sm leading-normal text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">

                                                    <span
                                                        class="bg-gradient-to-tl from-gray-600 to-gray-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                        {{ $data->user->name }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    <span class="text-xs font-semibold leading-tight text-slate-400">
                                                        {{ $data->created_at }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-2 align-middle text-center bg-transparent whitespace-nowrap shadow-transparent">
                                                    <a href="{{ route('recipe.show', $data->id) }}"
                                                        class="text-xs font-bold leading-tight text-slate-400 mr-4">
                                                        View
                                                    </a>

                                                    <a href="#" data-recipe-id="{{ $data->id }}"
                                                        class="favorite-btn text-xs font-bold leading-tight text-red-400 mr-4">
                                                        Remove
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            // cek semua tag a dengan class favorite-btn
            const favoriteLinks = document.querySelectorAll('.favorite-btn');
    
            favoriteLinks.forEach(link => {
                // apabila ada yg diklik
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior
    
                    // ambil resep id
                    const recipeId = this.getAttribute('data-recipe-id');
    
                    // Send the favorite toggle request to the server
                    fetch('/favorite', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ recipe_id: recipeId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                    
                        // refesh page
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        console.log('failed')
                    });
                });
            })
        </script>
    </x-slot>
    
</x-app-layout>
