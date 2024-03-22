
@props([
    'label',
    'name',
])

<div class="mb-4">

    <label for="{{$name}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{$label}}</label>
    <textarea id="{{$name}}" rows="4" name="{{$name}}"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50
                                  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500
                                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Ask m anything">{{old('question')}}</textarea>
    @error('question')
    <span class="text-red-700">{{ $message }}</span>
    @enderror
</div>