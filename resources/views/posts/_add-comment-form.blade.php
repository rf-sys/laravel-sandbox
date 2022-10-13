@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments">
            @csrf

            <header class="flex items-center mb-2">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="no image" width="40"
                     height="40" class="rounded-xl">
                <h2 class="ml-4">Want to participate ?</h2>
            </header>


            <x-form.field>
                <x-form.textarea name="body"/>
                <x-form.error name="body" />

                <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                    <x-form.button>Post</x-form.button>
                </div>
            </x-form.field>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">Log in</a>
        to leave a comment.
    </p>
@endauth
