<div class="form-row">
    <label>Sender
        <select name="sender_id" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('sender_id', $connection->sender_id) == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </label>
    <label>Receiver
        <select name="receiver_id" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('receiver_id', $connection->receiver_id) == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </label>
</div>
<x-field-error name="sender_id" />
<x-field-error name="receiver_id" />

<label>Status
    <select name="status" required>
        @foreach (['liked', 'passed', 'matched', 'blocked'] as $status)
            <option value="{{ $status }}" @selected(old('status', $connection->status) === $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
</label>
<x-field-error name="status" />

<label>Note
    <textarea name="note" rows="4">{{ old('note', $connection->note) }}</textarea>
</label>
<x-field-error name="note" />
