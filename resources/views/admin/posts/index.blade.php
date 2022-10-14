<x-layout>
    <x-setting heading="Manage Posts">
        <table class="table-auto">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="border-t mt-12">

            @foreach($posts as $post)
                <tr>
                    <td class="text-center min-w-full w-12">{{ $loop->index + 1 }}</td>
                    <td><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></td>
                    <td class="flex w-24">
                        <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                        <span class="text-gray-300 mx-1">|</span>
                        <form method="POST" action="/admin/posts/{{ $post->id }}">
                            @csrf
                            @method('DELETE')

                            <button class="text-xs text-gray-400">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-setting>
</x-layout>
