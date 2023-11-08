<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold dark:text-gray-200 mb-4">
                        Create SOW
                    </h2>
                    <form method="post" action="{{ route('generate.sow') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm">
                                <span class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                    Prompt/Instructions
                                </span>


                                <textarea name="prompt" id="prompt" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="">Consider you are an experienced system analyst. Now Please help me with creating an Scope of Work Based on following Conversation -  </textarea>

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
                                    rows="3" placeholder="Note"> </textarea>
                            </label>

                            @error('note')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div>
                            <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs dark:text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Create
                        </button>

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

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
