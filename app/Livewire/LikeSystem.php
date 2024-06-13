<?php

namespace App\Livewire;

use App\Events\LikeNotify;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeSystem extends Component
{
    public $postId;
    public $interaction;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->interaction = PostUser::where('post_id', $postId)
            ->where('user_id', Auth::id())
            ->first();
    }

    public function like()
    {
        if (!Auth::check()) {
            $this->dispatch('notifyLogin');
            return;
        }

        if ($this->interaction) {
            if ($this->interaction->reaction === 'like') {
                $this->interaction->delete();
            } else {
                $this->interaction->update(['reaction' => 'like']);
            }
        } else {
            PostUser::create([
                'user_id' => Auth::id(),
                'post_id' => $this->postId,
                'reaction' => 'like'
            ]);

            $post = Post::find($this->postId);
            $user = auth()->user();
            event(new LikeNotify($post, $user));
        }

        $this->updateInteraction();
    }

    public function dislike()
    {
        if (!Auth::check()) {
            $this->dispatch('notifyLogin');
            return;
        }

        if ($this->interaction) {
            if ($this->interaction->reaction === 'dislike') {
                $this->interaction->delete();
            } else {
                $this->interaction->update(['reaction' => 'dislike']);
            }
        } else {
            PostUser::create([
                'user_id' => Auth::id(),
                'post_id' => $this->postId,
                'reaction' => 'dislike'
            ]);
        }

        $this->updateInteraction();
    }

    private function updateInteraction()
    {
        $this->interaction = PostUser::where('post_id', $this->postId)
            ->where('user_id', Auth::id())
            ->first();
    }

    public function render()
    {
        return view('livewire.like-system', [
            'likes' => PostUser::where('post_id', $this->postId)->where('reaction', 'like')->count(),
            'dislikes' => PostUser::where('post_id', $this->postId)->where('reaction', 'dislike')->count(),
        ]);
    }
}
