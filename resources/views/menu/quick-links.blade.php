<ul class="quick-links">
    @foreach ($items as $item)
    <li>
        <a  href="{{ $item->url}}" target="{{ $item->target }}" > {{ $item->title }}</a>
    </li>
    @endforeach
</ul>
