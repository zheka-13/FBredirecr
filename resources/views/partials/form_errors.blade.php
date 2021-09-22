@if (!empty($errors))
    <div style='margin-top: 10px' class="alert alert-danger" role="alert">
        @foreach ($errors as $field => $field_errors)
            @foreach ($field_errors as $error)
                <p><strong>{{ $field }}</strong>: {{ $error }}</p>
            @endforeach
        @endforeach
    </div>
@endif
