<div class="row" id="office_supplies_inputs">
    <div class="col-6">
        <label for="office_item">Office Item:</label>
        <input id="office_item" type="text" name="office_item" class="form-control  @error('office_item') is-invalid @endif" value="{{ $ticket->ticketable->office_item }}" placeholder="Enter office item">
        @error('office_item')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-6">
        <label for="quantity">Quantity:</label>
        <input id="quantity" type="number" step="1" min="0" name="quantity" class="form-control  @error('quantity') is-invalid @endif" value="{{ $ticket->ticketable->quantity }}" placeholder="Enter quantity">
        @error('quantity')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
