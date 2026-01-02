<!DOCTYPE html>
<html>
<head>
    <title>Cards + Effects CRUD</title>
    <style>
        select {
            color: #000 !important;
            background-color: #fff !important;
            color-scheme: light;
        }

        select option {
            color: #000 !important;
            background-color: #fff !important;
        }

        body { 
            font-family: sans-serif; 
            max-width: 900px; 
            margin: 40px auto; 
            background-color: #03ad7aff;
            color: black;
        }

        input, textarea, select { 
            width: 100%; 
            margin-bottom: 10px; 
            padding: 6px; 
        }

        .flex-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .flex-row label {
            margin-bottom: 0;
            width: auto;
            font-weight: bold;
        }

        .effect-group { 
            border: 1px solid #ccc; 
            padding: 10px; 
            margin-bottom: 10px; 
            position: relative; 
            background-color: #f0f0f0; 
            border-radius: 6px;
        }

        .remove-btn { 
            position: absolute; 
            top: 5px; 
            right: 5px; 
            background:#dc2626; 
            color:white; 
            border:none; 
            padding:4px 8px; 
            cursor:pointer; 
        }

        button.add-effect { 
            margin-bottom: 20px; 
            padding:8px 16px; 
            background:#2563eb; 
            color:white; 
            border:none; 
            cursor:pointer; 
            border-radius:6px;
        }

        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 30px; 
            background-color: #f0f0f0; 
            border-radius: 6px;
        }

        table, th, td { 
            border: 1px solid #ccc; 
        }

        th, td { 
            padding: 8px; 
            text-align: left; 
        }

        .delete-btn { background-color:#dc2626; color:white; }
        .save-btn { background-color:#16a34a; color:white; }
        .edit-btn { background:#2563eb; color:white; padding:4px 8px; text-decoration:none; border-radius:4px; }
        .home-btn { padding:8px 16px; background:#2563eb; color:white; border:none; border-radius:6px; text-decoration:none; }
    </style>
</head>
<body>

@php
    $isEdit = isset($card);
@endphp

<a href="/" class="home-btn">← Return to Home</a>

<h1>{{ $isEdit ? 'Edit Card + Effects' : 'Add Card + Effects' }}</h1>

@if(session('success'))
    <p style="color:lightgreen;">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ $isEdit ? route('cards.update', $card->card_id) : route('cards.store') }}">
@csrf
@if($isEdit)
    @method('PUT')
@endif

{{-- ===================== --}}
{{-- Card Info --}}
{{-- ===================== --}}
<h2>Card Info</h2>

<label>Card Name</label>
<input type="text" name="card_name"
       value="{{ old('card_name', $card->card_name ?? '') }}"
       required>

<div class="flex-row">
    <label>Card Type</label>
    <label>Handtrap?</label>
</div>

<div style="display: flex; gap: 10px;">
    <select name="card_category_id" required style="flex: 2;">
        <option value="" disabled>— Select Card Category —</option>
        @foreach ($categories as $category)
            <option value="{{ $category->card_category_id }}"
                {{ old('card_category_id', $card->card_category_id ?? null) == $category->card_category_id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>

    <select name="handtrap" required style="flex: 1;">
        <option value="0" {{ old('handtrap', $card->handtrap ?? 0) == 0 ? 'selected' : '' }}>No</option>
        <option value="1" {{ old('handtrap', $card->handtrap ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
    </select>
</div>

{{-- ===================== --}}
{{-- Effects --}}
{{-- ===================== --}}
<h2 style="margin-top: 20px;">Effects</h2>

<div id="effectsContainer">

@php $effectIndex = 0; @endphp

@foreach(old('effects', $card->effects ?? [null]) as $effect)
<div class="effect-group">
<h4>Effect {{ $effectIndex + 1 }}</h4>

<label>Action</label>
<select name="effects[{{ $effectIndex }}][action_id]" required>
    <option value="" disabled>— Select Action —</option>
    @foreach ($actions as $action)
        <option value="{{ $action->action_id }}"
            {{ old("effects.$effectIndex.action_id", $effect->action_id ?? null) == $action->action_id ? 'selected' : '' }}>
            {{ $action->action_name }}
        </option>
    @endforeach
</select>

<label>Activation Location</label>
<select name="effects[{{ $effectIndex }}][activation_location_id]" required>
    @foreach ($activationLocations as $loc)
        <option value="{{ $loc->location_id }}"
            {{ old("effects.$effectIndex.activation_location_id", $effect->activation_location_id ?? null) == $loc->location_id ? 'selected' : '' }}>
            {{ $loc->location_name }}
        </option>
    @endforeach
</select>

<label>Target Location</label>
<select name="effects[{{ $effectIndex }}][target_location_id]" required>
    @foreach ($targetLocations as $loc)
        <option value="{{ $loc->location_id }}"
            {{ old("effects.$effectIndex.target_location_id", $effect->target_location_id ?? null) == $loc->location_id ? 'selected' : '' }}>
            {{ $loc->location_name }}
        </option>
    @endforeach
</select>

<label>Target Type</label>
<select name="effects[{{ $effectIndex }}][target_type_id]" required>
    @foreach ($targetTypes as $type)
        <option value="{{ $type->target_type_id }}"
            {{ old("effects.$effectIndex.target_type_id", $effect->target_type_id ?? null) == $type->target_type_id ? 'selected' : '' }}>
            {{ $type->target_name }}
        </option>
    @endforeach
</select>

<label>Trigger</label>
<select name="effects[{{ $effectIndex }}][trigger_id]">
    <option value="">— No Trigger —</option>
    @foreach ($triggers as $trigger)
        <option value="{{ $trigger->trigger_id }}"
            {{ old("effects.$effectIndex.trigger_id", $effect->trigger_id ?? null) == $trigger->trigger_id ? 'selected' : '' }}>
            {{ $trigger->trigger_name }}
        </option>
    @endforeach
</select>

<label>Notes</label>
<textarea name="effects[{{ $effectIndex }}][notes]">{{ old("effects.$effectIndex.notes", $effect->notes ?? '') }}</textarea>

@if($effectIndex > 0)
<button type="button" class="remove-btn">Remove</button>
@endif
</div>

@php $effectIndex++; @endphp
@endforeach
</div>

<button type="button" class="add-effect">+ Add Another Effect</button>

<br><br>
<button type="submit" class="save-btn">
    {{ $isEdit ? 'Update Card + Effects' : 'Save Card + Effects' }}
</button>
</form>

{{-- ===================== --}}
{{-- Existing Cards --}}
{{-- ===================== --}}
<h2>Existing Cards</h2>

<table>
<tr>
    <th>Card</th>
    <th>Handtrap</th>
    <th>Category</th>
    <th>Effects</th>
    <th>Actions</th>
</tr>

@foreach ($cards as $c)
<tr>
    <td>{{ $c->card_name }}</td>
    <td>{{ $c->handtrap ? 'Yes' : 'No' }}</td>
    <td>{{ $c->category->category_name ?? '—' }}</td>
    <td>
        @foreach ($c->effects as $e)
            <div><strong>{{ $e->action->action_name }}</strong></div>
        @endforeach
    </td>
    <td>
        <a href="{{ route('cards.edit', $c->card_id) }}" class="edit-btn">Edit</a>

        <form method="POST" action="{{ route('cards.destroy', $c->card_id) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="delete-btn">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

<script>
let effectIndex = {{ $effectIndex }};
const container = document.getElementById('effectsContainer');

document.querySelector('.add-effect').addEventListener('click', () => {
    const div = document.createElement('div');
    div.className = 'effect-group';

    div.innerHTML = `
    <h4>Effect ${effectIndex + 1}</h4>
    <label>Action</label>
    <select name="effects[${effectIndex}][action_id]" required>
        @foreach ($actions as $action)
            <option value="{{ $action->action_id }}">{{ $action->action_name }}</option>
        @endforeach
    </select>
    <button type="button" class="remove-btn">Remove</button>
    `;

    container.appendChild(div);
    effectIndex++;

    div.querySelector('.remove-btn').addEventListener('click', () => div.remove());
});
</script>

</body>
</html>
