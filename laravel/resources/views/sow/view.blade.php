<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold dark:text-gray-200 mb-4">
                        SOW Details
                    </h2>
                    <form method="post" action="{{ route('generate.sow') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm">
                                <span class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                    Prompt/Instructions
                                </span>


                                <textarea name="prompt" id="prompt" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="">{{ $sow->prompt }}</textarea>

                                @error('url')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </label>
                        </div>

                        <div class="mb-4">
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Your Conversation/Project Description</span>
                                <textarea name="description" id="description"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                    rows="3" placeholder="Note">{{ $sow->description }}</textarea>
                            </label>

                            @error('note')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        </div>
                    </form>
                </div>

                <div class="p-6">
                    <h2 class="text-lg font-semibold dark:text-gray-200 mb-4">
                        SOW Details
                    </h2>

                    <!-- Visual Sitemap -->
                    {{-- <h2 class="text-lg font-semibold dark:text-gray-200 mt-8">Tree</h2> --}}
                    <div class="mt-4">
                        <div class="dark:bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200 p-4">
                            <!-- Whois info content -->
                            @markdown($sow->sow)
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
