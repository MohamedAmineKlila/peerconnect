@props(['type' => 'success', 'message'])

<div class="alert {{ $type === 'danger' ? 'alert-danger' : 'alert-success' }}">
    {{ $message }}
</div>
