<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Grand Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Hotel Booker</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <img src="https://via.placeholder.com/800x400" class="img-fluid rounded shadow-sm" alt="Hotel Image">
                <h1 class="mt-4">{{ $hotel->name }}</h1>
                <p class="lead">A luxurious getaway with breathtaking views and world-class amenities.</p>
                <p>
                    <i class="fas fa-map-marker-alt"></i> {{ $hotel->location }}
                    <br>
                    @php
                        $rating = 4; // Example rating from 1 to 5
                    @endphp

                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $rating)
                            <i class="fas fa-star text-warning"></i>
                        @else
                            <i class="far fa-star text-warning"></i>
                        @endif
                    @endfor
                    ({{ $rating }}/5 Stars)
                </p>
            </div>
        </div>
    
        <hr class="my-5">
    
        <h2 class="mb-4">Our Rooms</h2>
        <div class="row">
            @foreach ($hotel->rooms as $room)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://picsum.photos/seed/{{ random_int(1, 1000) }}/640/480" class="card-img-top" alt="Standard Room">
                        <div class="card-body">
                        <h5 class="card-title">{{ $room->type }} Room</h5>
                            <p class="card-text"></p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-users"></i> Capacity: {{ $room->capacity }} adults</li>
                                <li><i class="fas fa-dollar-sign"></i> Price: {{ $room->price }} / night</li>
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>