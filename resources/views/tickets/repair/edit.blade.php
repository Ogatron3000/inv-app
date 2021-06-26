<div class="row" id="equipment_inputs">
    <div class="col-12">
        <label for="category_select">Equipment:</label>
        <select name="equipment_id" id="select" class="form-control @error('equipment_id') is-invalid @endif">
            <option value="">- select equipment -</option>
            @foreach(auth()->user()->items as $item)
                <option value="{{ $item->equipment->id }}" {{ $ticket->ticketable->equipment_id == $item->equipment->id ? 'selected' : '' }}>{{ $item->equipment->name }}</option>
            @endforeach
        </select>
        @error('equipment_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
