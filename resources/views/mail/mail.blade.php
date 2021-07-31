Заказ <b>#{{ $order->id }}</b> <br><br>
Товары: <br>
@foreach ($materials as $k => $v)
<span><b>{{$v->name}}</b> ({{$order->order[$k]->count}} м²) ({{$order->order[$k]->price}} ₽)</span><br>
@endforeach
<br>
Цена: {{ $order->total }} ₽ <br> <br>
В скором времени с Вами свяжутся по почте! С уваженим <a href="{{route('main')}}">ООО "Графит"</a>!
