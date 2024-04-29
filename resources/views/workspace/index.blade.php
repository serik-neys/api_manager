<x-layout>
    <x-header></x-header>
    <a href="{{ route('workspace.create') }}">Create Workspace</a>
    <div class="workspace">
        <h1>Workspaces List</h1>

        @foreach ($workspaces as $workspace)
            <a href="{{ route('workspace.show', $workspace) }}">
                <div class="item">
                    <h3>{{ $workspace->title }}</h3>
                    <p>{{ $workspace->description }}</p>
                </div>
            </a>
        @endforeach

        @empty($workspaces->count())
            No Workspaces
        @endempty


    </div>
</x-layout>
