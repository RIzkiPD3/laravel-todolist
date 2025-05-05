<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tag Details') }}: {{ $tag->name }}
            </h2>
            <div>
                <a href="{{ route('tags.edit', $tag) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('tags.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ $tag->name }}</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tag->is_default ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ $tag->is_default ? __('Default') : __('Custom') }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700">{{ __('Tasks with this tag') }}</h4>
                        <div class="mt-4">
                            @if($tasks->isEmpty())
                                <p class="text-sm text-gray-500">{{ __('No tasks found with this tag.') }}</p>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Title') }}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Status') }}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Due Date') }}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Actions') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($tasks as $task)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900">
                                                            {{ $task->title }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            @if($task->status === 'To Do') bg-yellow-100 text-yellow-800
                                                            @elseif($task->status === 'In Progress') bg-blue-100 text-blue-800
                                                            @elseif($task->status === 'Done') bg-green-100 text-green-800
                                                            @elseif($task->status === 'Delayed') bg-red-100 text-red-800
                                                            @elseif($task->status === 'Cancelled') bg-gray-100 text-gray-800
                                                            @endif">
                                                            {{ $task->status }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $task->due_date ? $task->due_date->format('Y-m-d') : 'No due date' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900">
                                                            {{ __('Edit') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(!$tag->is_default)
                        <div class="mt-8 border-t pt-4">
                            <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this tag?')">
                                    {{ __('Delete Tag') }}
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>