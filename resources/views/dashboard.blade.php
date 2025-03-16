<x-app-layout>
    <x-slot name="header">
        <!-- breadcrumb -->
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
                <a class=" text-slate-700 opacity-50" href="javascript:;">Pages</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-slate-700 before:content-['/']"
                aria-current="page">Dashboard
            </li>
        </ol>
        <h6 class="mb-0 font-bold text-slate-700 capitalize">Dashboard</h6>

    </x-slot>

    <div class="py-12">
        {{-- slot di sini --}}

        <div class="w-full px-6 py-6 mx-auto">
            <!-- card -->
            <div class="flex flex-wrap mx-6">
                <!-- card1 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Total My Recipes</p>
                                        <h5 class="mb-2 font-bold dark:text-white">{{ $my_recipe->count() }}</h5>
                                       
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                        <i
                                            class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Total Favorite Recipes</p>
                                        <h5 class="mb-2 font-bold dark:text-white">{{ $favorite->count() }}</h5>
                                        
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                        <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8 flex flex-col flex-auto p-4 mx-10 overflow-hidden break-words bg-white border-0 shadow-3xl rounded-2xl bg-clip-border">
                <div class="flex flex-col items-center">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div
                            class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                            <img src="{{ asset('assets/img/home-decor-1.jpg') }}" alt="profile_image"
                                class="w-full shadow-2xl rounded-xl" />
                        </div>
                    </div>

                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full text-center">
                            <h5 class="mb-1 text-lg font-bold">Turn Ingredients into Inspiration</h5>
                            <p class="mb-0 font-semibold leading-normal text-sm">
                                Let your imagination run wild! Create recipes that showcase the ingredients you love.
                            </p>
                        </div>
                    </div>

                    <div class="w-full max-w-full px-3 mx-auto mt-6">
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('recipe.create') }}"
                                class="hidden px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-sm bg-blue-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                <i class="fa fa-plus text-2.8 mr-2"></i>
                                Create New Recipe
                            </a>

                            <a href="{{ route('recipe.index') }}"
                                class="hidden px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-sm bg-gray-800 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                View My Recipe
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            {{-- list resep --}}
            <div class="flex flex-wrap p-4 mx-6 mt-8">
                <div class="w-full flex flex-col items-center mb-4">
                    <h4 class="font-bold text-lg">Discover Our Recipes</h4>
                    <p>Explore a variety of delicious recipes crafted by our community.</p>
                </div>
                
                @foreach ($all_recipe as $data)
                    <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0 mb-4">
                        <a href="{{ route('recipe.show', $data->id) }}"
                            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                            <img class="w-full h-[180px] rounded-t-2xl" src="{{ asset('storage/'.$data->image_path) }}"
                                alt="cover recipe">

                            <div class="flex-auto p-6 pt-0">

                                <div class="mt-6 text-center">

                                    <div class="mb-2 font-semibold leading-relaxed text-xs text-slate-700">
                                        
                                        <span class="bg-gradient-to-tl from-gray-600 to-gray-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            {{ $data->user->name }}
                                        </span>
                                    </div>

                                    <div class="mt-6 mb-2 font-semibold leading-relaxed text-base text-slate-700">
                                        {{ $data->title }}
                                    </div>
                                </div>
                            </div>

                            <div class="border-black/12.5 rounded-t-2xl p-6 text-center pt-0 pb-6 lg:pt-2 lg:pb-4">
                                <div class="flex justify-between">
                                    <span class="text-slate-700 text-sm">
                                        <i class="fa fa-clock-o"></i>
                                        {{ $data->cooking_time }} Min
                                    </span>       
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
</x-app-layout>
