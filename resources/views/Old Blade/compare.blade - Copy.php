<form method="POST" action="/compare">
    @csrf

    <table border="1">
        <tr>
            <th>Cards</th>
            <th>Counters</th>
        </tr>
        <tr>
            <td>
                <select name="cards[]" multiple size="10">
                    @foreach ($cards as $card)
                        <option value="{{ $card->card_id }}">
                            {{ $card->card_name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <p>Counter 1</p>
                <p>Counter 2</p>
            </td>
        </tr>
    </table>

    <button type="submit">Compare</button>
</form>
