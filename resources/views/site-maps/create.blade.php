<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold dark:text-gray-200 mb-4">
                        Create Site Map
                    </h2>
                    <form action="{{ route('site-maps.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm">
                                <span class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                    URL
                                </span>

                                <input type="text" name="url" id="url"
                                    class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                                    id="url">

                                @error('url')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </label>
                        </div>

                        <div class="mb-4">
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Note</span>
                                <textarea name="note" id="note"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                    rows="3" placeholder="Note"></textarea>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
