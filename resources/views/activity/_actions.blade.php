@auth

<div class="d-flex gap-1 ms-2">

    @if(in_array($activity->activity_id, $wishlistIds))

        <form
            action="{{ route('wishlist.destroy', $activity->activity_id) }}"
            method="POST"
            class="flex-fill">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger w-100">
                <i class="bi bi-heart-fill me-1"></i>
            </button>

        </form>

    @else

        <form
            action="{{ route('wishlist.store') }}"
            method="POST"
            class="flex-fill">

            @csrf

            <input
                type="hidden"
                name="activity_id"
                value="{{ $activity->activity_id }}">

            <button
                type="submit"
                class="btn btn-outline-danger w-100">
                <i class="bi bi-heart me-1"></i>
            </button>

        </form>

    @endif

    <a href="{{ route('activity.show', $activity->activity_id) }}"
    class="btn btn-primary px-4">
    Ver
    </a>

</div>

@endauth