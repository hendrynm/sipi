<!DOCTYPE html>
<html lang="id">
@include("_partials.head")
<body>
@include("_partials.topbar")
@include("_partials.sidebar")
@include("_partials.chartjs")
<main>
    @section("konten")
    @show
</main>
@include("_partials.footer")
@include("_partials.js")
@section("js")
@show
</body>
</html>
