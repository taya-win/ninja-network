<x-layout>
    <h2>Currently Available Ninjas</h2>
    {{-- @if ($greeting === 'hello')
        <p>Hi from inside the if statement</p>
    @endif --}}

    <ul>
        @foreach ($ninjas as $ninja)
        <li>
            <x-card href="{{ route('ninjas.show', $ninja->id) }}" :highlight="$ninja->skill > 70">
                <h3>{{$ninja->name}}</h3>
            </x-card>
        </li>
        @endforeach
    </ul>
</x-layout>
