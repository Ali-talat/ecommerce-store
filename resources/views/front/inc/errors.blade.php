@if ($errors->any())

    <ul>
        @foreach ($errors->all() as $error)
            <li>
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            </li>
        @endforeach
    </ul>
@endif