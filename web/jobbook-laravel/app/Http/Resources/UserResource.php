<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{

    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    // public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,

            // 'expires_at' => $this->whenPivotLoaded('role_user', function () {
            //     return $this->pivot->expires_at;
            // }),

            // 'expires_at' => $this->whenPivotLoaded(new Membership, function () {
            //     return $this->pivot->expires_at;
            // }),

            // 'expires_at' => $this->whenPivotLoadedAs('subscription', 'role_user', function () {
            //     return $this->subscription->expires_at;
            // }),

            'email' => $this->email,

            // 'posts' => PostResource::collection($this->posts),
            // 'posts' => PostResource::collection($this->whenLoaded('posts')),

            // 'secret' => $this->when(Auth::user()->isAdmin(), 'secret-value'),

            // 'secret' => $this->when(Auth::user()->isAdmin(), function () {
            //     return 'secret-value';
            // }),

            // $this->mergeWhen(Auth::user()->isAdmin(), [
            //     'first-secret' => 'value',
            //     'second-secret' => 'value',
            // ]),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->header('X-Value', 'True');
    }

}
