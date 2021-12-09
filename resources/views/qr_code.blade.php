<!DOCTYPE html>
<html>
<body>
<div class="visible-print text-center">
    {!! QrCode::size(300)->generate($code); !!}
</div>
</body>
</html>
