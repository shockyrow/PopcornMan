<div class="row">
    <form class="col" action="{{ Request::url() }}" method="GET">
        <div class="input-group input-group-lg mb-2">
            <input class="form-control" name="q" placeholder="Search..." autocomplete="off" list="movieNames"
                   value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}"/>

            <datalist id="movieNames" class="w-100">
                @foreach($list as $movieTitle)
                    <option class="w-100" value="{{ $movieTitle }}">
                    </option>
                @endforeach
            </datalist>

            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>