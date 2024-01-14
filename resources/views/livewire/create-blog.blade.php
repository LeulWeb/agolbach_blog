<main class="format w-full mx-auto lg:format-lg py-2 my-5">
    <h2 class="text-center">Create new blog Post</h2>
    <a href="{{ route('blog') }}" wire:navigate>
        <div class="flex space-x-1 items-center text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>

            <p>Back</p>
        </div>
    </a>



    <form method="post" wire:submit="save" enctype="multipart/form-data">


        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Blog title goes in here" wire:model.live="title">
        </div>
        @error('title')
            <span class="error text-sm text-red-500">{{ $message }}</span>
        @enderror




        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
        <textarea id="message" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Blog post content goes here..." wire:model.live="description"></textarea>


        @error('description')
            <span class="error text-sm text-red-500">{{ $message }}</span>
        @enderror




        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image</label>

        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">

                @if ($image)
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <img src="{{ $image->temporaryUrl() }}" class=" bg-cover w-full h-64" alt="">
                </div>
                @else
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>

                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400"> PNG, JPG or JPEG (MAX. 6MB)</p>
                    </div>
                @endif
                <input id="dropzone-file" type="file" wire:model="image" accept="image/png image/jpeg image/jpg"
                    class="hidden" />
            </label>
        </div>

        @error('image')
            <span class="error text-sm text-red-500">{{ $message }}</span>
        @enderror



        <button type="submit" class="text-white bg-blue-700 w-full my-3 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>

    </form>



</main>
