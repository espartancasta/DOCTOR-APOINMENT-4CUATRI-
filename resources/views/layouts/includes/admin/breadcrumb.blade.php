@if (count($breadcrumbs) > 0)
    <nav class="mb-2 block">
        <ol class="flex flex-wrap text-slate-700 text-sm">
            @foreach ($breadcrumbs as $item)
                <li class="flex items-center">
                    @unless ($loop->first)
                        <span class="px-2 text-gray-400">/</span>
                    @endunless

                    @isset($item['href'])
                        <a href="{{ $item['href'] }}" class="opacity-60 hover:opacity-100">
                            {{ $item['name'] }}
                        </a>
                    @else
                        {{ $item['name'] }}
                    @endisset
                </li>
            @endforeach
<<<<<<< HEAD
        </ol>
=======
        </ol>z
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)

        @if (count($breadcrumbs) > 1)
            <h6 class="font-bold mt-2">
                {{ end($breadcrumbs)['name'] }}
            </h6>
        @endif
    </nav>
@endif
