<div class="row" id="equipment_inputs">
    <div class="col-12">
        <label for="category_select">Equipment:</label>
        <select name="ticket_data[equipment_id]" id="category_select" class="form-control @error('ticket_data.equipment_id') is-invalid @endif">
            <option value="">- select equipment -</option>
            @foreach(auth()->user()->items as $item)
                <option value="{{ $item->equipment->id }}" {{ old('ticket_data.equipment_id') == $item->equipment->id ? 'selected' : '' }}>{{ $item->equipment->name }}</option>
            @endforeach
        </select>
        @error('ticket_data.equipment_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
