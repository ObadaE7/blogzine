<div class="section__reactions">
    <button wire:click="like"
        class="reaction__like {{ $interaction && $interaction->reaction === 'like' ? 'active' : '' }}">
        {{ $likes }}
    </button>

    <button wire:click="dislike" class="reaction__dislike {{ $interaction && $interaction->reaction === 'dislike' ? 'active' : '' }}">
        {{ $dislikes }}
    </button>
</div>
