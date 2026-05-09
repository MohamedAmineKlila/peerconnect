@php($contactMessage = $contactMessage ?? new \App\Models\ContactMessage())

<label>Name
    <input name="name" value="{{ old('name', $contactMessage->name) }}" required>
</label>
<x-field-error name="name" />

<label>Email
    <input type="email" name="email" value="{{ old('email', $contactMessage->email) }}" required>
</label>
<x-field-error name="email" />

<label>Subject
    <input name="subject" value="{{ old('subject', $contactMessage->subject) }}" required>
</label>
<x-field-error name="subject" />

<label>Message
    <textarea name="message" rows="6" required>{{ old('message', $contactMessage->message) }}</textarea>
</label>
<x-field-error name="message" />
