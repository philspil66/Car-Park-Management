                @foreach ($events as $event)
                    {{ $event->id }}. {{ $event->title }} {{ $event->date }} {{ $event->time }}<br />
                @endforeach

                {!! $events->render() !!}
