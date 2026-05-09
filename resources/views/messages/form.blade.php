<label>Connection
    <select name="connection_id" required>
        @foreach ($connections as $connection)
            <option value="{{ $connection->id }}" @selected(old('connection_id', $message->connection_id) == $connection->id)>
                {{ $connection->sender->name }} + {{ $connection->receiver->name }}
            </option>
        @endforeach
    </select>
</label>
<x-field-error name="connection_id" />

<label>Sender
    <select name="sender_id" required>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @selected(old('sender_id', $message->sender_id) == $user->id)>{{ $user->name }}</option>
        @endforeach
    </select>
</label>
<x-field-error name="sender_id" />

<label>Message
    <textarea name="body" rows="5" required>{{ old('body', $message->body) }}</textarea>
</label>
<x-field-error name="body" />

<label>Read At
    <input type="datetime-local" name="read_at" value="{{ old('read_at', $message->read_at?->format('Y-m-d\TH:i')) }}">
</label>
<x-field-error name="read_at" />
