<div class="row" id="equipment_inputs">
    <div class="col-12">
        <label for="category_select">Equipment category:</label>
        <select name="equipment_category_id" id="category_select" class="form-control @error('equipment_category_id') is-invalid @endif">
            <option value="">- select a category -</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $ticket->ticketable->equipment_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('equipment_category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
