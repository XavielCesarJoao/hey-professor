<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-container>
        <x-form pos :action="route('question.store')">
            <x-textarea name="question" label="Your Question"/>
            <x-btn.primary>Save</x-btn.primary>
            <x-btn.altenative>Cancel</x-btn.altenative>
        </x-form>
    </x-container>
</x-app-layout>
