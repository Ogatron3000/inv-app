<div class="row" id="office_supplies_inputs">
    <div class="col-6">
        <label for="office_item">Office Item:</label>
        <input id="office_item" type="text" name="ticket_data[office_item]" class="form-control  @error('ticket_data.office_item') is-invalid @endif" value="{{ old('ticket_data.office_item') }}" placeholder="Enter office item">
        @error('ticket_data.office_item')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-6">
        <label for="quantity">Quantity:</label>
        <input id="quantity" type="number" step="1" min="0" name="ticket_data[quantity]" class="form-control  @error('ticket_data.quantity') is-invalid @endif" value="{{ old('ticket_data.quantity') }}" placeholder="Enter quantity">
        @error('ticket_data.quantity')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
