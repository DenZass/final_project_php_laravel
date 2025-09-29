@php
$room = \App\Models\Room::find($booking->room_id);
//var_dump($booking);
$hotel = \App\Models\Hotel::find($room->hotel_id);
@endphp
<div>
    <h3>Отель успешно забронирован</h3>
    <p>id бронирования - {{$booking->id}}</p>
    <p>Название отеля - {{$hotel->title}}</p>
    <p>Адрес отеля - {{$hotel->address}}</p>
    <p>id комнаты - {{$booking->room_id}}</p>
    <p>Название комнаты - {{$room->title}}</p>
    <p>Дата заселения - {{\Carbon\Carbon::parse($booking->started_at)->format('d.m.Y')}}</p>
    <p>Дата выезда - {{\Carbon\Carbon::parse($booking->finished_at)->format('d.m.Y')}}</p>
    <p>Кол-во дней - {{$booking->days}}</p>
    <p>Цена - {{$booking->price}}</p>
</div>
