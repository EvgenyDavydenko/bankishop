<form class="text-white ms-5" action="{{ route('images.index') }}" method="GET">
    <div>
        <label>sort by name:</label>
        <select name="name" onchange="this.form.submit()">
            <option value="desc">desc</option>
            <option value="asc">asc</option>
        </select>
    </div>
</form>
<form class="text-white ms-5" action="{{ route('images.index') }}" method="GET">
    <div>
        <label>sort by date:</label>
        <select name="date" onchange="this.form.submit()">
            <option value="desc">desc</option>
            <option value="asc">asc</option>
        </select>

    </div>
</form>