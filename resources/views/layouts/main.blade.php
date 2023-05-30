<!DOCTYPE html>
<html lang="en">
    @include('layouts.components.head')
<body>
    @include('layouts.components.header')

    <div class="container">
        @yield('content')
    </div>
</body>
</html>