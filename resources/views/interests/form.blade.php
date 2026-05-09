<label>Name
    <input name="name" value="{{ old('name', $interest->name) }}" required>
</label>
<x-field-error name="name" />

<label>Category
    <input name="category" value="{{ old('category', $interest->category) }}" required>
</label>
<x-field-error name="category" />

<label>Description
    <textarea name="description" rows="4">{{ old('description', $interest->description) }}</textarea>
</label>
<x-field-error name="description" />
