@if ($isPersonalProfile ?? false)
    <div class="account-panel">
        <span>Your account</span>
        <strong>{{ auth()->user()->name }}</strong>
        <small>{{ ucfirst(auth()->user()->role) }} - {{ auth()->user()->email }}</small>
    </div>
@else
    <label>User
        <select name="user_id" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id', $profile->user_id) == $user->id)>{{ $user->name }} ({{ $user->role }})</option>
            @endforeach
        </select>
    </label>
    <x-field-error name="user_id" />
@endif

<label>Headline
    <input class="@error('headline') is-invalid @enderror" name="headline" value="{{ old('headline', $profile->headline) }}" required maxlength="120">
</label>
<x-field-error name="headline" />

<label>Bio
    <textarea class="@error('bio') is-invalid @enderror" name="bio" rows="5" required>{{ old('bio', $profile->bio) }}</textarea>
</label>
<x-field-error name="bio" />

<div class="form-row">
    <label>Department
        <input class="@error('department') is-invalid @enderror" name="department" value="{{ old('department', $profile->department) }}" required>
    </label>
    <label>Level
        <input class="@error('level') is-invalid @enderror" name="level" value="{{ old('level', $profile->level) }}" placeholder="L2, Master, Teacher">
    </label>
</div>
<x-field-error name="department" />

<label>Profile Photo
    <input class="@error('avatar') is-invalid @enderror" type="file" name="avatar" accept="image/*">
</label>
<x-field-error name="avatar" />

@if (! auth()->check() || auth()->user()->role === 'teacher')
    <label class="checkbox">
        <input type="checkbox" name="available_for_mentoring" value="1" @checked(old('available_for_mentoring', $profile->available_for_mentoring))>
        Available for mentoring
    </label>
@endif

<fieldset>
    <legend>Interests</legend>
    <div class="checkbox-grid">
        @foreach ($interests as $interest)
            <label>
                <input type="checkbox" name="interests[]" value="{{ $interest->id }}" @checked(in_array($interest->id, old('interests', $selectedInterests)))>
                {{ $interest->name }}
            </label>
        @endforeach
    </div>
</fieldset>
<x-field-error name="interests" />
