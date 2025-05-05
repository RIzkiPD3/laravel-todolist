<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <div>
                <a href="{{ route('tasks.edit', $task) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                        <h3 class="text-lg font-medium text-gray-900">{{ $task->title }}</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($task->status === 'To Do') bg-yellow-100 text-yellow-800
                                @elseif($task->status === 'In Progress') bg-blue-100 text-blue-800
                                @elseif($task->status === 'Done') bg-green-100 text-green-800
                                @elseif($task->status === 'Delayed') bg-red-100 text-red-800
                                @elseif($task->status === 'Cancelled') bg-gray-100 text-gray-800
                                @endif">
                                {{ $task->status }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700">{{ __('Description') }}</h4>
                        <div class="mt-2 text-sm text-gray-900">
                            {{ $task->description ?: __('No description provided.') }}
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700">{{ __('Due Date') }}</h4>
                        <div class="mt-2 text-sm text-gray-900">
                            {{ $task->due_date ? $task->due_date->format('Y-m-d H:i') : __('No due date set.') }}
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700">{{ __('Tags') }}</h4>
                        <div class="mt-2">
                            @forelse($task->tags as $tag)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-1">
                                    {{ $tag->name }}
                                </span>
                            @empty
                                <span class="text-sm text-gray-500">{{ __('No tags assigned.') }}</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700">{{ __('Created At') }}</h4>
                        <div class="mt-2 text-sm text-gray-900">
                            {{ $task->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700">{{ __('Last Updated') }}</h4>
                        <div class="mt-2 text-sm text-gray-900">
                            {{ $task->updated_at->format('Y-m-d H:i') }}
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-4">
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this task?')">
                                {{ __('Delete Task') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
